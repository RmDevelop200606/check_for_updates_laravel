<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TagToExclude;
use App\Rules\AlphaRule;

class PysettingTagToExludeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = TagToExclude::all();
        $resultMsg = "";
        $result = session('result');
        if (isset($result)){
            $resultMsg = (session('result')>0) ? "削除しました。" : "";
        }
        $ErrorArr = [];
        return view('python-tag-to-exclude-setting')->with('tags', $tags)
                                                    ->with('resultMsg', $resultMsg)
                                                    ->with('ErrorArr', $ErrorArr);
    }

    public function update(Request $request)
    {
        $request->validate([
            'data.*.xpass_id' => 'required|integer',
            'data.*.xpass_name' => 'required',
            'data.*.tag_name' => ['nullable', new AlphaRule],
            'data.*.attribute' => ['nullable', new AlphaRule],
            'data.*.attribute_value' => ['nullable', new AlphaRule],
            'data.*.tag_or_attribute' => 'required|boolean',
            'data.*.del_flg' => 'required|boolean',
        ]);

        
        function makeErrorMsg($key){
            $errorMsg = 'id が「' . $key . '」のデータが不揃いです。';
            return $errorMsg;
        }

        $ErrorArr = array();
        foreach ($request->data as $key => $data){

            // 削除方法によらず、エラーの時
            if ($data['attribute_value']) {
                if (!$data['attribute']) {
                    $ErrorArr[$key]['message'] = makeErrorMsg($key);
                    $ErrorArr[$key]['error']['attribute'] = true;
                    $ErrorArr[$key]['error']['attribute_value'] = true;
                    continue;
                }
            }else{
                if ($data['tag_name'] && $data['attribute']) {
                    $ErrorArr[$key]['message'] = makeErrorMsg($key);
                    $ErrorArr[$key]['error']['attribute'] = true;
                    $ErrorArr[$key]['error']['attribute_value'] = true;
                    continue;
                }
            }

            
            if ($data['tag_or_attribute']==0) {
                // タグごと削除時のエラー
                if (!($data['tag_name'] && $data['attribute'] && !$data['attribute_value'] )) {
                    $ErrorArr[$key]['error']['tag_name'] = true;
                    $ErrorArr[$key]['error']['attribute'] = true;
                    $ErrorArr[$key]['error']['attribute_value'] = true;
                    $ErrorArr[$key]['message'] = makeErrorMsg($key);
                }
            
            }elseif ($data['tag_or_attribute']==1) {
                // 属性のみ削除時のエラー
                if ($data['tag_name'] && !($data['attribute'] && !$data['attribute_value'])) {
                    $ErrorArr[$key]['error']['tag_name'] = true;
                    $ErrorArr[$key]['error']['attribute'] = true;
                    $ErrorArr[$key]['error']['attribute_value'] = true;
                    $ErrorArr[$key]['message'] = makeErrorMsg($key);
                }
            }
        }

        // dd($request->old());
        if ( empty($ErrorArr) ){
            $result = TagToExclude::upsert($request->data, ['id']);
        }
        $request->session()->flash('_old_input', $request->all());
        $tags = TagToExclude::all();
        $resultMsg = "";
        return view('python-tag-to-exclude-setting')->with('tags', $tags)
                                                    ->with('resultMsg', $resultMsg)
                                                    ->with('ErrorArr', $ErrorArr);
    }

    // public function delete($OkOrNg, $del_id)
    // {
    //     if (preg_match('/^[0-9]+$/', $del_id)){
    //         $result = $this->urlWordDB::where('id', (int)$del_id)->delete();
    //     }
    //     return redirect('pysetting/Url'. $OkOrNg .'Word/')->with(['result' => $result]);
    // }
}
