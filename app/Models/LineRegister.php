<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class LineRegister extends Model
{
    use HasFactory, sortable;

    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'line_registers';

    /**
     * テーブルに関連付ける主キー
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'line_flg',
        'customer_id',
        'user_id'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function customer_page(){
        return $this->hasMany(CustomerPage::class, 'customer_id', 'customer_id');
    }

    // ソート可能なカラム
    public $sortable = [
        'line_flg',
        'user_id'
    ];
}