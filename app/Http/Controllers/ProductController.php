<?php

namespace App\Http\Controllers;

use App\category;
use App\product;
use App\authors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::orderBy('id', 'DESC')->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:products',
            'author' => 'required',
            'category_id' => 'required',

        ], [
            'name.required' => 'Bạn chưa nhập tên',
            'name.unique' => 'Tên này đã tồn tại.Hãy chọn tên khác',
            'author' => 'Sản phẩm chưa có tên tác giả',
            'category_id.required' => 'Sản phẩm chưa chó danh mục',
        ]);
        // Get file name with extension
        $fileNameWithExt = $request->image_url->getClientOriginalName();

        // Get just file name
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        // Get just file extension
        $fileExt = $request->image_url->getClientOriginalExtension();

        // Get file name to store
        $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
        $product = new product();
        $product->thumbnail = $fileNameToStore;
        $product->name = $request->name;
        $product->country = $request->country;
        $product->details = $request->details;
        $product->slug = str_slug($request->name);
        $product->especially = $request->especially;
        $product->is_published = $request->is_published;
        $product->save();
        if ($product) {
            $path = $product->id;
            $request->image_url->move('storage/' . $path, $fileNameToStore);
            $product->categories()->sync($request->category_id, false);
        }
        Session::flash('message', 'Thêm sản phẩm thành công');
        return redirect()->route('products.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('admin.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        $this->validate($request, [
            'name' => 'required|unique:products,name,' . $product->id . ',id',
            'author' => 'required',
            'category_id' => 'required',
        ], [
            'name.required' => 'Bạn chưa nhập tên',
            'name.unique' => 'Tên này đã tồn tại.Hãy chọn tên khác',
            'author' => 'Sản phẩm chưa có tên tác giả',
            'category_id.required' => 'Sản phẩm chưa chó danh mục',
        ]);

        if ($request->hasFile('image_url')) {
            // Get file name with extension
            $fileNameWithExt = $request->image_url->getClientOriginalName();

            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just file extension
            $fileExt = $request->image_url->getClientOriginalExtension();

            // Get file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
            $path = $product->id;
            $request->image_url->move('storage/' . $path, $fileNameToStore);
            $product->thumbnail = $fileNameToStore;
        }
        $product->name = $request->name;
        $product->slug = str_slug($request->name);
        $product->author = $request->author;
        $product->details = $request->details;
        $product->especially = $request->especially;
        $product->is_published = $request->is_published;
        $product->save();
        $product->categories()->sync($request->category_id);
        Session::flash('message', 'Cập nhật thành công');
        return redirect()->route('products.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $product->delete();
        if ($product) {
            $path = "storage/$product->id";
            if (\File::exists($path)) \File::deleteDirectory($path);
            Session::flash('message', 'Đã xóa 1 sản phẩm');
            return redirect()->back();
        }
    }
}
