<?php

namespace App\Http\Controllers;

session_start();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use mysqli;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        if (!$request->hasFile('import_excel') || $request->file('import_excel')->getSize() == 0) {
            // Flash a message to the session or return an error response
            session()->flash('message', 'Failed to import data because file is not correct or empty');
            return redirect()->back()->with('error', 'The import file is empty or missing.');
        } else if ($request->has('save_excel_data')) {
            $file = $request->file('import_excel');
            $file_ext = $file->getClientOriginalExtension();
            $allowed_ext = ['xls', 'csv', 'xlsx'];

            if (in_array($file_ext, $allowed_ext)) {
                $inputFileNamePath = $file->getPathname();
                $spreadsheet = IOFactory::load($inputFileNamePath);
                $data = $spreadsheet->getActiveSheet()->toArray();

                $values = [];
                foreach ($data as $index => $row) {
                    if ($index == 0) continue; // Skip the first row (header)
                    $id = $row[0];
                    $barcode = $row[1];
                    $name = $row[2];
                    $brand = $row[3];
                    $abBeauty = $row[4];
                    $hasaki = $row[5];
                    $guardian = $row[6];
                    $thegioiskinfood = $row[7];
                    $lamthao = $row[8];
                    $watsons = $row[9];
                    $socialla = $row[10];

                    if (!empty($id) && !empty($barcode) && !empty($name) && !empty($brand)) {
                        $values[] = [
                            'id' => $id,
                            'product_barcode' => $barcode,
                            'brand' => $brand,
                            'product_name' => $name,
                            'ab_beautyworld' => $abBeauty,
                            'hasaki' => $hasaki,
                            'guardian' => $guardian,
                            'thegioiskinfood' => $thegioiskinfood,
                            'lamthao' => $lamthao,
                            'watsons' =>  $watsons,
                            'socialla' => $socialla
                        ];
                    }
                }
                $filteredValues = array_filter($values, function ($value) {
                    // Check if the value is not empty
                    return !empty($value);
                });
                if (count($filteredValues) > 0) {
                    try {
                        DB::table('products')->insert($values);
                        session()->flash('message', 'Data Imported Successfully');
                    } catch (\Exception $e) {
                        // Handle any exceptions that occur
                        session()->flash('message', 'Failed to import data: ' . $e->getMessage());
                    }
                } else {
                    session()->flash('message', 'No valid data to insert');
                }

                // Redirect to the 'product' route
                return redirect()->route('pages.product');
            }
        }
    }
}
