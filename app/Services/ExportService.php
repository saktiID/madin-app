<?php

namespace App\Services;

use App\Models\User;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExportService
{
    public static function export_asatidz()
    {
        $asatidz = User::orderBy('name', 'asc')
            ->has('ustadz')
            ->with('ustadz:user_id,id,no_telepon,alamat,nik,gender')
            ->get();

        $judul = "DATA ASATIDZ";
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', $judul);
        $activeWorksheet->mergeCells('A1:G1');
        $activeWorksheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        $activeWorksheet->getStyle('A1')->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
        ]);

        // Set judul sheet nya
        $activeWorksheet->setTitle('data asatidz');

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
        $activeWorksheet->getStyle('A3')->applyFromArray($style_col);
        $activeWorksheet->getStyle('B3')->applyFromArray($style_col);
        $activeWorksheet->getStyle('C3')->applyFromArray($style_col);
        $activeWorksheet->getStyle('D3')->applyFromArray($style_col);
        $activeWorksheet->getStyle('E3')->applyFromArray($style_col);
        $activeWorksheet->getStyle('F3')->applyFromArray($style_col);
        $activeWorksheet->getStyle('G3')->applyFromArray($style_col);

        // set value cell headers
        $activeWorksheet->setCellValue('A3', 'NO');
        $activeWorksheet->setCellValue('B3', 'NAMA');
        $activeWorksheet->setCellValue('C3', 'EMAIL');
        $activeWorksheet->setCellValue('D3', 'NIK');
        $activeWorksheet->setCellValue('E3', 'NO TELEPON');
        $activeWorksheet->setCellValue('F3', 'GENDER');
        $activeWorksheet->setCellValue('G3', 'ALAMAT');

        // Set width kolom
        $activeWorksheet->getColumnDimension('A')->setWidth(5);
        $activeWorksheet->getColumnDimension('B')->setWidth(37);
        $activeWorksheet->getColumnDimension('C')->setWidth(25);
        $activeWorksheet->getColumnDimension('D')->setWidth(20);
        $activeWorksheet->getColumnDimension('E')->setWidth(15);
        $activeWorksheet->getColumnDimension('F')->setWidth(8);
        $activeWorksheet->getColumnDimension('G')->setWidth(40);

        // looping data
        $no = 1;
        $row = 4;

        foreach ($asatidz as $item) {
            // set value row
            $activeWorksheet->setCellValue('A' . $row, $no);
            $activeWorksheet->getStyle('A' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->setCellValue('B' . $row, strtoupper($item->name));
            $activeWorksheet->setCellValue('C' . $row, $item->email);
            // set string / text format
            $activeWorksheet->setCellValueExplicit(
                'D' . $row,
                $item->ustadz->nik,
                DataType::TYPE_STRING
            );
            $activeWorksheet->setCellValueExplicit(
                'E' . $row,
                $item->ustadz->no_telepon,
                DataType::TYPE_STRING
            );
            $activeWorksheet->setCellValue('F' . $row, $item->ustadz->gender);
            $activeWorksheet->setCellValue('G' . $row, $item->ustadz->alamat);
            // set text wrap
            // $activeWorksheet->getStyle('F' . $row)->getAlignment()->setWrapText(true);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
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
        $filename = "data_asatidz_" . uniqid();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }

    public static function export_santri()
    {
        // 
    }
}
