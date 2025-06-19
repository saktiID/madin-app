<?php

namespace App\Services;

use Throwable;
use App\Models\User;
use App\Models\Ustadz;
use App\Models\FileData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class TemplateAsatidzService
{
    public static function verify_template($file)
    {
        $spreadsheet = IOFactory::load($file->getPathname());
        $metaSheet = $spreadsheet->getSheetByName('meta');
        if (!$metaSheet) {
            return ['status' => false, 'msg' => 'File tidak memiliki sheet meta'];
        }

        $token = $metaSheet->getCell('A3')->getValue();
        $expected = hash_hmac('sha256', 'template|data-asatidz', 'madin-app');
        if ($token !== "SIGN:$expected") {
            return ['status' => false, 'msg' => 'File template tidak valid'];
        }

        return ['status' => true, 'msg' => 'File template valid'];
    }

    public static function parsing($path, $id_file)
    {
        $reader = IOFactory::createReaderForFile($path);
        $spreadsheet = $reader->load($path);
        $activeWorksheet = $spreadsheet->getActiveSheet()->toArray();

        $row = 10;
        $length = 20;
        $log = [];

        for ($i = 0; $i < $length; $i++) {
            if (!isset($activeWorksheet[$row])) {
                break;
            }
            $data = $activeWorksheet[$row++];
            if (empty($data[1])) {
                continue;
            } else {
                $has_error = false;

                if (empty($data[2]) || empty($data[3]) || empty($data[4])) {
                    $log[] = "Data dari {$data[1]} tidak lengkap.";
                    continue;
                }

                // validate email
                $email_validate = Validator::validate_email($data[2]);
                if (!$email_validate) {
                    $log[] = 'Email dari ' . $data[1] . ' tidak valid: ' . $data[2];
                    $has_error = true;
                }

                // is unique email
                $unique_email = Validator::is_unique_email($data[2]);
                if (!$unique_email) {
                    $log[] = 'Email dari ' . $data[1] . ' sudah ada: ' . $data[2];
                    $has_error = true;
                }

                // validate nik
                $nik_validate = Validator::validate_nik($data[3]);
                if (!$nik_validate) {
                    $log[] = 'NIK dari ' . $data[1] . ' tidak valid: ' . $data[3];
                    $has_error = true;
                }

                // is unique nik
                $unique_nik = Validator::is_unique_nik($data[3]);
                if (!$unique_nik) {
                    $log[] = 'NIK dari ' . $data[1] . ' sudah ada: ' . $data[3];
                    $has_error = true;
                }

                // validate telp
                $telp_validate = Validator::validate_telp($data[4]);
                if (!$telp_validate) {
                    $log[] = 'Telp dari ' . $data[1] . ' tidak valid: ' . $data[4];
                    $has_error = true;
                }

                if ($has_error) {
                    continue;
                }
            }

            if ($has_error === false) {
                try {
                    // Simpan data ustadz baru
                    DB::beginTransaction();
                    $user = User::create([
                        'name' => $data[1],
                        'email' => $data[2],
                        'password' => Hash::make('ustadz5758'),
                        'role' => 'ustadz',
                        'avatar' => null,
                    ]);

                    Ustadz::create([
                        'user_id' => $user->id,
                        'nik' => $data[3],
                        'no_telepon' => $data[4],
                        'gender' => $data[5],
                        'alamat' => $data[6],
                    ]);
                    DB::commit();
                } catch (Throwable $e) {
                    DB::rollBack();
                    $log[] = "Gagal menyimpan data {$data[1]}: " . $e->getMessage();
                    continue;
                }
            }

            // Buat cache progress
            Cache::put("import_progress_{$id_file}", intval((($i + 1) / $length) * 100));
        }

        $status = 'Sukses';
        if (count($log) > 0) {
            $status = 'Terjadi kesalahan <br/>';
            foreach ($log as $item) {
                $status .= $item . '<br/>';
            }
        }

        FileData::where('id', $id_file)
            ->update([
                'is_imported' => true,
                'log' => $status,
            ]);

        // progress selesai
        Cache::put("import_progress_{$id_file}", 100, now()->addMinutes(3));
    }

    public static function download_template()
    {
        $spreadsheet = new Spreadsheet();

        /**
         * buat sheet meta
         */
        $metaSheet = $spreadsheet->createSheet();
        $signature = hash_hmac('sha256', 'template|data-asatidz', 'madin-app');
        // Set judul sheet
        $metaSheet->setTitle('meta');
        $metaSheet->setCellValue('A1', 'NAME:TEMPLATE_UPLOAD_DATA_ASATIDZ');
        $metaSheet->setCellValue('A2', 'DATE:' . date('dmyHis', time()));
        $metaSheet->setCellValue('A3', "SIGN:$signature");
        $metaSheet->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);

        /**
         * buat sheet aktif
         */
        $activeWorksheet = $spreadsheet->getActiveSheet();
        // Set judul sheet
        $activeWorksheet->setTitle('data_template');
        $activeWorksheet->setCellValue('A1', "TEMPLATE UPLOAD DATA ASATIDZ");
        $activeWorksheet->mergeCells('A1:G1');
        $activeWorksheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        $activeWorksheet->getStyle('A1')->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
        ]);


        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        // style title tabel
        $style_title = [
            'font' => ['bold' => true],
        ];

        // style note text
        $style_note = [
            'font' => ['italic' => true, 'size' => 9],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
        ];

        // apply style headers
        $activeWorksheet->getStyle('A3')->applyFromArray($style_title);
        $activeWorksheet->getStyle('A7')->applyFromArray($style_title);

        $activeWorksheet->getStyle('A4')->applyFromArray($style_col);
        $activeWorksheet->getStyle('B4')->applyFromArray($style_col);
        $activeWorksheet->getStyle('C4')->applyFromArray($style_col);
        $activeWorksheet->getStyle('D4')->applyFromArray($style_col);
        $activeWorksheet->getStyle('E4')->applyFromArray($style_col);
        $activeWorksheet->getStyle('F4')->applyFromArray($style_col);
        $activeWorksheet->getStyle('G4')->applyFromArray($style_col);

        $activeWorksheet->getStyle('A10')->applyFromArray($style_col);
        $activeWorksheet->getStyle('B10')->applyFromArray($style_col);
        $activeWorksheet->getStyle('C10')->applyFromArray($style_col);
        $activeWorksheet->getStyle('D10')->applyFromArray($style_col);
        $activeWorksheet->getStyle('E10')->applyFromArray($style_col);
        $activeWorksheet->getStyle('F10')->applyFromArray($style_col);
        $activeWorksheet->getStyle('G10')->applyFromArray($style_col);

        $activeWorksheet->getStyle('A5')->applyFromArray($style_row);
        $activeWorksheet->getStyle('B5')->applyFromArray($style_row);
        $activeWorksheet->getStyle('C5')->applyFromArray($style_row);
        $activeWorksheet->getStyle('D5')->applyFromArray($style_row);
        $activeWorksheet->getStyle('E5')->applyFromArray($style_row);
        $activeWorksheet->getStyle('F5')->applyFromArray($style_row);
        $activeWorksheet->getStyle('G5')->applyFromArray($style_row);

        $activeWorksheet->getStyle('C6')->applyFromArray($style_note)
            ->getAlignment()->setWrapText(true);
        $activeWorksheet->getStyle('D6')->applyFromArray($style_note)
            ->getAlignment()->setWrapText(true);
        $activeWorksheet->getStyle('E6')->applyFromArray($style_note)
            ->getAlignment()->setWrapText(true);
        $activeWorksheet->getStyle('F6')->applyFromArray($style_note)
            ->getAlignment()->setWrapText(true);

        $activeWorksheet->getStyle('A8')->applyFromArray($style_note);
        $activeWorksheet->getStyle('A9')->applyFromArray($style_note);


        // Set width kolom
        $activeWorksheet->getColumnDimension('A')->setWidth(5);
        $activeWorksheet->getColumnDimension('B')->setWidth(37);
        $activeWorksheet->getColumnDimension('C')->setWidth(25);
        $activeWorksheet->getColumnDimension('D')->setWidth(20);
        $activeWorksheet->getColumnDimension('E')->setWidth(15);
        $activeWorksheet->getColumnDimension('F')->setWidth(8);
        $activeWorksheet->getColumnDimension('G')->setWidth(40);

        // set value cell headers
        $activeWorksheet->setCellValue('A3', 'Contoh:');
        $activeWorksheet->setCellValue('A4', 'NO');
        $activeWorksheet->setCellValue('B4', 'NAMA');
        $activeWorksheet->setCellValue('C4', 'EMAIL');
        $activeWorksheet->setCellValue('D4', 'NIK');
        $activeWorksheet->setCellValue('E4', 'NO TELEPON');
        $activeWorksheet->setCellValue('F4', 'GENDER');
        $activeWorksheet->setCellValue('G4', 'ALAMAT');

        // set value
        $activeWorksheet->setCellValue('A5', '1');
        $activeWorksheet->setCellValue('B5', 'Nailul Ghufron, S.Ag');
        $activeWorksheet->setCellValue('C5', 'ghufron@mail.com');
        $activeWorksheet->setCellValueExplicit(
            'D5',
            '3515221234560001',
            DataType::TYPE_STRING
        );
        $activeWorksheet->setCellValueExplicit(
            'E5',
            '081234567890',
            DataType::TYPE_STRING
        );
        $activeWorksheet->setCellValue('E5', '081234567890');
        $activeWorksheet->setCellValue('F5', 'L');
        $activeWorksheet->setCellValue('G5', 'Dk. Raden Saleh No. 237, Pekanbaru 77193, Bali');

        // set note text
        $activeWorksheet->setCellValue('C6', '* Dianjurkan dengan email valid');
        $activeWorksheet->setCellValue('D6', '* NIK 16 digit, ubah format kolom menjadi teks');
        $activeWorksheet->setCellValue('E6', '* Diawali dengan 0, ubah format kolom menjadi teks');
        $activeWorksheet->setCellValue('F6', '* Jenis Kelamin L/P');

        // set catatan
        $activeWorksheet->setCellValue('A7', 'Catatan:');
        $activeWorksheet->setCellValue('A8', '* Semua akun memiliki password awal "ustadz5758", untuk mengubah pergi ke pengaturan profil.');
        $activeWorksheet->setCellValue('A9', '* Satu file template maksimal 20 data, jika ada lebih gandakan template.');

        // set header 
        $activeWorksheet->setCellValue('A10', 'NO');
        $activeWorksheet->setCellValue('B10', 'NAMA');
        $activeWorksheet->setCellValue('C10', 'EMAIL');
        $activeWorksheet->setCellValue('D10', 'NIK');
        $activeWorksheet->setCellValue('E10', 'NO TELEPON');
        $activeWorksheet->setCellValue('F10', 'GENDER');
        $activeWorksheet->setCellValue('G10', 'ALAMAT');

        // lock sheet
        $activeWorksheet->getProtection()->setSheet(true);
        $activeWorksheet->getProtection()->setPassword('madin-app');

        // loop row
        $no = 1;
        $row = 11;
        $total = 20;

        for ($i = 1; $i <= $total; $i++) {

            // unlock cell input
            $activeWorksheet->getStyle('B' . $row . ':G' . $row)->getProtection()->setLocked(
                Protection::PROTECTION_UNPROTECTED
            );

            // set value row
            $activeWorksheet->setCellValue('A' . $row, $no);

            // set format cell
            $activeWorksheet->getStyle('D' . $row)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);
            $activeWorksheet->getStyle('E' . $row)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);

            $activeWorksheet->getCell('D' . $row)
                ->getDataValidation()
                ->setType(DataValidation::TYPE_CUSTOM)
                ->setErrorStyle(DataValidation::STYLE_STOP)
                ->setShowInputMessage(true)
                ->setPromptTitle("Masukkan NIK")
                ->setPrompt("NIK harus 16 digit.");

            $activeWorksheet->getCell('E' . $row)
                ->getDataValidation()
                ->setType(DataValidation::TYPE_CUSTOM)
                ->setErrorStyle(DataValidation::STYLE_STOP)
                ->setShowInputMessage(true)
                ->setPromptTitle("Masukkan No. Telp")
                ->setPrompt("No. Telp diawali 0 dengan angka (0-9) min. 10 dan maks. 10 digit.");

            $validation = $activeWorksheet->getCell('F' . $row)
                ->getDataValidation();
            $validation->setType(DataValidation::TYPE_LIST)
                ->setErrorStyle(DataValidation::STYLE_STOP)
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true);

            // Sumber validasi: hanya "L" atau "P"
            $validation->setFormula1('"L,P"'); // tanda kutip ganda sangat penting
            // Pesan saat mouse hover
            $validation->setPromptTitle("Jenis Kelamin");
            $validation->setPrompt("Pilih salah satu: L atau P");
            // Pesan error jika input tidak valid
            $validation->setErrorTitle("Input Tidak Valid");
            $validation->setError("Hanya boleh memilih 'L' atau 'P'.");

            // set style
            $activeWorksheet->getStyle('A' . $row)->applyFromArray($style_row);
            $activeWorksheet->getStyle('B' . $row)->applyFromArray($style_row);
            $activeWorksheet->getStyle('C' . $row)->applyFromArray($style_row);
            $activeWorksheet->getStyle('D' . $row)->applyFromArray($style_row);
            $activeWorksheet->getStyle('E' . $row)->applyFromArray($style_row);
            $activeWorksheet->getStyle('F' . $row)->applyFromArray($style_row);
            $activeWorksheet->getStyle('G' . $row)->applyFromArray($style_row);

            $no++;
            $row++;
        }


        // proses file excel
        $filename = "template_asatidz_" . date('dmyHis', time());
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }
}
