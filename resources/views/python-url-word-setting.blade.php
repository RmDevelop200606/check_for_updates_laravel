@extends('pysetting')

@section('content')

<div class="py-6">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <form action="/{{request()->path() }}" method="POST">
          {{ csrf_field() }}
          <div class="px-4 py-2">
            <table id="data-table" class="table-fixed w-full">
              <thead>
                <tr>
                  <th class="px-4 py-2 w-1/12 ididid">id</th>
                  <th class="px-4 py-2 w-5/12">タイトル</th>
                  <th class="px-4 py-2 w-5/12">キーワード</th>
                  <th class="px-4 py-2 w-1/12">使用</th>
                </tr>
              </thead>
              <tbody>
                
                @foreach ($urlWords as $urlWord)
                  <tr id="{{ $urlWord->id }}">
                    <td class="border px-4 py-2 text-center">{{ $urlWord->id }}<input name="data[{{ $urlWord->id }}][id]" value="{{ $urlWord->id }}" hidden></td>
                    <td class="border px-4 py-2"><input type="text" name="data[{{ $urlWord->id }}][{{ $word_comment }}]" class="w-full" value="{{ $urlWord->$word_comment }}"></td>
                    <td class="border px-4 py-2"><input type="text" name="data[{{ $urlWord->id }}][{{ $word }}]" class="w-full" value="{{ $urlWord->$word }}"></td>
                    <td class="border px-4 py-2 text-center">
                      <input type="checkbox" class="useCheck" value="del_flg{{ $urlWord->id }}" {{ $urlWord->del_flg == 0 ? 'checked' : '' }}>
                      <input name="data[{{ $urlWord->id }}][del_flg]" id="del_flg{{ $urlWord->id }}" value="" hidden="hidden">
                    </td>
                  </tr>
                @endforeach
                
                @if($urlWords->isEmpty())
                <tr id="1">
                  <td class="border px-4 py-2 text-center">1<input name="data[1][id]" value="1" hidden></td>
                  <td class="border px-4 py-2"><input type="text" name="data[1][{{ $word_comment }}]" class="w-full" value=""></td>
                  <td class="border px-4 py-2"><input type="text" name="data[1][{{ $word }}]" class="w-full" value=""></td>
                  <td class="border px-4 py-2 text-center">
                    <input type="checkbox" class="useCheck" value="del_flg1"> 
                    <input name="data[1][del_flg]" id="del_flg1" value="" hidden="hidden">     
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


          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
