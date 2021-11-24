<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Rules\AlphaRule;

class PysettingUrlWordController extends Controller
{
    private $urlWordDB;
    private $word_comment; //リリース日
    private $word; //リリース日

    public function __construct(Request $request)
    {
        // modelを呼び出す (use App\Model\○○と同義)
        $this->urlWordDB = 'App\Models\Url' . $request->OkorNg . 'Word';

        // カラム名がそれぞれ、異なるので変数に文字列入れ込み
        $this->word_comment = mb_strtolower($request->OkorNg) . 'word_comment';
        $this->word = mb_strtolower($request->OkorNg) . '_word';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($OkOrNg)
    {
        $urlWords = $this->urlWordDB::all();
        $resultMsg = "";
        $result = session('result');
        if (isset($result)){
            $resultMsg = (session('result')>0) ? "削除しました。" : "";
        }
        
        return view('python-url-word-setting')->with('urlWords', $urlWords)
                                ->with('word_comment', $this->word_comment)
                                ->with('word', $this->word)
                                ->with('resultMsg', $resultMsg);
    }

    public function update(Request $request, $OkOrNg)
    {
        $request->validate([
            'data.*.id' => 'required|integer',
            'data.*.' . $this->word_comment => '',
            'data.*.' . $this->word => ['required', new AlphaRule],
            'data.*.del_flg' => 'required|boolean',
        ]);

        $result = $this->urlWordDB::upsert($request->data, ['id']);

        $resultMsg = ($result > 0) ? "更新しました。" : "";
        $urlWords = $this->urlWordDB::all();
        return view('python-url-word-setting')->with('urlWords', $urlWords)
                            ->with('word_comment', $this->word_comment)
                            ->with('word', $this->word)
                            ->with('resultMsg', $resultMsg);
    }

    public function delete($OkOrNg, $del_id)
    {
        if (preg_match('/^[0-9]+$/', $del_id)){
            $result = $this->urlWordDB::where('id', (int)$del_id)->delete();
        }
        return redirect('pysetting/Url'. $OkOrNg .'Word/')->with(['result' => $result]);
    }
}
