<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('顧客情報詳細表示') }}
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font">
    <div class="lg:container py-24 mx-auto">
        <div class="w-full mx-auto overflow-auto">
        <table class="table-auto border-separate border w-full text-left whitespace-no-wrap">
            <thead>
            <tr>
                <x-table-th>{{ __('No.') }}</x-table-th>
                <x-table-th>{{ __('サポートID') }}</x-table-th>
                <x-table-th>{{ __('顧客名') }}</x-table-th>
                <x-table-th>{{ __('担当者名') }}</x-table-th>
                <x-table-th>{{ __('URL') }}</x-table-th>
                <x-table-th>{{ __('〇〇') }}</x-table-th>
                <x-table-th>{{ __('〇〇') }}</x-table-th>
                <x-table-th>{{ __('ファイル取得日') }}</x-table-th>
            </tr>
            </thead>
            <!-- 顧客情報表示 -->
            
            @foreach($customer_pages as $customer_page)
            <tbody>
                <tr>
                    <x-table-td>{{ __($loop->iteration) }}</x-table-td>
                    <x-table-td>{{ __($customer_page->customer->support_id) }}</x-table-td>
                    <x-table-td>{{ __($customer_page->customer->customer_name) }}</x-table-td>
                    <x-table-td>{{ __('担当者名') }}</x-table-td>
                    <x-table-td>{{ __($customer_page->page_url) }}</x-table-td>
                    <x-table-td>{{ __('') }}</x-table-td>
                    <x-table-td>{{ __('') }}</x-table-td>
                    <x-table-td>{{ __($customer_page->page_html->time_stamp_htmlsrc) }}</x-table-td>
                </tr>
            </tbody>
            @endforeach
        </table>
        </div>

    </div>
    </section>
</x-app-layout>
