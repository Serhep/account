<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    /**
     * Import database table.
     *
     * @return void
     */
    public function __invoke()
    {
        $itidaexp = array();
        $lines = file("../larastock.csv", FILE_IGNORE_NEW_LINES);
        if (!$lines) return "Unable to open file.";
        $lines = mb_convert_encoding($lines, 'utf-8', 'cp1251');
        DB::table('stock')->truncate();

        foreach ( $lines as $value )    {
            $itidaexp = str_getcsv($value, ";");
            DB::table('stock')->insert(['name' => $itidaexp[0],
                                        'code' => $itidaexp[1],
                                        'article' => $itidaexp[2],
                                        'barcode' => $itidaexp[3],
                                        'quant_m' => $itidaexp[4],
                                        'quant_s' => $itidaexp[5],
                                        'price' => $itidaexp[6],
                                        'old_price' => (int)$itidaexp[7],
                                        'date' => $itidaexp[8]]);
            }
    }

}
