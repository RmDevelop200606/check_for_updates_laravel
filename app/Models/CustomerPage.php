<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class CustomerPage extends Model
{
    use HasFactory, sortable;
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'customer_page';

    /**
     * テーブルに関連付ける主キー
     *
     * @var string
     */
    protected $primaryKey = 'page_id';

    /**
     * モデルにタイムスタンプを付けるか
     *
     * @var bool
     */
    public $timestamps = false;

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function page_html() {
        return $this->hasOne(PageHtml::class, 'html_id', 'page_id');
    }

    public function line_register(){
        return $this->belongsTo(LineRegister::class, 'customer_id', 'customer_id');
    }
    
    public function active_call(){
        return $this->belongsTo(ActiveCall::class, 'customer_id', 'customer_id');
    }

    public function short_diff(){
        return $this->hasOne(DifferenceBetShortterm::class, 'page_id', 'page_id');
    }

    public function long_diff(){
        return $this->hasOne(LongDifference::class, 'page_id', 'page_id');
    }

    public $sortable = [
        'page_id',
        'customer_id'
    ];
}
