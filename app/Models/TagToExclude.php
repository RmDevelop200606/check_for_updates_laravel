<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TagToExclude extends Model
{
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'tag_to_exclude';

    /**
     * テーブルに関連付ける主キー
     *
     * @var string
     */
    protected $primaryKey = 'xpass_id';
    public $timestamps = false;
}
