<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Customer;
use Carbon\Carbon;

class CSVOutputController extends Controller
{
                /**
    * indexメソッド
    * csv出力をするためのビューと、これまで出力した履歴を表示する
    */
    public function index(){
        return view('csv-output');
    }

            /**
    * makecsvメソッド
    *
    */
    public function store(Request $request){
        $customers = Customer::with('line_register', 'long_diff')
                                ->whereHas('long_diff', function($query){
                                    $query->where('difference_flg', 1)
                                        ->groupBy('customer_id');
                                })
                                ->wherehas('line_register', function($query){
                                    $query->where('line_flg', 0);
                                })
                                ->get();

        // csvファイルの名前を定義
        $now = Carbon::now();
        $csvFileName = $now->year.'_'.$now->month.'_'.$now->day.'_更新'.'なし'.'_LINE'.'なし'.'.csv';
        // csvファイルの中身を作成するメソッドを実行
        $this->makeCsvData($customers, $csvFileName);


        header("Content-Type: application/octet-stream");
        header('Content-Length: '.filesize($csvFileName));
        header('Content-Disposition: attachment; filename='. $csvFileName);
        readfile($csvFileName);
    }


    /**
    * makeCsvDataメソッド
    * makecsvメソッド内で取得した$customersから、csv出力する情報を抽出する
    *
    */
    private function makeCsvData($customers, $csvFileName){


        $csvFile = fopen($csvFileName, 'w');

        // csv1行目のヘッダー情報作成、shift-Jisへの変換、csvファイルに追記
        $columns = [
            'サポートid',
            '顧客名',
            'line',
        ];

        mb_convert_variables('SJIS-win', 'UTF-8', $columns);

        fputcsv($csvFile, $columns);

        // csvのメインデータ作成、shift-Jisへの変換、csvファイルに追記
        foreach($customers as $customer){
            $csv = [
                $customer->support_id,
                $customer->customer_name,
                $customer->line_register->line_flg,
            ];

            mb_convert_variables('SJIS-win', 'UTF-8', $csv);

            fputcsv($csvFile, $csv);
        }
    // csvファイルを閉じる
    fclose($csvFile);
    return $csvFile;
    }
}
