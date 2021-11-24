
$(function() {
    //////========== ▼▼▼▼　tabel 追加　▼▼▼▼ ===========//////

    // 読み込み時のid番号
    const originalId = $("#data-table tr").last().attr('id');

    // js 変更も反映する、ブラウザ上のid
    let id = originalId;

    $("#trplus").on("click", function() {
        //
        var html = 
        '\
            <tr id="' +(++id)+ '">\
                <td class="border px-4 py-2 text-center">' +(id)+ '<input name="data[' +(id)+ '][id]" value="' +(id)+ '" hidden=""></td>\
                <td class="border px-4 py-2"><input type="text" name="data[' +(id)+ '][ngword_comment]" class="w-full" value=""></td>\
                <td class="border px-4 py-2"><input type="text" name="data[' +(id)+ '][ng_word]" class="w-full" value=""></td>\
                <td class="border px-4 py-2 text-center">\
                    <input type="checkbox" class="useCheck cursor-pointer" value="del_flg' +(id)+ '">\
                    <input name="data[' +(id)+ '][del_flg]" id="del_flg' +(id)+ '" value="" hidden="hidden">\
                </td>\
                <td class="border px-4 py-2 text-center"></td>\
            </tr>\
        ';

        $("#data-table tbody").append(html);
        $('.useCheck').change();
    });

    $("#trminus").on("click", function() {
        if(id > originalId){
            id--;
            $("#data-table tr").last().remove();
            $('.useCheck').change();
        }
    });

    //////========== ▲▲▲▲　tabel 追加　▲▲▲▲ ===========//////


    // 「使用」checkbox が変化したら、値を入れる
    $(document).on('change', '.useCheck', function(){
        var del_flg_id = $(this).val();
        if($(this).prop('checked')){
            $("#"+del_flg_id).val(0);
        }else{
            $("#"+del_flg_id).val(1);
        }
    });
    $('.useCheck').change();

});