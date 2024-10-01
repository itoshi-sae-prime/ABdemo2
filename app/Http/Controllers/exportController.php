<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

use Illuminate\Http\Response;
use mysqli;

class ExportController extends Controller
{
    public function export()
    {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "ya";

        // $servername = "103.200.23.149";
        // $username = "abbeautyworld_it1";
        // $password = "Abbeautyworld117";
        // $dbname = "abbeautyworld_check_price";
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setTitle('Danh sách sản phẩm');

        $headers = [
            'STT',
            'Barcode',
            'Name',
            'Brand',
            'ABBeauty',
            'Hasaki',
            'Guardian',
            'Thegioiskinfood',
            'Lamthao',
            'Watsons',
            'Socialla'
        ];

        $sql = "SELECT * FROM `products`";
        $result = $conn->query($sql);

        // Set column widths and headers
        $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K'];
        $activeWorksheet->getColumnDimension('B')->setWidth(20);
        foreach ($headers as $index => $header) {
            if (isset($columns[$index])) {
                $column = $columns[$index];
                $activeWorksheet->setCellValue("{$column}1", $header);
                $activeWorksheet->getColumnDimension($column)->setWidth(20);
                $activeWorksheet->getStyle("{$column}1")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        }

        // Set specific column formats
        $activeWorksheet->getStyle('B1:B1000')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);

        $row = 2;
        if ($result) {
            if ($result->num_rows > 0) {
                while ($data = $result->fetch_assoc()) {
                    $col = 'A';
                    foreach ($headers as $header) {
                        $cell = $col . $row;
                        $value = isset($data[$header]) ? $data[$header] : '';
                        $activeWorksheet->setCellValue($cell, $value);
                        $activeWorksheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                        $col++;
                    }
                    $row++;
                }
            } else {
                echo "No rows found";
            }
        } else {
            echo "Query failed: " . $conn->error;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Danh_Sach_San_Pham.xlsx';
        $conn->close();

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
