<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class UrlNgWord extends Model
{
        /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'url_ng_word';

    /**
     * テーブルに関連付ける主キー
     *
     * @var string
     */
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'ngword_comment',
        'ngword',
        'del_flg'
    ];
}
