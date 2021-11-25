<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Scout\Searchable;

class Customer extends Model
{
    use HasFactory, sortable, searchable;
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'customer';

    /**
     * テーブルに関連付ける主キー
     *
     * @var string
     */
    protected $primaryKey = 'customer_id';

    /**
     * モデルにタイムスタンプを付けるか
     *
     * @var bool
     */
    public $timestamps = false;

    public function customer_page() {
        return $this->hasMany(CustomerPage::class, 'page_id');
    }


    public function page_html(){
        return $this->hasMany(PageHtml::class, 'html_id', 'customer_id');
    }

    public function line_register(){
        return $this->hasOne(LineRegister::class, 'support_id', 'support_id');
    }

    public function active_call(){
        return $this->hasOne(ActiveCall::class, 'customer_id', 'customer_id')->latestOfMany();
    }

    public function review(){
        return $this->hasOne(Review::class, 'customer_id', 'customer_id')->latestOfMany();
    }

    public function short_difference(){
        return $this->hasOne(DifferenceBetShortterm::class, 'customer_id','customer_id')->oldestOfMany();
    }

    // public function long_diff(){
    //     return $this->hasOne(LongDifference::class, 'customer_id','customer_id')->ofMany([
    //         'time_stamp_dif_long' => 'max',
    //         'difference_flg' => 'max'
    //     ]);
    // }
    public function long_diff(){
        return $this->hasMany(LongDifference::class, 'customer_id','customer_id');
    }


    // ソート可能なカラム
    public $sortable = [
        'support_id',
        'customer_name'];

     /**
     * モデルに関連付けられているインデックスの名前を取得
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'customers_index';
    }

        /**
     * モデルのインデックス可能なデータ配列の取得
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // データ配列をカスタマイズ

        return $array;
    }

        /**
     * 全モデルを検索可能にするときの、モデル取得に使用するクエリを変更
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function makeAllSearchableUsing($query)
    {
        return $query->with('customer_page');
    }
}
