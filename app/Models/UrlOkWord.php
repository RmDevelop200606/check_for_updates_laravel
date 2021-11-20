<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class UrlOkWord extends Model
{
        /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'url_ok_word';

    /**
     * テーブルに関連付ける主キー
     *
     * @var string
     */
    protected $primaryKey = 'id';
    public $timestamps = false;
}
