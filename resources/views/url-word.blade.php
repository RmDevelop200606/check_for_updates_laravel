@extends('pysetting')

@section('content')

<div class="py-6">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <form action="/{{request()->path()}}" method="POST">
          {{ csrf_field() }}
          <div class="px-4 py-2">
            <table class="table-fixed w-full">
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
                  <tr>
                    <td class="border px-4 py-2 text-center">{{$urlWord->id}}<input name="data[{{$urlWord->id}}][id]" value="{{$urlWord->id}}" hidden></td>
                    <td class="border px-4 py-2"><input type="text" name="data[{{$urlWord->id}}][{{$word_comment}}]" class="w-full" value="{{$urlWord->$word_comment}}"></td>
                    <td class="border px-4 py-2"><input type="text" name="data[{{$urlWord->id}}][{{$word}}]" class="w-full" value="{{$urlWord->$word}}"></td>
                    <td class="border px-4 py-2 text-center">
                      <input type="checkbox" class="useCheck" value="del_flg{{$urlWord->id}}" {{ $urlWord->del_flg == 0 ? 'checked' : '' }}>
                      <input name="data[{{$urlWord->id}}][del_flg]" id="del_flg{{$urlWord->id}}" value="" hidden="hidden">
                    </td>
                  </tr>
                @endforeach
                <tr>
                  @php
                    $lastId = $urlWords->isEmpty() ? 1 : $urlWord->id + 1
                  @endphp
                  <td class="border px-4 py-2 text-center">{{ $lastId }}<input name="data[{{ $lastId }}][id]" value="{{ $lastId }}" hidden></td>
                  <td class="border px-4 py-2"><input type="text" name="data[{{$lastId}}][{{$word_comment}}]" class="w-full" value=""></td>
                  <td class="border px-4 py-2"><input type="text" name="data[{{$lastId}}][{{$word}}]" class="w-full" value=""></td>
                  <td class="border px-4 py-2 text-center">
                    <input type="checkbox" class="useCheck" value="del_flg{{$lastId}}"> 
                    <input name="data[{{$lastId}}][del_flg]" id="del_flg{{$lastId}}" value="" hidden="hidden">     
                  </td>
                </tr>
              </tbody>
            </table>
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
<script>
$(document).ready(function(){
  // 「使用」checkbox が変化したら、値を入れる
  $('.useCheck').on('change',function(){
    var del_flg_id = $(this).val();
    if($(this).prop('checked')){
      $('#' + del_flg_id).val(0);
    }else{
      $('#' + del_flg_id).val(1);
    }
  });
  $('.useCheck').change();


});

</script>
@endsection







