<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CatRequest;
use App\Http\Requests\SliderRequest;
use App\Http\Controllers\Controller;
use App\Category;
use App\Slider;

class SliderController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $data = [
            'title' => 'Quản lý Slider',
            'sliders' => Category::where('type', 'slider')->paginate(20),
            'type' => 'slider'
        ];
        return view('backend.slider.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $data = [
            'title' => 'Tạo Nhóm Slider',
            'sliders' => Category::all(['id', 'name']),
            'type' => 'slider'
        ];
        return view('backend.slider.create', $data);
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
        $cat->type = 'slider';

        if ($cat->save()) {
            return redirect()->route('slider')->with('Mess', 'Thêm mới thành công!');
        } else {
            return redirect()->back()->withInput()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    public function getEdit($id) {
        $data = [
            'title' => 'Chỉnh sửa Nhóm Slider',
            'slider' => Category::find($id),
            'type' => 'slider',
        ];
        return view('backend.slider.edit', $data);
    }

    public function update($id, CatRequest $request) {

        $cat = Category::find($id);
        $cat->name = $request->input('name');
        $slug = $request->input('slug');
        $cat->slug = ($slug == '') ? toSlug($request->input('name')) : toSlug($slug);

        if ($cat->update()) {
            return redirect()->route('slider')->with('Mess', 'Cập nhật thành công');
        } else {
            return redirect()->route('slider.edit', $id)->withInput()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id) {
        if (Category::destroy([$id])) {
            return redirect()->back()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau!');
        } else {
            return redirect()->back()->with('Mess', 'Xóa thành công!');
        }
    }

    public function massdel() {

        $catids = Input::get('massdel');
        if ($catids) {
            DB::beginTransaction();
            try {
                foreach ($catids as $id => $value) {
                    $cat = Category::find($id);
                    $cat->sliders()->detach();
                    $cat->delete();
                }
            } catch (ValidationException $e) {
                DB::rollback();
                return redirect()->back()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau!');
            }
            DB::commit();
            return redirect()->back()->with('Mess', 'Xóa thành công!');
        } else {
            return redirect()->back();
        }
    }

    /*     * *********************** Slider Item **************************** */

    public function view($id) {
        $data = [
            'title' => 'Quản lý Slider',
            'slider' => Category::find($id),
            'slides' => Slider::where('slider_id', $id)->get(),
        ];
        return view('backend.slider.items.index', $data);
    }

    public function itemCreate($group_id) {
        $data = [
            'title' => 'Tạo Slider mới',
            'currslider' => Category::find($group_id)
        ];
        return view('backend.slider.items.create', $data);
    }

    public function itemStore(SliderRequest $request) {


        $slider = new Slider();

        $slider->image = preg_replace('/\/lar51/', '', parse_url($request->input('image'))['path']);
        $slider->name = $request->input('name');
        $slider->desc = $request->input('desc');
        $slider->slider_id = $request->input('slider_id');
        $slider->link = $request->input('link');
        $slider->order = $request->input('order');
        $slider->open_type = $request->input('open_type');

        if ($slider->save()) {
            $slider_id = $request->input('slider_id');
            return redirect()->route('slider.view', $slider_id)->with('Mess', 'Thêm mới thành công!');
        } else {
            return redirect()->back()->withInput()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    public function itemEdit($id, $slider_id) {
        $data = [
            'title' => 'Chỉnh sửa Slider',
            'slide' => Slider::find($id),
            'currslider' => Category::find($slider_id)
        ];
        return view('backend.slider.items.edit', $data);
    }

    public function itemUpdate($id, SliderRequest $request) {

        $slider = Slider::find($id);

        $slider->image = preg_replace('/\/lar51/', '', parse_url($request->input('image'))['path']);
        $slider->name = $request->input('name');
        $slider->desc = $request->input('desc');
        $slider->link = $request->input('link');
        $slider->order = $request->input('order');
        $slider->open_type = $request->input('open_type');

        if ($slider->update()) {
            $sliderid = $request->input('slider_id');
            return redirect()->route('slider.view', $sliderid)->with('Mess', 'Cập nhật thành công!');
        } else {
            return redirect()->back()->withInput()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    public function itemDelete($id) {

        $slider = Slider::find($id);
        if ($slider->delete()) {
            return redirect()->back()->with('Mess', 'Xóa thành công!');
        } else {
            return redirect()->back()->withInput()->with('errorMess', 'Có lỗi xảy ra, vui lòng thử lại sau!');
        }
    }

    public function itemMassdel() {
        DB::beginTransaction();
        try {
            $sliderids = Input::get('massdel');
            if ($sliderids) {
                foreach ($sliderids as $id => $value) {
                    $slider = Slider::find($id);
                    $slider->delete();
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
