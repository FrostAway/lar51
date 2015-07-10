<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = [
          'title' => 'Cài đặt'  
        ];
        return view('backend.setting.index', $data);
    }

    public function show_info()
    {
        $data = [
            'title' => 'Cài đặt thông tin',
            'settings' => Setting::all()
        ];
        return view('backend.setting.info', $data);
    }
    
    public function show_contact(){
        $data = [
            'title' => 'Thông tin liên hệ'
        ];
        return view('backend.setting.contact', $data);
    }

    public function update()
    {
        $datas = Input::get('st');
        if(!empty($datas)){
            foreach ($datas as $key=>$value){
                if(Setting::where('key', $key)->count()>0){
                    $update = Setting::where('key', $key)->update(['value' => $value]);
                }else{
                    $create = Setting::create(['key' => $key, 'value' => $value]);
                }
            }
            return redirect()->back()->with('Mess', 'Cập nhật thành công');
        }else{
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
