<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Category;
use DB;
use App\Http\Requests\CatRequest;
use App\Http\Requests\MenuRequest;
use Input;
use Illuminate\Encryption\Encrypter;
use App\Post;

class MenuController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $data = [
            'title' => 'Quản lý Nhóm Menu',
            'menus' => Category::where('type', 'menu')->paginate(20),
            'type' => 'menu'
        ];
        return view('backend.menu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $data = [
            'title' => 'Tạo Nhóm Menu mới',
            'menus' => Category::all(['id', 'name']),
            'type' => 'menu'
        ];
        return view('backend.menu.create', $data);
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
        $cat->type = 'menu';

        if ($cat->save()) {
            return redirect()->route('admin.menu')->with('Mess', 'Thêm mới thành công!');
        } else {
            return redirect()->route('admin.menu.create')->withInput()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    public function getEdit($id) {
        $data = [
            'title' => 'Chỉnh sửa Nhóm Menu',
            'cat' => Category::find($id),
            'type' => 'menu',
        ];
        return view('backend.menu.edit', $data);
    }

    public function update($id, CatRequest $request) {

        $cat = Category::find($id);
        $cat->name = $request->input('name');
        $slug = $request->input('slug');
        $cat->slug = ($slug == '') ? toSlug($request->input('name')) : $slug;

        if ($cat->update()) {
            return redirect()->route('admin.menu')->with('Mess', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.menu.edit', $id)->withInput()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau');
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
            $cat->menus()->detach();
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
                    $cat->menus()->detach();
                    $cat->delete();
                }
            } catch (ValidationException $e) {
                DB::rollback();
                return redirect()->back()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau!');
            }
            DB::commit();
            return redirect()->back()->with('Mess', 'Xóa thành công!');
        } else {
            return redirect()->route('admin.menu');
        }
    }

    /*     * *********************** Menu Item **************************** */

    public function itemIndex($id) {
        $cats = Category::find($id);
        $mns = Menu::where('group_id', $id)->orderBy('order', 'asc')->get();
        $data = [
            'title' => 'Quản lý Menu',
            'group' => $cats,
            'menus' => $mns,
            'menus_tr' => Menu::list_tree_tr($mns, 0, 0, $id)
        ];
        return view('backend.menu.items.index', $data);
    }

    public function itemCreate($group_id) {
        $data = [
            'title' => 'Tạo Menu mới',
            'currgroup' => Category::find($group_id),
            'parents' => Menu::lists('name', 'id')->toArray(),
//            'groups' => Category::where('type', 'menu')->lists('name', 'id'),
            'cats' => Category::where('type', 'cat')->lists('name', 'id')
        ];
        return view('backend.menu.items.create', $data);
    }

    public function itemStore(MenuRequest $request) {
        DB::beginTransaction();
        try {
            $menu = new Menu();

            $menu->name = $request->input('name');
            $menu->group_id = $request->input('group_id');
            $parent = $request->input('parent');
            $menu->parent = ($parent == '') ? 0 : $parent;
            $link_type = $request->input('link_type');
            $link = $request->input('link');
            switch ($link_type) {
                case 'cat':
                    $menu->link = route('cat.view', $link);
                    $menu->item_id = $link;
                    break;
                case 'post':
                    $menu->link = route('post.view', $link);
                    $menu->item_id = $link;
                case 'page':
                    $menu->link = route('page.view', $link);
                    $menu->item_id = $link;
                case 'custom':
                    $menu->link = $link;
                default:
                    break;
            }

            $menu->type = $link_type;
            $menu->status = $request->input('status');
            $menu->order = $request->input('order');
            $menu->open_type = $request->input('open_type');
            $menu->icon = $request->input('icon');

            $menu->save();
            $groupid = $request->input('group_id');
        } catch (ValidationException $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        DB::commit();
        return redirect()->route('menu-item', $groupid)->with('Mess', 'Thêm mới thành công!');
    }

    public function itemEdit($id, $group_id) {
        $data = [
            'title' => 'Chỉnh sửa Menu',
            'menu' => Menu::find($id),
            'parents' => Menu::where('id', '!=', $id)->where('group_id', $group_id)->lists('name', 'id')->toArray(),
//            'groups' => Category::where('type', 'menu')->lists('name', 'id'),
            'currgroup' => Category::find($group_id),
            'cats' => Category::where('type', 'cat')->lists('name', 'id'),
        ];
        return view('backend.menu.items.edit', $data);
    }

    public function itemUpdate($id, MenuRequest $request) {
        DB::beginTransaction();
        try {
            $menu = Menu::find($id);

            $menu->name = $request->input('name');
            $parent = $request->input('parent');
            $menu->parent = ($parent == '') ? 0 : $parent;
            $link_type = $request->input('link_type');
            $link = $request->input('link');
            
            switch ($link_type) {
                case 'cat':
                    $menu->link = get_path(route('cat.view', $link));
                    $menu->item_id = $link;
                    break;
                case 'post':
                    $menu->link = get_path(route('post.view', $link));
                    $menu->item_id = $link;
                    break;
                case 'page':
                    $menu->link = get_path(route('page.view', $link));
                    $menu->item_id = $link;
                    break;
                case 'custom':
                    $menu->link = $link;
                    break;
                default:
                    break;
            }

            $menu->type = $link_type;
            $menu->status = $request->input('status');
            $menu->order = $request->input('order');
            $menu->open_type = $request->input('open_type');
            $menu->icon = $request->input('icon');

            $menu->update();
            $groupid = $request->input('group_id');
        } catch (ValidationException $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        DB::commit();
        return redirect()->route('menu-item', $groupid)->with('Mess', 'Cập nhật thành công!');
    }

    public function itemDelete($id, $group_id) {
        DB::beginTransaction();
        try {
            $menu = Menu::find($id);
            $menu->groups()->detach();
            Menu::where('parent', $id)->update(['parent' => 0]);
            $menu->delete();
        } catch (ValidationException $exc) {
            DB::rollback();
            return redirect()->back()->withInput()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau!');
        }
        DB::commit();
        return redirect()->route('menu-item', $group_id)->with('Mess', 'Xóa thành công!');
    }

    public function itemMassdel() {
        DB::beginTransaction();
        try {
            $menuids = Input::get('massdel');
            if ($menuids) {
                foreach ($menuids as $id => $value) {
                    $menu = Menu::find($id);
                    $menu->groups()->detach();
                    Menu::where('parent', $id)->update(['parent' => 0]);
                    $menu->delete();
                }
            }
        } catch (ValidationException $e) {
            DB::rollback();
            return redirect()->back()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau!');
        }
        DB::commit();
        return redirect()->back()->with('Mess', 'Xóa thành công!');
    }

}
