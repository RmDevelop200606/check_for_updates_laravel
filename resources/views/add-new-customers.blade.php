<x-app-layout>
<script>
function confirmFunction(button) {
    //確認ダイアログを表示する
    if(document.getElementById('file').value){
        var result = confirm('新規顧客の追加を行います。よろしいですか？');
        if (result == true){
            button.classList.remove('hover:bg-indigo-600');
            button.value = 'アップロード中 ページ遷移禁止 待機してください';
            button.submit();
            button.disabled = true;
        }else{
            return false;
        }
    }else{
        alert('ファイルを選択してください。')
        return false;
    }

    
}
</script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('corsin') }}
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">新規顧客エクセルファイルアップロード</h1>
                @if (!empty($successMsg))
                    <div class="text-green-500 text-center">{{$successMsg}}</div>
                @endif
                @if (!empty($errorMsg))
                    <div class="text-red-500 text-center">{{$errorMsg}}</div>
                @endif
            </div>


            <!-- ▼フォーム -->
            <form action="{{ route('excel.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end">
                    <div class="relative flex-grow w-full">
                        <input type="file" id="file" name="file" class="form-control" accept=".xlsx, .xlsm, .xls">
                    </div>
                    <input type="submit" value="アップロード" required onclick="return confirmFunction(this)" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg whitespace-nowrap">
                </div>
            </form>
            <!-- ▲フォーム -->
        </div>
    </section>

    @if(!empty($ngData))
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="px-4 py-2">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight px-4 py-2">
                                {{ __('エラー顧客確認') }}
                            </h2>
                            <span>
                                必要な情報がないか、本アップ URL が不正です。<br>
                                スペースや改行、tab等が入っています。FM と合わせて変更し、再インポートをお願いします。
                            </span>
                        </div>
                        <div class="px-4 py-2">
                            <table id="data-table" class="table-fixed w-full">
                            <thead>
                                <tr>
                                    <th class="px-2 py-2 w-1/12">行番号</th>
                                    <th class="px-4 py-2 w-2/12">サポートid</th>
                                    <th class="px-4 py-2 w-3/12">【101顧客】::顧客名</th>
                                    <th class="px-4 py-2 w-3/12">本アップURL</th>
                                    <th class="px-4 py-2 w-2/12">ＥＣ ＣＵＢＥ</th>
                                    <th class="px-4 py-2 w-1/12">ブログ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ngData as $data)
                                <tr>
                                    <td class="border px-4 py-2 text-center">
                                        <span>{{ $data['cellRow'] }}</span>
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <span>{{ $data['support_id'] }}</span>
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <span>{{ $data['customer_name'] }}</span>
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <span>{{ $data['customer_toppage_url'] }}</span>
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <span>{{ $data['eccube_flg'] }}</span>
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <span>{{ $data['blog_flg'] }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif




</x-app-layout>
