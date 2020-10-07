<?php

namespace App\Http\Controllers;

use App\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = post::orderBy('id','desc')->get();
        return view('admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'title'=>'required|unique:posts',
            'image_url'=>'required',
            'details'=>'required',
        ],[
            'title.required'=>'Bài viết chưa có tiêu đề',
            'title.unique'=>'Tiêu đề bài viết đã tồn tại',
            'image_url.required'=>'Bài viết chưa có hình ảnh',
            'details.required'=>'Bài viết chưa có nội dung'
        ]);
        // Get file name with extension
        $fileNameWithExt = $request->image_url->getClientOriginalName();

        // Get just file name
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        // Get just file extension
        $fileExt = $request->image_url->getClientOriginalExtension();

        // Get file name to store
        $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
        $post = new post();
        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->image = $fileNameToStore;
        $post->especially = $request->especially;
        $post->is_published = $request->is_published;
        $post->details = $request->details;
        $post->save();
        if ($post){
            $request->image_url->move('storage/post',$fileNameToStore);
        }
//        Session::flash('message','Thêm bài viết thành công');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {

        return view('admin.post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        $this->validate($request,[
            'title'=>'required|unique:posts,title,'. $post->id. ',id',
            'details'=>'required',
        ],[
            'title.required'=>'Bài viết chưa có tiêu đề',
            'title.unique'=>'Tiêu đề bài viết đã tồn tại',
            'details.required'=>'Bài viết chưa có nội dung'
        ]);
        if($request->hasFile('image_url')){
            // Get file name with extension
            $fileNameWithExt = $request->image_url->getClientOriginalName();

            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just file extension
            $fileExt = $request->image_url->getClientOriginalExtension();

            // Get file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
            $request->image_url->move('storage/post',$fileNameToStore);
            $post->image = $fileNameToStore;
        }
        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->especially = $request->especially;
        $post->is_published = $request->is_published;
        $post->details = $request->details;
        $post->save();
        Session::flash('message','Cập nhật thành công');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        $post->delete();
        Session::flash('message','Đã xóa 1 bài viết');
        return redirect()->back();
    }
}
