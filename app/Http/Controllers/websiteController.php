<?php

namespace App\Http\Controllers;

use App\Mail\contact;
use Illuminate\Http\Request;
use App\product;
use App\category;
use App\chapter;
use App\post;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class websiteController extends Controller
{
    public function index(){
        $productespec = product::where('especially','1')
            ->where('is_published','1')->get()->random(8);
        $productnew = product::orderBy('id','DESC')
            ->where('is_published','1')->limit(30)
            ->get();
        $postespec = post::orderBy('id','DESC')
            ->where('is_published','1')
            ->where('especially','1')
            ->limit(2)->get();
        $postnew = post::orderBy('id','DESC')
            ->where('is_published','1')
            ->where('especially','0')
            ->limit(3)->get();
        return view('website.index',compact('productnew','productespec','postespec','postnew'));
    }
    public function post(){
        $posts = post::where('is_published','1')->get();
        return view('website.postpage',compact('posts'));
    }
    public function product(){
        $category = category::orderBy('name','ASC')
            ->where('is_published','1')
            ->get();
        $products = product::join('category_products','products.id','=','category_products.product_id')
            ->join('categories','categories.id','=','category_products.category_id')
            ->where('categories.is_published','1')
            ->where('products.is_published','1')
            ->orderBy('id','DESC')
            ->select('products.*')
            ->distinct()
            ->simplepaginate(18);
        return view('website.product',compact('category','products'));
    }
    public function productshow($slug)
    {
        $product = product::where('slug', $slug)
            ->where('is_published', '1')
            ->first();
        if ($product != null) {
            $category = $product->categories()
                ->where('is_published', '1')
                ->get()
                ->random(1);
            if ($category != null) {
                foreach ($category as $row){
                    $productrelative = $row->products()
                        ->where('is_published', '1')
                        ->where('slug', '!=', $slug)
                        ->distinct()
                        ->inRandomOrder()
                        ->limit(6)
                        ->get();
                }
                $chapter = $product
                    ->chapters()
                    ->orderBy('chapters.id', 'DESC')
                    ->get();
                $chapterfirst = $product->chapters()->first();
                return view('website.detail-product', compact('product', 'chapter', 'chapterfirst', 'productrelative'));
            }
            return view('errors.404');
        }
        return view('errors.404');

    }
    public function categoryshow($slug){
        $category = category::orderBy('name','ASC')
            ->where('is_published','1')
            ->get();
        if($category != null){
            $categoryfocus = category::where('slug', $slug)
                ->where('is_published', '1')
                ->first();
            if ($categoryfocus) {
                $products = $categoryfocus->products()->orderBy('products.id', 'DESC')->where('is_published', '1')->distinct()->paginate(18);
                return view('website.product', compact('category','categoryfocus', 'products'));
            } else {
                return view('errors.404');
            }
        }
        return view('errors.404');

    }
    public function showcontent($slug,$slugchapter){
        $product = product::where('slug',$slug)->where('is_published', '1')->first();
        $chapter = chapter::where('slug',$slugchapter)
            ->first();
        $max = chapter::where('product_id',$product->id)->count('id');
        $listimage = $chapter->galleries()->orderBy('id','ASC')->get();
        return view('website.showcontentpro',compact('product','listimage','chapter','max'));
    }
    public function search(Request $request){
//        $result = product::
    }
    public function prevchap($slug,$slugchapter){
        $product = product::where('slug',$slug)->where('is_published', '1')->first();
        $chapters = chapter::where('slug',$slugchapter)->first();
        $chapter = chapter::find(--$chapters->id);
        return redirect()->route('showimage',[$product->slug,$chapter->slug]);
    }
    public function nextchap($slug,$slugchapter){
        $product = product::where('slug',$slug)->where('is_published', '1')->first();
        $chapters = chapter::where('slug',$slugchapter)->first();
        $chapter = chapter::find(++$chapters->id);
        return redirect()->route('showimage',[$product->slug,$chapter->slug]);
    }
    public function authorshow($name){
        $author = $name;
        $category = category::orderBy('name','ASC')->where('is_published','1')->get();
        $products = product::orderBy('id','DESC')->where('author',$name)->where('is_published','1')->paginate(20);
        if (count($products) > 0) {
            return view('website.product', compact('category','products','author'));
        } else {
            return view('errors.404');
        }
    }
    public function contact(){
        return view('website.contact');
    }
    public function submitcontact(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'problem'=>'required',
            'message'=>'required',
        ],[
            'name.required'=>'Bạn chưa nhập tên',
            'problem.required'=>'Bạn chưa nhập email',
            'message.required'=>'bạn chưa nhập nội dung',
        ]);
        $data = [
            'name'=>$request->name,
            'problem'=>$request->problem,
            'message'=>$request->message
        ];
        Mail::to('hoaianh0123450@gmail.com')->send(new contact($data));
        Session::flash('message','Cảm ơn phản hồi của bạn');
        return redirect()->route('contact');
    }
    public function about(){
        return view('website.about');
    }

    public function showpost($slug){

        $post = post::where('slug',$slug)
            ->where('is_published','1')
            ->first();
        if($post){
            $postrelav = post::where('is_published','1')
                ->inRandomOrder()
                ->limit(4)
                ->get();
            return view('website.post',compact('post','postrelav'));
        }
       return view('errors.404');
    }
}
