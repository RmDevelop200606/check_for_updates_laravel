@extends('pysetting')
@section('content')

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
                  <th class="px-4 py-2 w-2/12">タイトル</th>
                  <th class="px-4 py-2 w-2/12">タグ名</th>
                  <th class="px-4 py-2 w-2/12">属性</th>
                  <th class="px-4 py-2 w-2/12">属性値</th>
                  <th class="px-4 py-2 w-1/12">使用</th>
                  <th class="px-4 py-2 w-1/12">削除</th>
                </tr>
              </thead>
              <tbody>
                
                @foreach ($tags as $tag)
                  <tr id="{{ $tag->xpass_id }}">
                    <td class="border px-4 py-2 text-center @error('data.'. $tag->xpass_id. '.xpass_id')bg-yellow-200 @enderror">
                      <span>{{ $tag->xpass_id }}</span>
                      <input name="data[{{ $tag->xpass_id }}][xpass_id]" value="{{ $tag->xpass_id }}" hidden>
                    </td>
                    <td class="border px-4 py-2 @error('data.'. $tag->xpass_id . '.xpass_name')bg-yellow-200 @enderror">
                      <input type="text" name="data[{{ $tag->xpass_id }}][xpass_name]" class="w-full" value="{{ $tag->xpass_name }}">
                    </td>
                    <td class="border px-4 py-2 @error('data.'. $tag->xpass_id . '.tag_name')bg-yellow-200 @enderror">
                      <input type="text" name="data[{{ $tag->xpass_id }}][tag_name]" class="w-full" value="{{ $tag->tag_name }}">
                    </td>

                    <td class="border px-4 py-2 @error('data.'. $tag->xpass_id . '.attribute_value')bg-yellow-200 @enderror">
                      <input type="text" name="data[{{ $tag->xpass_id }}][attribute_value]" class="w-full" value="{{ $tag->attribute_value }}">
                    </td>
                    
                    <td class="border px-4 py-2 @error('data.'. $tag->xpass_id . '.tag_or_attribute')bg-yellow-200 @enderror">
                      <select name="data[{{ $tag->xpass_id }}][tag_or_attribute]">
                        <option value="サンプル1">サンプル1</option>
                        <option value="サンプル2">サンプル2</option>
                        </select>
                      <input type="text" name="data[{{ $tag->xpass_id }}][tag_or_attribute]" class="w-full" value="{{ $tag->tag_or_attribute }}">
                    </td>

                    <td class="border px-4 py-2 text-center @error('data.'. $tag->xpass_id. '.del_flg')bg-yellow-200 @enderror">
                      <input type="checkbox" class="useCheck cursor-pointer" value="del_flg{{ $tag->xpass_id }}" {{ $tag->del_flg == 0 ? 'checked' : '' }}>
                      <input name="data[{{ $tag->xpass_id }}][del_flg]" id="del_flg{{ $tag->xpass_id }}" value="" hidden="hidden">
                    </td>

                    <td class="border px-4 py-2 text-center">
                      <x-delete-link :url="str_replace(url('/'),'',request()->fullUrl()) . '/' . $tag->xpass_id" class="delete-button">
                        {{ __("削除") }}
                      </x-delete-link>
                    </td>
                  </tr>
                @endforeach
                
                @if($tags->isEmpty())
                <tr id="1">
                  <td class="border px-4 py-2 text-center @error('data.'. $tag->xpass_id. '.id')bg-yellow-200 @enderror">
                    <span>1</span>
                    <input name="data[1][xpass_id]" value="1" hidden>
                  </td>
                  <td class="border px-4 py-2 @error('data.'. $tag->xpass_id . '.xpass_name')bg-yellow-200 @enderror">
                    <input type="text" name="data[1][xpass_name]" class="w-full">
                  </td>
                  <td class="border px-4 py-2 @error('data.'. $tag->xpass_id . '.tag_name')bg-yellow-200 @enderror">
                    <input type="text" name="data[1][tag_name]" class="w-full">
                  </td>

                  <td class="border px-4 py-2 @error('data.'. $tag->xpass_id . '.attribute_value')bg-yellow-200 @enderror">
                    <input type="text" name="data[1][attribute_value]" class="w-full">
                  </td>
                  
                  <td class="border px-4 py-2 @error('data.'. $tag->xpass_id . '.tag_or_attribute')bg-yellow-200 @enderror">
                    <input type="text" name="data[1][tag_or_attribute]" class="w-full">
                  </td>

                  <td class="border px-4 py-2 text-center @error('data.'. $tag->xpass_id. '.del_flg')bg-yellow-200 @enderror">
                    <input type="checkbox" class="useCheck cursor-pointer" value="del_flg1">
                    <input name="data[1][del_flg]" id="del_flg1" value="" hidden="hidden">
                  </td>

                  <td class="border px-4 py-2 text-center">
                  </td>
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
<script src="{{ asset('js/python-exclude-tag.js') }}" defer></script>
@endsection
