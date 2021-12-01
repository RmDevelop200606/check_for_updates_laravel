<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class AddNewCustomersController extends Controller
{
    /**
     * index
     * ファイルのアップロードページを返す
     */
    public function index(){
        return view('add-new-customers');
    }

    /**
     * uploadメソッド
     * ページからアップロードされたエクセルファイルを開き
     * Customerコントローラの upload, storeメソッドに振り分ける
     *
     */
    public function openExcel(Request $request){
        // エクセルファイルがなかったら終了
        if ($request->file == null) {
            return view('add-new-customers')->with('message','ファイルをアップロードできませんでした。ファイルをご確認ください。');
        }

        // エクセルファイルがなかったら終了
        function mbTrim($pString)
        {
            return preg_replace('/\A[\p{Cc}\p{Cf}\p{Z}]++|[\p{Cc}\p{Cf}\p{Z}]++\z/u', '', $pString);
        }

        $reader = new Xlsx();
        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
        $sheetDatas = $spreadsheet->getActiveSheet()->toArray(null, true, false, true);
        
        $errorMsg = null;
        $successMsg = null;
        $ngData = [];
        $importData = [];
        $items = Customer::all();


        $cellColumnName['support_id'] = "サポートID";
        $cellColumnName['customer_name'] = "【101顧客】::顧客名";
        $cellColumnName['customer_toppage_url'] = "本アップURL";
        $cellColumnName['eccube_flg'] = "ＥＣ ＣＵＢＥ";
        $cellColumnName['blog_flg'] = "ブログ";

        foreach($sheetDatas as $key => $sheetData){
            // 1行目 タイトルチェック
            if($key == 1){
                foreach ($sheetData as $colmnName){
                    if ($colmnName == $cellColumnName['support_id']){
                        $existColumnFlgs['support_id'] = 1;
                    }
                    if ($colmnName == $cellColumnName['customer_name']){
                        $existColumnFlgs['customer_name'] = 1;
                    }
                    if ($colmnName == $cellColumnName['customer_toppage_url']){
                        $existColumnFlgs['customer_toppage_url'] = 1;
                    }
                    if ($colmnName == $cellColumnName['eccube_flg']){
                        $existColumnFlgs['eccube_flg'] = 1;
                    }
                    if ($colmnName == $cellColumnName['blog_flg']){
                        $existColumnFlgs['blog_flg'] = 1;
                    }
                }

                // カラムが完全でなかったら、エラー文作成
                if(array_sum($existColumnFlgs) != count($cellColumnName)){
                    foreach ($cellColumnName as $key => $value){
                        if (empty($existColumnFlgs[$key])){
                            if(empty($errorColumnName)){
                                $errorColumnName = $value;
                            }else{
                                $errorColumnName .= ", " . $value;
                            }
                        }
                    }
                    return view('add-new-customers')->with('errorMsg','エクセルのタイトルが異なります。「' . $errorColumnName . '」タイトルがありません。ファイルをご確認ください。');
                }

                $columnArr = array_flip($sheetData);
                continue;
            }
            
            $url = mbTrim($sheetData[$columnArr[$cellColumnName['customer_toppage_url']]]);
            // スペースが入っている場合
            if( $url != $sheetData[$columnArr[$cellColumnName['customer_toppage_url']]] ||
               !($sheetData[$columnArr[$cellColumnName['support_id']]] && 
                 $sheetData[$columnArr[$cellColumnName['customer_name']]] && 
                 $sheetData[$columnArr[$cellColumnName['customer_toppage_url']]] && 
                 $sheetData[$columnArr[$cellColumnName['eccube_flg']]] && 
                 $sheetData[$columnArr[$cellColumnName['blog_flg']]])
                 ){

                $ngData[$key]['cellRow'] = $key;
                $ngData[$key]['support_id'] = $sheetData[$columnArr[$cellColumnName['support_id']]];
                $ngData[$key]['customer_name'] = $sheetData[$columnArr[$cellColumnName['customer_name']]];
                $ngData[$key]['customer_toppage_url'] = $sheetData[$columnArr[$cellColumnName['customer_toppage_url']]];
                $ngData[$key]['eccube_flg'] = $sheetData[$columnArr[$cellColumnName['eccube_flg']]];
                $ngData[$key]['blog_flg'] = $sheetData[$columnArr[$cellColumnName['blog_flg']]];
                continue;
            }

            $url = substr($url, -1) == "/" ? $url : $url . "/";

            $importData[$key]['customer_id'] = "";
            foreach($items as $item){
                if ($item->support_id == $sheetData[$columnArr[$cellColumnName['support_id']]]){
                    $importData[$key]['customer_id'] = $item->customer_id;
                    break;
                }
            }
            $importData[$key]['support_id'] = $sheetData[$columnArr[$cellColumnName['support_id']]];
            $importData[$key]['customer_name'] = $sheetData[$columnArr[$cellColumnName['customer_name']]];
            $importData[$key]['customer_toppage_url'] = $url;
            $importData[$key]['eccube_flg'] = $sheetData[$columnArr[$cellColumnName['eccube_flg']]] == "あり" ? 1 : 0; 
            $importData[$key]['blog_flg'] = $sheetData[$columnArr[$cellColumnName['blog_flg']]] == "あり" ? 1 : 0;
        }

        $ngData = array_values($ngData);
        $importData = array_values($importData);
        if (!empty($importData)){
            Customer::upsert($importData, 'customer_id');
            $successMsg = count($importData) . '件 の更新ができました。';
        }

        if (!empty($ngData)){
            $errorMsg = count($ngData) . '件の不正な URL があります。下記を確認してください。';
        }

        return view('add-new-customers')->with('errorMsg', $errorMsg)
                                        ->with('successMsg', $successMsg)
                                        ->with('importData', $importData)
                                        ->with('ngData', $ngData);
    }
}
