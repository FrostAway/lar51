<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth;
use Input;
use Form;
use App\Category;
use App\Post;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('backend.index')->with('title', 'Quản trị');
    }
    
    public function media(){
        $data = [
            'title' => 'Quản lý Hình ảnh/Video',
            'media_src' => url('public/plugin/filemanager/dialog.php?type=0')
        ];
        return view('media.media', $data);
    }
    
    public function admin_ajax(){
        $action = Input::get('action');
        if($action == 'menu_link'){
            $type = Input::get('type');
            $value = (Input::has('value')) ? Input::get('value') : null;
            switch ($type) {
                case 'cat':
                    $cats = Category::where('type', 'cat')->lists('name', 'id');
                    $output = Form::select('link', $cats, $value, ['class' => 'form-control']);
                    break;
                case 'page':
                    $posts = Post::where('post_type', 'page')->lists('post_title', 'id');
                    $output = Form::select('link', $posts, $value, ['class' => 'form-control']);
                    break;
                case 'post':
                    $posts = Post::where('post_type', 'post')->lists('post_title', 'id');
                    $output = Form::select('link', $posts, $value, ['class' => 'form-control']);
                    break;
                case 'custom':
                    $output = Form::text('link', $value, ['class' => 'form-control', 'placeholder' => 'http://']);
                    break;
                default:
                    break;
            }
            return $output;
        }  
        
        if($action == 'media_upload'){
            echo 'media_upload';
        }
    }

    public function show_setting(){
        $data = [
            'title' => 'Cài đặt',
        ];
        return view('backend.setting.index', $data);
    }
}
