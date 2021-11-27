
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
            <tr id="' +(++id)+ '" class="plus-tr">\
                <td class="border px-4 py-2 text-center">\
                    <span>' +(id)+ '</span>\
                    <input name="data[' +(id)+ '][xpass_id]" value="' +(id)+ '" hidden>\
                </td>\
                <td class="border px-4 py-2">\
                    <input type="text" name="data[' +(id)+ '][xpass_name]" class="w-full">\
                </td>\
                <td class="border px-4 py-2">\
                    <input type="text" name="data[' +(id)+ '][tag_name]" class="w-full">\
                </td>\
                <td class="border px-4 py-2">\
                    <input type="text" name="data[' +(id)+ '][attribute]" class="w-full">\
                </td>\
                <td class="border px-4 py-2">\
                    <input type="text" name="data[' +(id)+ '][attribute_value]" class="w-full">\
                </td>\
                <td class="border px-4 py-2">\
                    <select class="w-full select-box" name="data[' +(id)+ '][tag_or_attribute]">\
                        <option value="-1" hidden>選択してください</option>\
                        <option value="0">タグごと削除</option>\
                        <option value="1">属性のみ削除</option>\
                    </select>\
                </td>\
                <td class="border px-4 py-2 text-center">\
                    <input type="checkbox" class="useCheck cursor-pointer" value="del_flg' +(id)+ '">\
                    <input name="data[' +(id)+ '][del_flg]" id="del_flg' +(id)+ '" value="" hidden="hidden">\
                </td>\
                <td class="border px-4 py-2 text-center">\
                </td>\
            </tr>\
        ';

        $("#data-table tbody").append(html);
        $('.useCheck').change();
        $('.plus-tr .select-box').change();
    });

    $("#trminus").on("click", function() {
        if(id > originalId){
            id--;
            $("#data-table tr").last().remove();
            $('.useCheck').change();
        }
    });

    //////========== ▲▲▲▲　example tabel 開閉　▲▲▲▲ ===========//////
    $(document).on('click', '#example-open-close', function(){
        $("#example-wrapper").fadeToggle();
        if ($(this).text() == "-"){
            $(this).text("+");
        }else{
            $(this).text("-");
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


