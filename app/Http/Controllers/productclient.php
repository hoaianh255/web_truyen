<?php

namespace App\Http\Controllers;

use App\category;
use App\product;
use Illuminate\Http\Request;

class productclient extends Controller
{
    public function orderby($orderby){
        $category = category::orderBy('name','ASC')
            ->where('is_published','1')
            ->get();
        if ($orderby == 'up'){
            $products = product::join('category_products','products.id','=','category_products.product_id')
                ->join('categories','categories.id','=','category_products.category_id')
                ->where('categories.is_published','1')
                ->where('products.is_published','1')
                ->orderBy('id','DESC')
                ->select('products.*')
                ->distinct()
                ->simplepaginate(18);
            $up = 'selected';
            return view('website.product',compact('category','products','up'));
        }else{
            $products = product::join('category_products','products.id','=','category_products.product_id')
                ->join('categories','categories.id','=','category_products.category_id')
                ->where('categories.is_published','1')
                ->where('products.is_published','1')
                ->orderBy('id','asc')
                ->select('products.*')
                ->distinct()
                ->simplepaginate(18);
            $down = 'selected';
            return view('website.product',compact('category','products','down'));
        }

    }
}
