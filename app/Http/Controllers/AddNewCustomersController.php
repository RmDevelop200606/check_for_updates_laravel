<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class AddNewCustomersController extends Controller
{
    /**
     * index
     * ファイルのアップロードページを返す
     */
    public function index(){
        return view('add-new-customers')->with('message', null);
    }

    /**
     * uploadメソッド
     * ページからアップロードされたエクセルファイルを開き
     * Customerコントローラの upload, storeメソッドに振り分ける
     *
     */
    public function openExcel(Request $request){
        if ($request->file == null) {
            return view('add-new-customers')->with('message','ファイルをアップロードできませんでした。ファイルをご確認ください。');
        }

        $reader = new Xlsx();
        $filename = $_FILES['file']['tmp_name'];
        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, false, true);

        dd($sheetData);
    }
}
