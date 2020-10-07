<?php

namespace App\Http\Controllers;

use App\chapter;
use App\gallerychap;
use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(product $product)
    {
        $slug = $product->slug;
        $chapters = $product->chapters()->orderBy('chapters.id', 'DESC')->paginate(20);;
        return view('admin.chapter.index',compact('chapters','product','slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(product $product)
    {
        return view('admin.chapter.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,product $product)
    {
        $product_id = $product->id;
        $request->validate([
           'chapter'=>'required',
           'name'=>'required'
        ],
        [
            'chapter.required'=>'Bạn chưa nhập số tập',
            'name.required'=>'Bạn chưa nhập tên'
        ]);
        $chapter = new chapter();
        $chapter->chapter = $request->chapter;
        $chapter->name = $request->name;
        $chapter->slug = str_slug($request->name);
        $chapter->product_id = $product_id;
        $chapter->save();
        if($chapter){
            for ($i = 0;$i < count($request->image_url);$i++) {
                // Get file name with extension
                $fileNameWithExt = $request->image_url[$i]->getClientOriginalName();

                // Get just file name
                // Get just file extension
                $fileExt =$request->image_url[$i]->getClientOriginalExtension();

                // Get file name to store
                $fileNameToStore = $i .'.' . $fileExt;
                $pathdir = $product->id.'/'.$chapter->id;
                $gallery = new gallerychap();
                $gallery->chapter_id = $chapter->id;
                $gallery->name = $fileNameToStore;
                $gallery->save();
                if ($gallery){
                    $request->image_url[$i]->move('storage/'.$pathdir, $fileNameToStore);
                }
            }
            Session::flash('message','Thêm sản phẩm thành công');
            return redirect()->route('products.chapters.index',$product);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(chapter $chapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit(chapter $chapter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, chapter $chapter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product,chapter $chapter)
    {
        $chapter->delete();
        if ($chapter){
            $path = "storage/$product->id/$chapter->id/";
            if (\File::exists($path)) \File::deleteDirectory($path);
            Session::flash('message','Đã xóa 1 chapter');
            return redirect()->back();
        }
    }
}
