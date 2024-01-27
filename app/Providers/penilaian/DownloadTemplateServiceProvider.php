<?php

namespace App\Providers\penilaian;

use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\KelasSantri;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class DownloadTemplateServiceProvider extends ServiceProvider
{
    public static function download($request)
    {
        try {

            $santri = KelasSantri::getListSantriKelas($request->periode_id, $request->kelas_id);
            $pelajaran = Pelajaran::where('id', $request->pelajaran_id)->first();
            $kelas = Kelas::where('id', $request->kelas_id)->first();
            $judul = "TEMPLATE NILAI " . strtoupper($pelajaran->nama_pelajaran);

            $spreadsheet = new Spreadsheet();
            $activeWorksheet = $spreadsheet->getActiveSheet();
            $activeWorksheet->setCellValue('A1', $judul);
            $activeWorksheet->mergeCells('A1:E1');
            $activeWorksheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
            $activeWorksheet->getStyle('A1')->applyFromArray([
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ],
            ]);

            // Set judul sheet nya
            $activeWorksheet->setTitle('nilai');

            // Set params
            $activeWorksheet->setCellValue('A2', 'PERIODE_ID');
            $activeWorksheet->setCellValue('B2', $request->periode_id);
            $activeWorksheet->getStyle('A2')->getFont()->setBold(true);

            $activeWorksheet->setCellValue('A3', 'PELAJARAN_ID');
            $activeWorksheet->setCellValue('B3', $request->pelajaran_id);
            $activeWorksheet->getStyle('A3')->getFont()->setBold(true);

            $activeWorksheet->setCellValue('A4', 'KELAS_ID');
            $activeWorksheet->setCellValue('B4', $request->kelas_id);
            $activeWorksheet->getStyle('A4')->getFont()->setBold(true);


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

            // apply style headers
            $activeWorksheet->getStyle('A6')->applyFromArray($style_col);
            $activeWorksheet->getStyle('B6')->applyFromArray($style_col);
            $activeWorksheet->getStyle('C6')->applyFromArray($style_col);
            $activeWorksheet->getStyle('D6')->applyFromArray($style_col);
            $activeWorksheet->getStyle('E6')->applyFromArray($style_col);

            // set value cell headers
            $activeWorksheet->setCellValue('A6', 'NO');
            $activeWorksheet->setCellValue('B6', 'SANTRI_ID');
            $activeWorksheet->setCellValue('C6', 'NAMA');
            $activeWorksheet->setCellValue('D6', 'MUSYAFAHAT');
            $activeWorksheet->setCellValue('E6', 'KITABAH');

            // Set width kolom
            $activeWorksheet->getColumnDimension('A')->setWidth(17);
            $activeWorksheet->getColumnDimension('B')->setWidth(37);
            $activeWorksheet->getColumnDimension('C')->setWidth(37);
            $activeWorksheet->getColumnDimension('D')->setWidth(17);
            $activeWorksheet->getColumnDimension('E')->setWidth(17);

            // lock sheet
            $activeWorksheet->getProtection()->setSheet(true);
            $activeWorksheet->getProtection()->setPassword('madin-app');

            // looping data
            $no = 1;
            $row = 7;

            foreach ($santri as $item) {

                // set value row
                $activeWorksheet->setCellValue('A' . $row, $no);
                $activeWorksheet->getStyle('A' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $activeWorksheet->setCellValue('B' . $row, $item->santri_id);
                $activeWorksheet->setCellValue('C' . $row, strtoupper($item->nama_santri));

                // unlock value penilaian
                $activeWorksheet->getStyle('D' . $row)->getProtection()->setLocked(
                    \PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED
                );
                $activeWorksheet->getStyle('E' . $row)->getProtection()->setLocked(
                    \PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED
                );

                // validation
                $validation = $activeWorksheet->getCell('D' . $row)
                    ->getDataValidation();
                $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_WHOLE);
                $validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_STOP);
                $validation->setAllowBlank(true);
                $validation->setShowInputMessage(true);
                $validation->setShowErrorMessage(true);
                $validation->setErrorTitle('Input error');
                $validation->setError('Nomor tidak diperbolehkan!');
                $validation->setPromptTitle('Input yang diperbolehkan');
                $validation->setPrompt('Hanya angka antara 0 sampai 100 yang diperbolehkan');
                $validation->setFormula1(0);
                $validation->setFormula2(100);

                // clone validation
                $spreadsheet->getActiveSheet()->getCell('E' . $row)->setDataValidation(clone $validation);

                // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                $activeWorksheet->getStyle('A' . $row)->applyFromArray($style_row);
                $activeWorksheet->getStyle('B' . $row)->applyFromArray($style_row);
                $activeWorksheet->getStyle('C' . $row)->applyFromArray($style_row);
                $activeWorksheet->getStyle('D' . $row)->applyFromArray($style_row);
                $activeWorksheet->getStyle('E' . $row)->applyFromArray($style_row);

                $no++;
                $row++;
            }
            // Proses file excel
            $filename = 'Template Nilai'
                . ' ' . $pelajaran->nama_pelajaran
                . ' ' . $kelas->nama_kelas
                . ' ' . $kelas->bagian_kelas;
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment; filename=" . $filename . ".xls");
            header('Cache-Control: max-age=0');

            $writer = IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save('php://output');
        } catch (\Exception $e) {
            Log::error($e);
        }
    }
}
