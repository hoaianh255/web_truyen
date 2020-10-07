@extends('layouts.app')
@section('content')

<div class="col-md-12 m-0 info-product ">
		<div class="row">
			<div class="col-md-9">
				<div class="content  text-light">
			<h5>Thể loại:
                @if(count($product->categories) > 0)
                    @foreach($product->categories as $category)
                    <a href="{{url('category/'.$category->slug)}}"> {{$category->name}}</a>@if(!$loop->last),@endif
                    @endforeach
                @endif
               </h5>
			<h1>{{$product->name}}</h1>
			<h5>Tác giả: <a href="{{route('author.show',$product->author)}}">{{$product->author}}</a></h5>
		</div>
		<div class="control my-2">
            @if(count($chapter) > 0)
                <a href="{{route('showimage',[$product->slug,$chapterfirst->slug])}}">Bat dau xem chuong 1</a>
                <a href=""><i class="fas fa-heart"></i></a>
                <a href=""><i class="fas fa-share"></i></a>
                <a href=""><i class="fas fa-star"></i></a>
            @endif
		</div>
			</div>
			<div class="col-md-3">
				<img src="{{asset("storage/$product->id/$product->thumbnail")}}" width="100%">
			</div>
		</div>
	</div>
	<div class="noidung bg-white col-md-12 py-md-5">
		<div class="block-noidung mt-md-2">
			<h2>Giới thiệu</h2>
			<div class="text-noidung">
				<div class="infonoidung p-md-2">
					<span style="color: #999"><i class="fas fa-eye"></i> 132.1M luot xem</span>
					<span style="color: #999;margin-left: 20px"><i class="fas fa-thumbs-up"> 2.4M like</i></span>
				</div>
				<div class="text-description">
					{!! $product->details !!}
				</div>
			</div>
		</div>
        <div class="block-noidung mt-md-2">
            <h2>Chương</h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Tên</th>
                    <th>Cập nhật</th>
                    <th>Lượt xem</th>
                </tr>
                </thead>
                <tbody>
                @if(count($chapter) > 0)
                @foreach($chapter as $row)
                    <tr>
                         <td><a href="{{route('showimage',[$product->slug,$row->slug])}}">Chương {{$row->chapter.':'.$row->name}}</a></td>
                        <td>{{date('m/d/Y', strtotime($row->created_at))}}</td>
                        <td>1239</td>
                    </tr>
                @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="row p-0 py-2 m-0 productrelative" data-aos="fade-down">
            <h2 class="col-lg-12">Sản phẩm cùng thể loại</h2>
            @foreach($productrelative as $row)
                <div class="col-md-3 col-lg-2 col-sm-6 col-12 my-2 ">
                    <div class="boxsp ">
                        <div class="imgbxSp">
                            <a href="{{route('product.show',$row->slug)}}"><img src="{{asset("storage/$row->id/$row->thumbnail")}}" width="100%" height="auto"></a>
                        </div>
                        <div class="link-content p-1">
                            <a href="{{route('product.show',$row->slug)}}" title="{{$row->name}}">{{\Illuminate\Support\Str::limit($row->name,18)}}</a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
		<div class="block-noidung mt-md-2">
			<h2>Bình luận</h2>
            @comments([
            'model' => $product,
            'approved' => true
            ])
		</div>
	</div>
@endsection
