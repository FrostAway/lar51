<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Category;
use DB;
use Input;

class PostController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $data = [
            'title' => 'Quản lý Bài viết',
            'posts' => Post::where('post_type', 'post')->paginate(20),
            'order' => 'id'
        ];
        return view('backend.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $cats = Category::where('type', 'cat')->get(['name', 'id', 'parent']);
        $data = [
            'title' => 'Thêm bài viết',
            'treecats' => Category::list_tree_label($cats, 0, 0),
            'tags' => Category::where('type', '=', 'tag')->lists('name', 'id')
        ];
        return view('backend.post.create', $data);
    }

    public function show($slug, $id){
        $post = Post::find($id);
    }
    
    public function store(PostRequest $request) {
        DB::beginTransaction();
        try {
            $post = new Post();
            $post_title = $request->input('post_title');
            $post->post_title = $post_title;
            $slug = $request->input('slug');
            $post->slug = ($slug == '') ? toSlug($post_title) : toSlug($slug);
            $post->image_url = preg_replace('/\/lar51/', '', parse_url($request->input('image_url'))['path']);
            $post->post_content = $request->input('post_content');
            $post->post_excerpt = $request->input('post_excerpt');
            $post->post_status = $request->input('post_status');
            $post->author_id = auth()->user()->id;

            $post->save();
            $cats = $request->input('cats');

            $post->cats()->attach($cats);

            $tags = $request->input('tags');
            if ($tags) {
                foreach ($tags as $tag) {
                    if (is_numeric((int) $tag) && !is_null(Category::where('id', '=', $tag)->first())) {
                        $post->cats()->attach($tag);
                    } else {
                        $newtag = new Category();
                        $newtag->name = $tag;
                        $newtag->slug = toSlug($tag);
                        $newtag->type = 'tag';
                        $newtag->save();

                        $post->cats()->attach($newtag->id);
                    }
                }
            }
        } catch (ValidationException $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('errorMess', 'Có lỗi xảy ra!');
        }

        DB::commit();
        return redirect()->route('admin.post')->with('Mess', 'Thêm thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $post = Post::find($id);
        $cats = Category::where('type', 'cat')->get(['name', 'id', 'parent']);
        $currcats = $post->cats()->where('category.type', 'cat')->lists('category_id')->toArray();
        $data = [
            'title' => 'Chỉnh sửa bài viết',
            'post' => $post,
            'treecats' => Category::list_tree_label($cats, 0, 0, $currcats),
            'tags' => Category::where('type', '=', 'tag')->lists('name', 'id'),
            'curtags' => $post->cats()->where('category.type', 'tag')->lists('category_id')->toArray(),
        ];
        return view('backend.post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, PostRequest $request) {

        DB::beginTransaction();
        try {
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

            $cats = $request->input('cats');
            $tags = $request->input('tags');

            $post->update();

            $post->cats()->detach();
            $post->cats()->attach($cats);
            if ($tags) {
                foreach ($tags as $tag) {
                    if (is_numeric((int) $tag) && !is_null(Category::where('id', '=', $tag)->first())) {
                        $post->cats()->attach($tag);
                    } else {
                        $newtag = new Category();
                        $newtag->name = $tag;
                        $newtag->slug = toSlug($tag);
                        $newtag->type = 'tag';
                        $newtag->save();

                        $post->cats()->attach($newtag->id);
                    }
                }
            }
        } catch (ValidationException $e) {
            DB::rollback();
            return redirect()->back()->withInput->with('errorMess', 'Có lỗi xảy ra!');
        }
        DB::commit();
        return redirect()->route('admin.post')->with('Mess', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        DB::beginTransaction();
        try {
            $post = Post::find($id);
            $post->cats()->detach();
            $post->delete();
        } catch (ValidationException $e) {
            DB::rollback();
            return redirect(route('admin.post'))->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        DB::commit();
        return redirect(route('admin.post'))->with('Mess', 'Đã xóa');
    }

    public function massdel() {
        $postids = Input::get('massdel');
        if ($postids) {
            DB::beginTransaction();
            try {
                foreach ($postids as $id => $value) {
                    $post = Post::find($id);
                    $post->cats()->detach();
                    $post->delete();
                }
            } catch (ValidationException $e) {
                DB::rollback();
                return redirect()->back()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại!');
            }
            DB::commit();
            return redirect()->back()->with('Mess', 'Đã xóa');
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
                'posts' => Post::where('post_title', 'like', '%'.$key.'%')->paginate(20),
                'order' => 'name-az'
            ];
            return view('backend.post.index', $data);
        } else {
            return redirect()->back();
        }
    }

}
