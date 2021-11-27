@extends('pysetting')
@section('content')
<div class="py-6">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight px-4">
          {{ __('登録ルール - URL 特別ワード') }}
        </h2>

        <div id="example-wrapper" class="py-4 px-4" hidden>
          <div>
            <span>
              【概要】
              URL の深さはデフォルトで 1 になっています。<br>
              深さというのはドメインの後のスラッシュの階層のことで「http://www.example.com/blog/」これは深さ 1 です。 <br>
              <br>
              【使用例】<br>
              ☆ OK ワード<br>
              　EC-Cube のトップページの URL は 「http://www.example.com/blog/shop/products/list.php」 で深さが1より大きいためチェックできません。<br>
              　そのため、OK ワードに「products/list.php」を入れておくと、例外的にチェックが可能となります。<br>
              <br>
              ☆ NG ワード<br>
              　カレンダーページは 「http://www.example.com/calendar/」で深さが 1 です。<br>
              　しかし、見る必要がほぼないが、日々 HTML の変更が自動で行われるため、チェックがする必要がありません。<br>
              　そのため、NG ワードに「calendar」を入れておくと、例外的にチェックが不要とできます。<br>
            </span>
          </div>
        </div>
        <div class="flex justify-center items-center space-x-6 py-4">
          <div id="example-open-close" class="cursor-pointer bg-green-500 hover:bg-green-300 text-white h-6 w-6 text-center font-extrabold flex items-center justify-center rounded-full">+</div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="py-6">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <form action="/{{request()->path() }}" method="POST">
          {{ csrf_field() }}
          <div class="px-4 py-2">
            @if (isset($resultMsg))
              @if($resultMsg)
                <div class="text-green-500 p-2">{{ $resultMsg }}</div>
              @endif
            @endif

            @if($errors->any())
              <div class="text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>・ {{ $error }}</li>
                    @endforeach
                </ul>
              </div>
            @endif

            <table id="data-table" class="table-fixed w-full">
              <thead>
                <tr>
                  <th class="px-4 py-2 w-1/12 ididid">id</th>
                  <th class="px-4 py-2 w-4/12">タイトル</th>
                  <th class="px-4 py-2 w-4/12">キーワード</th>
                  <th class="px-4 py-2 w-1/12">使用</th>
                  <th class="px-4 py-2 w-1/12">削除</th>
                </tr>
              </thead>
              <tbody>
                
                @foreach ($urlWords as $urlWord)
                  <tr id="{{ $urlWord->id }}">
                    <td class="border px-4 py-2 text-center @error('data.'. $urlWord->id. '.id')bg-yellow-200 @enderror">
                      <span>{{ $urlWord->id }}</span>
                      <input name="data[{{ $urlWord->id }}][id]" value="{{ $urlWord->id }}" hidden>
                    </td>
                    <td class="border px-4 py-2 @error('data.'. $urlWord->id. '.' . $word_comment)bg-yellow-200 @enderror">
                      <input type="text" name="data[{{ $urlWord->id }}][{{ $word_comment }}]" class="w-full" value="{{ old('data.' . $urlWord->id . '.' . $word_comment, $urlWord->$word_comment ) }}">
                    </td>
                    <td class="border px-4 py-2 @error('data.'. $urlWord->id. '.' . $word)bg-yellow-200 @enderror">
                      <input type="text" name="data[{{ $urlWord->id }}][{{ $word }}]" class="w-full" value="{{ old('data.' . $urlWord->id . '.' . $word, $urlWord->$word )}}">
                    </td>
                    <td class="border px-4 py-2 text-center @error('data.'. $urlWord->id. '.del_flg')bg-yellow-200 @enderror">
                      <input type="checkbox" class="useCheck cursor-pointer" value="del_flg{{ $urlWord->id }}" {{ old('data.' . $urlWord->id . '.del_flg', $urlWord->del_flg ) == 0 ? 'checked' : '' }}>
                      <input name="data[{{ $urlWord->id }}][del_flg]" id="del_flg{{ $urlWord->id }}" value="" hidden="hidden">
                    </td>
                    <td class="border px-4 py-2 text-center">
                      <x-delete-link :url="str_replace(url('/'),'',request()->fullUrl()) . '/' . $urlWord->id" class="delete-button">
                        {{ __("削除") }}
                      </x-delete-link>
                      
                    </td>
                  </tr>
                @endforeach
                
                @if($urlWords->isEmpty())
                <tr id="1">
                  <td class="border px-4 py-2 text-center">
                    <span>1</span>
                    <input name="data[1][id]" value="1" hidden>
                  </td>
                  <td class="border px-4 py-2">
                    <input type="text" name="data[1][{{ $word_comment }}]" class="w-full" value="">
                  </td>
                  <td class="border px-4 py-2">
                    <input type="text" name="data[1][{{ $word }}]" class="w-full" value="">
                  </td>
                  <td class="border px-4 py-2 text-center">
                    <input type="checkbox" class="useCheck cursor-pointer" value="del_flg1"> 
                    <input name="data[1][del_flg]" id="del_flg1" value="" hidden="hidden">     
                  </td>
                  <td class="border px-4 py-2 text-center"></td>
                </tr>
                @endif

              </tbody>
            </table>
          </div>

          <div class="flex justify-center items-center space-x-6">
              <div id="trplus" class="cursor-pointer bg-green-500 hover:bg-green-300 text-white h-6 w-6 text-center font-extrabold flex items-center justify-center rounded-full">+</div>
              <div id="trminus" class="cursor-pointer bg-green-500 hover:bg-green-300 text-white h-6 w-6 text-center font-extrabold flex items-center justify-center rounded-full">-</div>
          </div>

          <div class="flex justify-end">
            <div class="px-4 py-4">
              <x-input-submit :name="'add'">
                {{ __("登録・更新") }}
              </x-input-submit>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/python-url-word.js') }}" defer></script>
@endsection
