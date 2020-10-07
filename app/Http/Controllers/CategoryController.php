<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::orderBy('id', 'DESC')->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:categories'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên',
                'name.unique' => 'Tên danh mục đã tồn tại!'
            ]
        );
        $category = new category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = str_slug($request->name);
        $category->is_published = $request->is_published;
        $category->save();
        Session::flash('message', 'Tạo danh mục thành công');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        if ($category) {
            $products = $category->products()->orderBy('products.id', 'DESC')->where('is_published', '1')->paginate(20);
            return view('admin.product.index', compact('products'));
        } else {
            return \Response::view('website.errors.404', array(), 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:categories,name,' . $category->id,
            ],
            [
                'name.required' => 'Bạn chưa nhập tên',
                'name.unique' => 'Danh mục đã tồn tại',
            ]
        );
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->description = $request->description;
        $category->is_published = $request->is_published;
        $category->save();
        Session::flash('message', 'Cập nhật thành công!');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        $category->delete();
        Session::flash('delete-message', 'Đã xóa 1 sản phẩm');
        return redirect()->back();
    }
}
