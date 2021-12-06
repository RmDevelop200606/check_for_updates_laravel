<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomerPage;

class HasBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerPages = CustomerPage::with(['customer', 'page_html', 'line_register', 'long_diff'])
                                    ->whereHas('Customer', function($query){
                                        $query->where('blog_flg', 1) //eccube_flgに"blog_flg"が入っていたため
                                            ->where('active_flg', 1)
                                            ->where('del_flg', 0);
                                    })
                                    ->where('top_page_flg', 1)
                                    ->sortable()->paginate(50);

        return view('has-blog')->with('customerPages', $customerPages);
    }

    /**
     * 更新ありのユーザーのみ表示
     * Display a listing of the resource.
     *
     */
    public function updated(){
        // リクエストに応じたクエリを発行
        $customers = Customer::with('long_diff')
                ->where('blog_flg', 1)
                ->where('active_flg', 1)
                ->where('del_flg', 0)
                ->whereHas('long_diff', function($query){
                    $query->where('difference_flg', 1)
                        ->groupBy('customer_id');
                })
                ->sortable()
                ->paginate(100);


        // dd($customers->long_diff->max('time_stamp_dif_long'));

        // dd($customers);

        return view('hasblog-updated')->with('customers', $customers);
    }

        /**
     * 更新ありのユーザーのみ表示
     * Display a listing of the resource.
     *
     */
    public function not_updated(){
        // リクエストに応じたクエリを発行
        $customers = Customer::with('long_diff')
                ->where('blog_flg', 1)
                ->where('active_flg', 1)
                ->where('del_flg', 0)
                ->whereDoesntHave('long_diff', function($query){
                    $query->where('difference_flg', 1)
                        ->groupBy('customer_id');
                })
                ->sortable()
                ->paginate(100);


        // dd($customers->long_diff->max('time_stamp_dif_long'));

        // dd($customers);

        return view('hasblog-updated')->with('customers', $customers);
    }
}
