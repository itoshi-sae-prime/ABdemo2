<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
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
        $dbname = "ab_check_online";

        // $servername = "103.221.221.22";
        // $username = "yehasfty_check_p";
        // $password = "minhquoc7a3a@gmail.com";
        // $dbname = "yehasfty_check_price";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

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
        ];

        // $sql = "SELECT products.product_barcode, products.product_name, products.brand, now_prices.p_ab, now_prices.p_hsk, now_prices.p_gu, now_prices.p_tgs, now_prices.p_lt
        //         FROM now_prices
        //         JOIN productsON products.id = now_prices.p_id";

        $sql = "SELECT * from `products`";
        $result = $conn->query($sql);

        // Set column widths and headers
        $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
        $activeWorksheet->getColumnDimension('B')->setWidth(100);
        foreach ($headers as $index => $header) {
            $column = $columns[$index];
            $activeWorksheet->setCellValue("{$column}1", $header);
            $activeWorksheet->getColumnDimension($column)->setWidth(25);

            $activeWorksheet->getStyle("{$column}1")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Set specific column formats
        $activeWorksheet->getStyle('B1:B1000')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);
        $activeWorksheet->getStyle('B1:B1000')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER);

        $row = 2;
        if ($result) {
            if ($result->num_rows > 0) {
                while ($data = $result->fetch_assoc()) {
                    $col = 'A';
                    foreach ($data as $key => $value) {
                        $cell = $col . $row;
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
