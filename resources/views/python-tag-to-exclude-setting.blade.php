@extends('pysetting')
@section('content')

<div class="py-6">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight px-4">
          {{ __('登録ルール - 除外タグ') }}
        </h2>

        <div id="example-wrapper" class="py-4 px-4" hidden>
          <div>
            <span>
              html を比較するときに、除外するタグや除外する属性をここで設定できます。<br>
              アクセス時に毎回生成されるトークンや、JavaScript で動き続けるスライドを比較対象から取り除くために設定します。
            </span>
          </div>
          <table id="example-table" class="table-fixed w-full">
            <thead>
              <tr>
                <th class="px-4 py-2 w-20">タグ名</th>
                <th class="px-4 py-2 w-20">属性</th>
                <th class="px-4 py-2 w-20">属性値</th>
                <th class="px-4 py-2 w-20">X path</th>
                <th class="px-4 py-2 w-8">タグごと<br>削除</th>
                <th class="px-4 py-2 w-8">属性のみ<br>削除</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="border px-4 py-2 text-center">input</td>
                <td class="border px-4 py-2 text-center">name</td>
                <td class="border px-4 py-2 text-center">inquiryform</td>
                <td class="border px-4 py-2 text-center">.//input[@name='inquiryform']</td>
                <td class="border px-4 py-2 text-center">○</td>
                <td class="border px-4 py-2 text-center">○</td>
              </tr>
              <tr>
                <td class="border px-4 py-2 text-center">-</td>
                <td class="border px-4 py-2 text-center">name</td>
                <td class="border px-4 py-2 text-center">inquiryform</td>
                <td class="border px-4 py-2 text-center">.//*[@name='inquiryform']</td>
                <td class="border px-4 py-2 text-center">○</td>
                <td class="border px-4 py-2 text-center">○</td>
              </tr>
              <tr>
                <td class="border px-4 py-2 text-center">style</td>
                <td class="border px-4 py-2 text-center">-</td>
                <td class="border px-4 py-2 text-center">-</td>
                <td class="border px-4 py-2 text-center">.//style</td>
                <td class="border px-4 py-2 text-center">○</td>
                <td class="border px-4 py-2 text-center">✖</td>
              </tr>
              <tr>
                <td class="border px-4 py-2 text-center">-</td>
                <td class="border px-4 py-2 text-center">width</td>
                <td class="border px-4 py-2 text-center">-</td>
                <td class="border px-4 py-2 text-center">別途属性削除処理</td>
                <td class="border px-4 py-2 text-center">✖</td>
                <td class="border px-4 py-2 text-center">○</td>
              </tr>
              <tr>
                <td class="border px-4 py-2 text-center">-</td>
                <td class="border px-4 py-2 text-center">-</td>
                <td class="border px-4 py-2 text-center">inquiryform</td>
                <td class="border px-4 py-2 text-center">✖</td>
                <td class="border px-4 py-2 text-center">✖</td>
                <td class="border px-4 py-2 text-center">✖</td>
              </tr>
              <tr>
                <td class="border px-4 py-2 text-center">input</td>
                <td class="border px-4 py-2 text-center">-</td>
                <td class="border px-4 py-2 text-center">inquiryform</td>
                <td class="border px-4 py-2 text-center">✖</td>
                <td class="border px-4 py-2 text-center">✖</td>
                <td class="border px-4 py-2 text-center">✖</td>
              </tr>
              <tr>
                <td class="border px-4 py-2 text-center">input</td>
                <td class="border px-4 py-2 text-center">name</td>
                <td class="border px-4 py-2 text-center">-</td>
                <td class="border px-4 py-2 text-center">✖</td>
                <td class="border px-4 py-2 text-center">✖</td>
                <td class="border px-4 py-2 text-center">✖</td>
              </tr>
            </tbody>
          </table>
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

            @if ($errors->any() or $ErrorArr)
              <div class="text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>・ {{ $error }}</li>
                    @endforeach
                    @foreach ($ErrorArr as $error)
                      <li>・ {{ $error['message'] }}</li>
                    @endforeach
                </ul>
              </div>
            @endif

            <table id="data-table" class="table-fixed w-full">
              <thead>
                <tr>
                  <th class="px-2 py-2 w-12">id</th>
                  <th class="px-4 py-2 w-2/12">タイトル</th>
                  <th class="px-4 py-2 w-2/12">タグ名</th>
                  <th class="px-4 py-2 w-2/12">属性</th>
                  <th class="px-4 py-2 w-2/12">属性値</th>
                  <th class="px-4 py-2 w-2/12">削除法</th>
                  <th class="px-4 py-2 w-16">使用</th>
                  <th class="px-4 py-2 w-28">削除</th>
                </tr>
              </thead>
              <tbody>
                
                @foreach ($tags as $tag)
                  <tr id="{{ $tag->xpass_id }}">
                    <td class="border px-4 py-2 text-center @error('data.'. $tag->xpass_id. '.xpass_id')bg-yellow-200 @enderror">
                      <span>{{ $tag->xpass_id }}</span>
                      <input name="data[{{ $tag->xpass_id }}][xpass_id]" value="{{ old('data.' . $tag->xpass_id . '.xpass_id', $tag->xpass_id )}}" hidden>
                    </td>

                    <td class="border px-4 py-2 @error('data.'. $tag->xpass_id . '.xpass_name')bg-yellow-200 @enderror">
                      <input type="text" name="data[{{ $tag->xpass_id }}][xpass_name]" class="w-full" value="{{ old('data.' . $tag->xpass_id . '.xpass_name', $tag->xpass_name )}}">
                    </td>

                    <td class="border px-4 py-2 @error('data.'. $tag->xpass_id . '.tag_name')bg-yellow-200 @enderror @isset($ErrorArr[$tag->xpass_id]['error']['tag_name'])) bg-yellow-200 @endisset">
                      <input type="text" name="data[{{ $tag->xpass_id }}][tag_name]" class="w-full" value="{{ old('data.' . $tag->xpass_id . '.tag_name', $tag->tag_name )}}">
                    </td>

                    <td class="border px-4 py-2 @error('data.'. $tag->xpass_id . '.attribute')bg-yellow-200 @enderror @isset($ErrorArr[$tag->xpass_id]['error']['attribute'])) bg-yellow-200 @endisset">
                      <input type="text" name="data[{{ $tag->xpass_id }}][attribute]" class="w-full" value="{{ old('data.' . $tag->xpass_id . '.attribute', $tag->attribute )}}">
                    </td>

                    <td class="border px-4 py-2 @error('data.'. $tag->xpass_id . '.attribute_value')bg-yellow-200 @enderror @isset($ErrorArr[$tag->xpass_id]['error']['attribute_value'])) bg-yellow-200 @endisset">
                      <input type="text" name="data[{{ $tag->xpass_id }}][attribute_value]" class="w-full" value="{{ old('data.' . $tag->xpass_id . '.attribute_value', $tag->attribute_value )}}">
                    </td>

                    <td class="border px-4 py-2 @error('data.'. $tag->xpass_id . '.tag_or_attribute')bg-yellow-200 @enderror">
                      {{Form::select("data[" . $tag->xpass_id . "][tag_or_attribute]", ['0' => 'タグごと削除', '1' => '属性のみ削除'], old('data.' . $tag->xpass_id . '.tag_or_attribute', $tag->tag_or_attribute ), ['class'=>'w-full select-box'])}}
                    </td>

                    <td class="border px-4 py-2 text-center @error('data.'. $tag->xpass_id. '.del_flg')bg-yellow-200 @enderror">
                      <input type="checkbox" class="useCheck cursor-pointer" value="del_flg{{ $tag->xpass_id }}" {{ old('data.' . $tag->xpass_id . '.del_flg', $tag->del_flg ) == 0 ? 'checked' : '' }}>
                      <input name="data[{{ $tag->xpass_id }}][del_flg]" id="del_flg{{ $tag->xpass_id }}" value="" hidden="hidden">
                    </td>

                    <td class="border px-4 py-2 text-center">
                      <x-delete-link :url="route('pysetting.tag-to-exlude') . '/' . $tag->xpass_id" class="delete-button">
                        {{ __("削除") }}
                      </x-delete-link>
                    </td>
                  </tr>
                @endforeach
                @if($tags->isEmpty())
                  <tr id="1" class="plus-tr">
                    <td class="border px-4 py-2 text-center">
                        <span>1</span>
                        <input name="data[1][id]" value="1" hidden>
                    </td>
                    <td class="border px-4 py-2">
                        <input type="text" name="data[1][xpass_name]" class="w-full">
                    </td>
                    <td class="border px-4 py-2">
                        <input type="text" name="data[1][tag_name]" class="w-full">
                    </td>
                    <td class="border px-4 py-2">
                      <input type="text" name="data[1][attribute]" class="w-full">
                    </td>
                    <td class="border px-4 py-2">
                        <input type="text" name="data[1][attribute_value]" class="w-full">
                    </td>
                    <td class="border px-4 py-2">
                        <select class="w-full select-box" name="data[1][tag_or_attribute]">
                            <option value="-1" hidden>選択してください</option>
                            <option value="0">タグごと削除</option>
                            <option value="1">属性のみ削除</option>
                        </select>
                    </td>
                    <td class="border px-4 py-2 text-center">
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
