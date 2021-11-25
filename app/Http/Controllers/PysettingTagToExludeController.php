<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TagToExclude;
use App\Rules\AlphaRule;

class PysettingTagToExludeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = TagToExclude::all();
        $resultMsg = "";
        $result = session('result');
        if (isset($result)){
            $resultMsg = (session('result')>0) ? "削除しました。" : "";
        }
        
        return view('python-tag-to-exclude-setting')->with('tags', $tags)
                                ->with('resultMsg', $resultMsg);
    }

    public function update(Request $request)
    {
        $request->validate([
            'data.*.id' => 'required|integer',
            'data.*.' . $this->word_comment => '',
            'data.*.' . $this->word => ['required', new AlphaRule],
            'data.*.del_flg' => 'required|boolean',
        ]);

        // // $result = $this->urlWordDB::upsert($request->data, ['id']);

        // $resultMsg = ($result > 0) ? "更新しました。" : "";
        // return view('python-url-word-setting')->with('urlWords', $urlWords)
        //                     ->with('resultMsg', $resultMsg);
    }

    // public function delete($OkOrNg, $del_id)
    // {
    //     if (preg_match('/^[0-9]+$/', $del_id)){
    //         $result = $this->urlWordDB::where('id', (int)$del_id)->delete();
    //     }
    //     return redirect('pysetting/Url'. $OkOrNg .'Word/')->with(['result' => $result]);
    // }
}
