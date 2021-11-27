<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// customer関係
use App\Models\Customer;
use App\Models\LongDifference;
// user関係
use App\Models\User;
use App\Models\ActiveCall;
use App\Models\Review;
use App\Models\LineRegister;

class PassRecord
{
    /**
     * ///////////////////////////////////////////////////////////////////////////////
     * トップページに表示する進捗状況を表示するための成績を取得する関数
     * ///////////////////////////////////////////////////////////////////////////////
     */
    public function handle(Request $request, Closure $next)
    {
        // ブログ契約の顧客数を取得
        $blogCustomersAll = Customer::where('blog_flg', 1)
                            ->where('active_flg', 1)
                            ->where('del_flg', 0)
                            ->count();
        $users = User::with(['line_register', 'active_call', 'review'])->get();
        // 獲得した「ライン、アクティブコール、口コミ」数を出力
        $line = LineRegister::where('line_flg', 1)->count();
        $activeCall = ActiveCall::where('active_call_flg', 1)->count();
        $review = Review::where('review_flg', 1)->count();

        // ブログありの顧客で、更新している顧客数を出力
        $updated = Customer::with('long_diff')
                                ->where('blog_flg', 1)
                                ->where('active_flg', 1)
                                ->where('del_flg', 0)
                                ->whereHas('long_diff', function($query){
                                    $query->where('difference_flg', 1)
                                        ->groupBy('customer_id');
                                })
                                ->count();

        // 配列に格納して、コントローラに渡す
        $record = [
            "blogCustomersAll" => $blogCustomersAll,
            "users" => $users,
            "line" => $line,
            "lineRegisterRate" => round($line / $blogCustomersAll * 100, 1),
            "activeCall" => $activeCall,
            "activeCallRate" => round($activeCall / $blogCustomersAll * 100, 1),
            "review" => $review,
            "updated" => $updated,
        ];

        $request->merge(['record'=>$record]);

        return $next($request);
    }
}
