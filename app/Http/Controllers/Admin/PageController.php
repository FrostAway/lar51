<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Post;

class PageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $data = [
            'title' => 'Quản lý Trang',
            'posts' => Post::where('post_type', 'page')->paginate(20),
            'order' => 'id'
        ];
        return view('backend.page.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $data = [
            'title' => 'Thêm Trang'
        ];
        return view('backend.page.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PostRequest $request) {

        $post = new Post();
        $post_title = $request->input('post_title');
        $post->post_title = $post_title;
        $slug = $request->input('slug');
        $post->slug = ($slug == '') ? toSlug($post_title) : toSlug($slug);
        $post->image_url = preg_replace('/\/lar51/', '', parse_url($request->input('image_url'))['path']);
        $post->post_content = $request->input('post_content');
        $post->post_excerpt = $request->input('post_excerpt');
        $post->post_status = $request->input('post_status');
        $post->post_type = 'page';
        $post->author_id = auth()->user()->id;

        if ($post->save()) {
            return redirect()->route('admin.page')->with('Mess', 'Thêm thành công');
        } else {
            return redirect()->back()->withInput()->with('errorMess', 'Có lỗi xảy ra!');
        }
    }
    
    public function show($id){
        $page = Post::find($id);
    }

    public function edit($id) {
        $data = [
            'title' => 'Chỉnh sửa Trang',
            'post' => Post::find($id)
        ];
        return view('backend.page.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, PostRequest $request) {

        $post = Post::find($id);

        $post_title = $request->input('post_title');
        $post->post_title = $post_title;
        $slug = $request->input('slug');
        $post->slug = ($slug == '') ? toSlug($post_title) : toSlug($slug);
        $post->image_url = preg_replace('/\/lar51/', '', parse_url($request->input('image_url'))['path']);
        $post->post_content = $request->input('post_content');
        $post->post_excerpt = $request->input('post_excerpt');
        $post->post_status = $request->input('post_status');
        $post->author_id = auth()->user()->id;

        if ($post->update()) {
            return redirect()->route('admin.page')->with('Mess', 'Cập nhật thành công');
        } else {
            return redirect()->back()->withInput->with('errorMess', 'Có lỗi xảy ra!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {

        if (Post::destroy([$id])) {
            return redirect(route('admin.post'))->with('Mess', 'Đã xóa');
        } else {
            return redirect(route('admin.post'))->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    public function massdel() {
        $postids = Input::get('massdel');
        if ($postids) {
            if (Post::destroy($postids)) {
                return redirect()->back()->with('Mess', 'Đã xóa');
            } else {
                return redirect()->back()->with('errorMess', 'Có lỗi xảy ra!');
            }
        } else {
            return redirect()->back()->with('errorMess', 'Vui lòng chọn ít nhất một mục!');
        }
    }

    public function order() {
        $orderby = Input::get('order_action');
        if ($orderby == '0') {
            return redirect()->route('admin.post');
        } else {
            switch ($orderby) {
                case 'name-az':
                    $data = [
                        'title' => 'Quản lý Bài viết',
                        'posts' => Post::orderBy('post_title', 'asc')->paginate(20),
                        'order' => 'name-az'
                    ];
                    return view('backend.post.index', $data);
                case 'name-za':
                    $data = [
                        'title' => 'Quản lý Bài viết',
                        'posts' => Post::orderBy('post_title', 'desc')->paginate(20),
                        'order' => 'name-za'
                    ];
                    return view('backend.post.index', $data);
                default:
                    break;
            }
        }
    }

    public function search() {
        $key = Input::get('key');
        if (!empty($key)) {
            $data = [
                'title' => 'Kết quả tìm kiếm bài viết',
                'posts' => Post::where('post_title', 'like', '%' . $key . '%')->paginate(20),
                'order' => 'name-az'
            ];
            return view('backend.post.index', $data);
        } else {
            return redirect()->back();
        }
    }

}
