<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('ブログ有り一覧') }}
      </h2>
  </x-slot>

<section class="text-gray-600 body-font">
<div class="xl:container px-5 py-24 mx-auto">
  <div class="w-full mx-auto overflow-auto">
    <table class="table-auto w-full text-left whitespace-no-wrap">
        {{-- テーブルヘッダー --}}
        <thead>
          <tr>
            <x-table-th>{{ __('No.') }}</x-table-th>
            <x-table-th>
              @sortablelink('customer.support_id', 'サポートID')
              {{ __('') }}
            </x-table-th>
            <x-table-th>
              @sortablelink('customer.customer_name', '顧客名')
              {{ __('') }}
            </x-table-th>
            <x-table-th>{{ __('担当者名') }}</x-table-th>
            <x-table-th>{{ __('URL') }}</x-table-th>
            <x-table-th>
              @sortablelink('line_register.line_flg', 'LINE登録')
              {{ __('') }}
            </x-table-th>
            <x-table-th>{{ __('〇〇') }}</x-table-th>
            <x-table-th>
              @sortablelink('page_html.time_stamp_htmlsrc', 'ファイル取得日')
              {{ __('') }}</x-table-th>
          </tr>
        </thead>

      {{-- 配色が交互になるようカウント --}}
      <?php $count = 1; ?>
      <!-- 顧客情報表示 -->
      @foreach($customerPages as $customerPage)
        <tbody>
          <tr>
            <x-table-td :active="$count % 2 == 1">{{ __($count) }}</x-table-td>
            <x-table-td :active="$count % 2 == 1"><a href="{{route('customer.show', [$customerPage->customer->customer_id])}}">{{ __($customerPage->customer->support_id) }}</a></x-table-td>
            <x-table-td :active="$count % 2 == 1"><a href="{{route('customer.show', [$customerPage->customer->customer_id])}}">{{ __($customerPage->customer->customer_name) }}</a></x-table-td>
            <x-table-td :active="$count % 2 == 1">{{ __('担当者名') }}</x-table-td>
            <x-table-td :active="$count % 2 == 1">
              <a href="{{ $customerPage->customer_toppage_url }}"class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" >
                {{ __("開く") }}
              </a>
            </x-table-td>
                        
              {{-- LINE登録有無 --}}
              {{-- ラインフラッグ代入（JSの判定用） --}}
              @if($customerPage->line_register != null)
                @if($customerPage->line_register->line_flg == 1)
                  <x-table-td :active="$count % 2 == 1">
                    <x-span :registered="true" class="" id="{{$customerPage->customer->support_id}}">
                      {{ __('登録済み') }}
                    </x-span>
                  </x-table-td>
                @else
                  <x-table-td :active="$count % 2 == 1">
                    <x-span :registered="false" class="" id="{{$customerPage->customer->support_id}}">
                      {{ __('未登録') }}
                    </x-span>
                  </x-table-td>
                @endif
              @else
                <x-table-td :active="$count % 2 == 1">
                  <x-span :registered="false" class="" id="{{$customerPage->customer->support_id}}">
                    {{ __('未登録') }}
                  </x-span>
                </x-table-td>
              @endif
              {{-- ▲JS編集用customer_id --}}
            <x-table-td :active="$count % 2 == 1">{{ __('') }}</x-table-td>
            <x-table-td :active="$count % 2 == 1">{{ __($customerPage->short_diff->time_stamp_dif_short) }}</x-table-td>
          </tr>
        </tbody>
        <?php $count += 1; ?>
      @endforeach
      <div class="container p-2">
        {{ $customerPages->links() }}
      </div>
    </table>
    <div class="container p-2">
      {{ $customerPages->links() }}
    </div>
  </div>

</div>
</section>
</x-app-layout>
