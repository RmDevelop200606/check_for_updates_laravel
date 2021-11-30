<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        dd($request->file);
    }
}
