<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerPage;
use Kyslik\ColumnSortable\Sortable;
use App\Models\Customer;
use Carbon\Carbon;
use App\Models\DifferenceBetShortterm;
use App\Models\LongDifference;
use Illuminate\Support\Facades\DB;

class PysettingUrlWordController extends Controller
{
    public $urlWordDB;
    public $urlWords; //バージョン
    public $word_comment; //リリース日
    public $word; //リリース日

    public function __construct(Request $request)
    {
        // modelを呼び出す (use App\Model\○○と同義)
        // vscode ではエラーだが OK ！
        $this->urlWordDB = 'App\Models\Url' . $request->OkorNg . 'Word';
        $this->urlWords = $this->urlWordDB::all();
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
        return view('url-word')->with('urlWords', $this->urlWords)
                                ->with('word_comment', $this->word_comment)
                                ->with('word', $this->word);
    }


    public function update(Request $req, $OkOrNg)
    {
        $this->urlWordDB::upsert($req->data, ['id']);
        $this->urlWords = $this->urlWordDB::all();
        return view('url-word')->with('urlWords', $this->urlWords)
                            ->with('word_comment', $this->word_comment)
                            ->with('word', $this->word);
    }
}
