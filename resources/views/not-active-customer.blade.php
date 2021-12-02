<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('corsin') }}
        </h2>
    </x-slot>

<section class="text-gray-600 body-font">
  <div class="xl:container px-5 py-16 mx-auto">
    <div class="w-full mx-auto overflow-auto">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('停止中顧客一覧') }}
        </h2>

        <div class="py-5">
            <table class="table-auto w-full text-left whitespace-no-wrap">
                {{-- テーブルヘッダー --}}
                <thead>
                <tr>
                    <x-table-th>{{ __('No.') }}</x-table-th>
                    <x-table-th>
                    @sortablelink('support_id', 'サポートID')
                    {{ __('') }}
                    </x-table-th>
                    <x-table-th>
                    @sortablelink('customer_name', '顧客名')
                    {{ __('') }}
                    </x-table-th>
                    <x-table-th>{{ __('URL') }}</x-table-th>

                </tr>
                </thead>

                {{-- 配色が交互になるようカウント --}}
                <?php $count = 1; ?>
                <!-- 顧客情報表示 -->
                @foreach($customers as $customer)
                <tbody>
                    <tr>
                    <x-table-td :active="$count % 2 == 1">{{ __($count) }}</x-table-td>
                    <x-table-td :active="$count % 2 == 1"><span>{{ __($customer->support_id) }}</span></x-table-td>
                    <x-table-td :active="$count % 2 == 1"><span>{{ __($customer->customer_name) }}</span></x-table-td>
                    <x-table-td :active="$count % 2 == 1"><span>{{ $customer->customer_toppage_url }}</span></x-table-td>
                    @php
                        // page_htmlsの内容は配列のため、->では取得できない
                        $page_htmls = $customer->page_html;
                        // 下記配列で$loop->iterationが狂うので変数に格納
                        $odd_even = $loop->iteration;
                    @endphp
                    @foreach($page_htmls as $page_html)
                        <x-table-td :active="$count % 2 == 1">{{ __($page_html->time_stamp_htmlsrc) }}</x-table-td>
                        @break
                    @endforeach
                    </tr>
                </tbody>
                <?php $count += 1; ?>
                @endforeach
            </table>
        </div>
    </div>

  </div>
</section>
</x-app-layout>
