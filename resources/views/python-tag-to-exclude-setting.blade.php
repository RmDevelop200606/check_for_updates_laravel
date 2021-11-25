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
                
                @foreach ($tags as $urlWord)
                  <tr id="{{ $urlWord->xpass_id }}">
                    <td class="border px-4 py-2 text-center @error('data.'. $urlWord->xpass_id. '.id')bg-yellow-200 @enderror">
                      <span>{{ $urlWord->xpass_id }}</span>
                      <input name="data[{{ $urlWord->xpass_id }}][id]" value="{{ $urlWord->xpass_id }}" hidden>
                    </td>
                    <td class="border px-4 py-2 @error('data.'. $urlWord->xpass_id . '.xpass_name')bg-yellow-200 @enderror">
                      <input type="text" name="data[{{ $urlWord->xpass_id }}][xpass_name]" class="w-full" value="{{ $urlWord->xpass_name }}">
                    </td>
                    <td class="border px-4 py-2 @error('data.'. $urlWord->xpass_id . '.tag_name')bg-yellow-200 @enderror">
                      <input type="text" name="data[{{ $urlWord->xpass_id }}][tag_name]" class="w-full" value="{{ $urlWord->tag_name }}">
                    </td>

                    <td class="border px-4 py-2 @error('data.'. $urlWord->xpass_id . '.attribute_value')bg-yellow-200 @enderror">
                      <input type="text" name="data[{{ $urlWord->xpass_id }}][attribute_value]" class="w-full" value="{{ $urlWord->attribute_value }}">
                    </td>
                    
                    <td class="border px-4 py-2 @error('data.'. $urlWord->xpass_id . '.tag_or_attribute')bg-yellow-200 @enderror">
                      <input type="text" name="data[{{ $urlWord->xpass_id }}][tag_or_attribute]" class="w-full" value="{{ $urlWord->tag_or_attribute }}">
                    </td>



                    <td class="border px-4 py-2 text-center @error('data.'. $urlWord->xpass_id. '.del_flg')bg-yellow-200 @enderror">
                      <input type="checkbox" class="useCheck cursor-pointer" value="del_flg{{ $urlWord->xpass_id }}" {{ $urlWord->del_flg == 0 ? 'checked' : '' }}>
                      <input name="data[{{ $urlWord->xpass_id }}][del_flg]" id="del_flg{{ $urlWord->xpass_id }}" value="" hidden="hidden">
                    </td>
                    <td class="border px-4 py-2 text-center">
                      <x-delete-link :url="str_replace(url('/'),'',request()->fullUrl()) . '/' . $urlWord->xpass_id" class="delete-button">
                        {{ __("削除") }}
                      </x-delete-link>
                      
                    </td>
                  </tr>
                @endforeach
                
                @if($tags->isEmpty())
                <tr id="1">
                  <td class="border px-4 py-2 text-center">
                    <span>1</span>
                    <input name="data[1][id]" value="1" hidden>
                  </td>
                  <td class="border px-4 py-2">
                    <input type="text" name="data[1][xpass_name]" class="w-full" value="">
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

@endsection
