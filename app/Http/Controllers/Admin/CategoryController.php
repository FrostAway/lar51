<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Requests\CatRequest;
use Input;
use DB;

class CategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    

    public function index() {
        $cats = Category::where('type', 'cat')->paginate(20);
        $data = [
            'title' => 'Quản lý Danh mục',
            'cats' => $cats,
            'listcats' => Category::list_tree_tr($cats, 0, 0),
            'type' => 'cat'
        ];
        return view('backend.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $data = [
            'title' => 'Tạo danh mục mới',
            'cats' => Category::all(['id', 'name']),
            'type' => 'cat'
        ];
        return view('backend.category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CatRequest $request) {
        $cat = new Category();
        $cat->name = $request->input('name');
        $slug = $request->input('slug');
        $cat->slug = ($slug == '') ? toSlug($request->input('name')) : toSlug($slug);
        $cat->type = 'cat';
        $cat->parent = $request->input('parent');
        $cat->order = $request->input('order');

        if ($cat->save()) {
            return redirect()->route('admin.cat')->with('Mess', 'Thêm mới thành công!');
        } else {
            return redirect()->route('admin.cat.create')->withInput()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $cat = Category::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id) {
        $data = [
            'title' => 'Chỉnh sửa Danh mục',
            'cat' => Category::find($id),
            'type' => 'cat',
            'cats' => Category::where('id', '!=', $id)->get(['id', 'name'])
        ];
        return view('backend.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, CatRequest $request) {

        $cat = Category::find($id);
        $cat->name = $request->input('name');
        $slug = $request->input('slug');
        $cat->slug = ($slug == '') ? toSlug($request->input('name')) : toSlug($slug);
        $cat->type = 'cat';
        $cat->parent = $request->input('parent');
        $cat->order = $request->input('order');

        if ($cat->update()) {
            return redirect()->route('admin.cat')->with('Mess', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.cat.edit', $id)->withInput()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id) {
        DB::beginTransaction();
        try {
            $cat = Category::find($id);
            $cat->posts()->detach();
            $cat->delete();
        } catch (ValidationException $e) {
            DB::rollback();
            return redirect()->back()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau!');
        }
        DB::commit();
        return redirect()->back()->with('Mess', 'Xóa thành công!');
    }

    public function massdel() {

        $catids = Input::get('massdel');
        if ($catids) {
            DB::beginTransaction();
            try {
                foreach ($catids as $id => $value) {
                    $cat = Category::find($id);
                    $cat->posts()->detach();
                    $cat->delete();
                }
            } catch (ValidationException $e) {
                DB::rollback();
                return redirect()->back()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau!');
            }
            DB::commit();
            return redirect()->back()->with('Mess', 'Xóa thành công!');
        } else {
            return redirect()->route('admin.cat');
        }
    }

    public function tagIndex() {
        $data = [
            'title' => 'Quản lý Thẻ',
            'cats' => Category::where('type', 'tag')->paginate(20),
            'type' => 'tag'
        ];
        return view('backend.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function tagCreate() {
        $data = [
            'title' => 'Tạo thẻ mới',
            'cats' => Category::all(['id', 'name']),
            'type' => 'tag'
        ];
        return view('backend.category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function tagStore(CatRequest $request) {
        $cat = new Category();
        $cat->name = $request->input('name');
        $slug = $request->input('slug');
        $cat->slug = ($slug == '') ? toSlug($request->input('name')) : $slug;
        $cat->type = 'tag';
        $cat->order = $request->input('order');

        if ($cat->save()) {
            return redirect()->route('admin.tag')->with('Mess', 'Thêm mới thành công!');
        } else {
            return redirect()->route('admin.tag.create')->withInput()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function tagEdit($id) {
        $data = [
            'title' => 'Chỉnh sửa Thẻ',
            'cat' => Category::find($id),
            'type' => 'tag'
        ];
        return view('backend.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function tagUpdate($id, CatRequest $request) {

        $cat = Category::find($id);
        $cat->name = $request->input('name');
        $slug = $request->input('slug');
        $cat->slug = ($slug == '') ? toSlug($request->input('name')) : $slug;
        $cat->type = 'tag';
        $cat->order = $request->input('order');

        if ($cat->update()) {
            return redirect()->route('admin.tag')->with('Mess', 'Cập nhật thành công');
        } else {
            return redirect()->back()->withInput()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function tagDelete($id) {
        DB::beginTransaction();
        try {
            $cat = Category::find($id);
            $cat->posts()->detach();
            $cat->delete();
        } catch (ValidationException $e) {
            DB::rollback();
            return redirect()->back()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau!');
        }
        DB::commit();
        return redirect()->back()->with('Mess', 'Xóa thành công!');
    }

    public function tagMassdel() {

        $catids = Input::get('massdel');
        if ($catids) {
            DB::beginTransaction();
            try {
                foreach ($catids as $id => $value) {
                    $cat = Category::find($id);
                    $cat->posts()->detach();
                    $cat->delete();
                }
            } catch (ValidationException $e) {
                DB::rollback();
                return redirect()->back()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau!');
            }
            DB::commit();
            return redirect()->back()->with('Mess', 'Xóa thành công!');
        } else {
            return redirect()->route('admin.tag');
        }
    }

}
