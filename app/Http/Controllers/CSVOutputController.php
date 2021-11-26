<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Customer;
use Carbon\Carbon;

class CSVOutputController extends Controller
{
    /**　//////////////////////////////////////////////////////////////////////////
    * indexメソッド
    * csv出力をするためのビューと、これまで出力した履歴を表示する
    *   //////////////////////////////////////////////////////////////////////////
    */
    public function index(){
        return view('csv-output');
    }



    /**
     * //////////////////////////////////////////////////////////////////////////
    * makecsvメソッド
    * csvを発行するリクエストを受付け、レスポンスを返す
    *
    * 外部のメソッド: makeCsvData (csvファイルの中身を作成するメソッド)
    *             : store (出力したデータをDBに記録するメソッド)
    * //////////////////////////////////////////////////////////////////////////
    */
    public function makecsv(Request $request){
        // リクエストから入力したステータスを取得
        $updated = $request->collect()['updated'];
        $lineStatus = $request->collect()['lineStatus'];

        // リクエストに応じたクエリを発行
        $customers = Customer::with('line_register', 'long_diff')
                                ->where('blog_flg', 1)
                                ->where('active_flg', 1)
                                ->where('del_flg', 0)
                                ->whereHas('long_diff', function($query) use($updated){
                                    $query->where('difference_flg', $updated)
                                        ->groupBy('customer_id');
                                })
                                ->wherehas('line_register', function($query) use($lineStatus){
                                    $query->where('line_flg', $lineStatus);
                                })
                                ->get();

        // csvファイルの名前を定義
        $now = Carbon::now();//今日の日付
        $line = ['なし','あり'];//リクエストのパラメーターより値を決定
        $blog = ['なし','あり'];//リクエストのパラメーターより値を決定
        $csvFileName = $now->year.'_'.$now->month.'_'.$now->day.'_更新'.$blog[$updated].'_LINE'.$line[$lineStatus].'.csv';
        // csvファイルの中身を作成するメソッドを実行
        $this->makeCsvData($customers, $csvFileName);

        // ヘッダーメソッドでレスポンスの定義
        header("Content-Type: application/octet-stream");
        header('Content-Length: '.filesize($csvFileName));
        header('Content-Disposition: attachment; filename='. $csvFileName);
        readfile($csvFileName);//ファイルの出力

    }



    /**
     * //////////////////////////////////////////////////////////////////////////
    * makeCsvDataメソッド
    * makecsvメソッド内で取得した$customersから、csv出力する情報を抽出、ファイルに書き込みを行う
    * 返り値：　書き込み済みのファイル
    *  //////////////////////////////////////////////////////////////////////////
    */
    private function makeCsvData($customers, $csvFileName){

        // ファイルの生成
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
