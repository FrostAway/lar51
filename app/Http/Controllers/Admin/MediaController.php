<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\MediaRequest;
use App\Media;
use Input;
use Validator;
use Intervention\Image\Facades\Image;


class MediaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $data = [
            'title' => 'Quản lý Media',
            'medias' => Media::where('type', '=', 'image')->paginate(20)
        ];
        return view('media.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
//        $paths = [
//            'app_path' => app_path(),
//            'base_path' => base_path(),
//            'config_path' => config_path(),
//            'public_path' => public_path(),
//            'database_path' => database_path(),
//            'storage_path' => storage_path(),
//            'URL_to' => url()
//        ];

        if (!Input::has('path')) {
            $rpath = base_path() . '\resources\upload';
            $url = url('resources/upload');
        } else {
            $rpath = Input::get('path');
            $url = Input::get('url');
        }
        $dirs = scandir($rpath);

        $data = [
            'title' => 'Thêm Ảnh/Video mới',
            'rpath' => $rpath,
            'url' => $url,
            'dirs' => $dirs
        ];
        return view('media.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(MediaRequest $request) {
        $file = $request->file('file');
        if ($file->isValid()) {
            $filename = date('d_m_Y') . '_' . toSlug($file->getClientOriginalName());

            $path = $request->input('path');
            $url = $request->input('url');
            if ($file->move($path, $filename)) {

                $media_url = preg_replace("/\/lar51/", '', parse_url($url)['path'] . '/' . $filename);

                $location = base_path($path . $filename);
//                Image::make($file->getRealPath())->resize(200, 200)->save();
                
//                $namespl = explode('.', $filename);
//                $width = 200;
//                $height = 200;
//                resize_image($location, true, $width, $height, base_path('resources/upload/' . $namespl[0] . '_' . $width . 'x' . $height . '.' . $namespl[1]), $namespl[1]);
//
                $media = new Media();
                $media->author_id = auth()->user()->id;
                $media->src = $media_url;
                $media->name = toSlug($request->input('name'));
                $media->title = $request->input('title');
                $media->type = 'image';
                $media->mime_type = $file->getClientMimeType();

                if ($media->save()) {
                    return redirect()->route('admin.media')->with('Mess', 'Upload thành công');
                } else {
                    return redirect()->route('admin.media.create')->with('errorMess', 'Có lỗi xảy ra!');
                }
            }
        } else {
            return redirect()->route('admin.media.create')->with('errorMess', 'File không hợp lệ');
        }
    }

    public function explorer() {
        if (!Input::has('path')) {
            $rpath = base_path() . '\resources\upload';
            $url = url('resources/upload');
        } else {
            $rpath = Input::get('path');
            $url = Input::get('url');
        }
        $dirs = scandir($rpath);
        $data = [
            'title' => 'Thêm Ảnh/Video mới',
            'rpath' => $rpath,
            'url' => $url,
            'dirs' => $dirs
        ];
        return view('media.create', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $data = [
            'title' => 'Chỉnh sửa Media',
            'media' => Media::find($id)
        ];
        return view('media.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(MediaRequest $request) {

        $id = $request->input('id');
        $media = Media::find($id);
        $media->name = $request->input('name');
        $media->title = $request->input('title');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if ($file->isValid()) {
                $filename = date('d_m_Y') . '_' . toSlug($file->getClientOriginalName());
                $mime_type = $file->getClientMimeType();
                if ($file->move('resources/upload', $filename)) {
                    $media->src = '/resources/upload/' . $filename;
                    $media->mime_type = $mime_type;
                } else {
                    $media->src = $request->get('src');
                }
            } else {
                $media->src = $request->get('src');
            }
        }else{
            $media->src = $request->get('src');
        }

        if ($media->update()) {
            if (Input::get('delold') === 'on') {
                unlink(base_path($request->input('src')));
            }
            return redirect()->route('admin.media');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $file = Media::find($id);
        $src = $file->src;
        if ($file->delete()) {
            if (file_exists(base_path($src))) {
                if (unlink(base_path($src))) {
                    $mess = 'Xóa thành công';
                } else {
                    $mess = 'Không xóa được';
                }
            } else {
                $mess = 'Không tồn tại file';
            }
        } else {
            $mess = 'Có lỗi xảy ra!';
        }
        return redirect()->route('admin.media')->with('Mess', $mess);
    }
    
    public function massdel(){
        $mediaids = Input::get('massdel');
        if ($mediaids) {
            $flag = true;
            foreach ($mediaids as $id => $value) {
                $file = Media::find($id);
                $src = $file->src;
                if(file_exists(base_path($src))){
                    unlink(base_path($src));
                }
                if($file->delete()){
                    
                }else{
                    $flag = false;
                }
                if($flag == false){
                    return redirect()->route('admin.media')->with('errorMess', 'Có lỗi xảy ra');
                }
            }
            return redirect()->route('admin.media')->with('Mess', 'Xóa thành công');
        } else {
            return redirect()->route('admin.media');
        }
    }
    
    
    public function videoIndex(){
       $data = [
           'title' => 'Quản lý Video',
           'videos' => Media::where('type', '=', 'video')->get()
       ] ;
       return view('media.video.index', $data);
    }
    public function videoCreate(){
        $data = [
            'title' => 'Thêm video mới'
        ];
        return view('media.video.create', $data);
    }
    public function videoStore(){
        $rules = [
            'name' => 'required',
            'src' => 'required'
        ];
        
        $validate = Validator::make(Input::all(), $rules);
        
        if($validate->fails()){
            return redirect()->route('admin.video.create')->withErrors($validate)->withInput();
        }
        
        $src = Input::get('src');
        $name = Input::get('name');
        $title = Input::get('title');
        $type = 'video';
        $video = new Media();
        $video->src = $src;
        $video->name = $name;
        $video->title = $title;
        $video->type = $type;
        $video->author_id = auth()->user()->id;
        
        if($video->save()){
            return redirect()->route('admin.video')->with('Mess', 'Thêm thành công!');
        }else{
            return redirect()->route('admin.video.create')->with('errorMess', 'Có lỗi xảy ra!');
        }
    }
    public function videoEdit($id){
        $data = [
            'title' => 'Chỉnh sửa Video',
            'video' => Media::find($id)
        ];
        return view('media.video.edit', $data);
    }
    public function videoUpdate(){
        
        $rules = [
            'name' => 'required',
            'src' => 'required'
        ];
        
        $validate = Validator::make(Input::all(), $rules);
        
        if($validate->fails()){
            return redirect()->route('admin.video.create')->withErrors($validate)->withInput();
        }
        
        $id = Input::get('id');
        $video = Media::find($id);
        
        $video->src = Input::get('src');
        $video->name = Input::get('name');
        $video->title = Input::get('title');
        $video->type = 'video';
        $video->author_id = auth()->user()->id;
        
        if($video->update()){
            return redirect()->route('admin.video')->with('Mess', 'Cập nhật thành công');
        }else{
            return redirect()->route('admin.video.edit')->with('errorMess', 'Có lỗi xảy ra!');
        }
    }
    
    public function videoDestroy($id){
        $video = Media::find($id);
        if($video->delete()){
            return redirect()->route('admin.video')->with('Mess', 'Xóa thành công');
        }else{
            return redirect()->route('admin.video')->with('errorMess', 'Có lỗi xảy ra!');
        }
    }
    
    public function videoMassdel(){
        $videoids = Input::get('massdel');
        if ($videoids) {
            $ids = [];
            foreach ($videoids as $id => $value) {
                $ids[] = $id;
            }
            $video = Media::destroy($ids);
            if ($video) {
                return redirect(route('admin.video'))->with('Mess', 'Đã xóa');
            } else {
                return redirect(route('admin.video'))->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại!');
            }
        } else {
            return redirect()->route('admin.video');
        }
    }
}
