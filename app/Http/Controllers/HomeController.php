<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Post;
use App\Category;
use App\Slider;

class HomeController extends Controller
{
    public function __construct() {
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    { 
        $data = [
            'title' => 'Trang chủ',
            'slides' => Slider::where('slider_id', 29)->orderBy('order', 'asc')->get(),
            'ctslides' => Slider::where('slider_id', 30)->orderBy('order', 'asc')->get(),
            'news' => Category::find(2)->posts()->orderBy('created_at', 'asc')->get(),
            'travels' => Category::find(27)->posts()->orderBy('created_at', 'asc')->get(),
            'rooms' => Category::find(31)->posts()->orderby('created_at', 'asc')->get(),
            'reviews' => Category::find(32)->posts()->orderby('created_at', 'asc')->get()
        ];
        return view('index.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
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
