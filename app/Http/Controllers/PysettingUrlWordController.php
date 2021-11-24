<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

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
        return view('python-url-word-setting')->with('urlWords', $urlWords)
                                ->with('word_comment', $this->word_comment)
                                ->with('word', $this->word);
    }

    public function update(Request $request, $OkOrNg)
    {
        $request->validate([
            'data.*.id' => 'required|integer',
            'data.*.' . $this->word_comment => 'required',
            'data.*.' . $this->word => 'required|regex:/\A([a-zA-Z0-9]{,})+\z/u',
            'data.*.del_flg' => 'required|boolean',
        ]);
        $this->urlWordDB::upsert($request->data, ['id']);

        $urlWords = $this->urlWordDB::all();
        return view('python-url-word-setting')->with('urlWords', $urlWords)
                            ->with('word_comment', $this->word_comment)
                            ->with('word', $this->word);
    }
}
