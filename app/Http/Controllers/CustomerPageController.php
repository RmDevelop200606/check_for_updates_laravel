<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerPage;
use Kyslik\ColumnSortable\Sortable;


class CustomerPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerPages = CustomerPage::with(['customer', 'page_html'])
                                    ->where('top_page_flg', 1)
                                    ->sortable()
                                    ->paginate(50);

        return view('customer-page')->with('customerPages', $customerPages);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerPage  $customerPage
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerPage $customerPage)
    {
        //
    }
}
