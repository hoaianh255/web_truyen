@extends('layouts.app')

@section('content')
	<div class="col-md-12 bg-white">
		<div class="row">
			<div class="col-md-12 row product m-0 p-0">
                <div class="col-md-12 bg-success">
                    <p style="font-size: 26px;margin: 0;padding: 10px 0">Thể loại</p>
                    <hr>
                    <nav class="nav nav-cate">
                        @foreach($category as $row)
                            <a class="nav-link" href="{{route('category.show',$row->slug)}}">{{$row->name}}</a>
                        @endforeach
                    </nav>
                    <select class="browser-default custom-select" onchange="location = this.value;" style="width: 200px">
                        <option <?php if(isset($up)) echo $up ?> value="{{route('order','up')}}"><a href="#">Mới nhất</a></option>
                        <option <?php if(isset($down)) echo $down ?> value="{{route('order','down')}}"><a href="">Cũ nhất</a></option>
                    </select>
                    <hr>
                </div>
                <div class="title-category col-md-12">
                    @if(isset($categoryfocus))
                        Thể loại: {{$categoryfocus->name}}
                    @elseif(isset($author))
                       Tác giả: {{$author}}
                    @else
                        Tất cả sản phẩm
                    @endif
                </div>
                @foreach($products as $row)
                    <div class="col-md-3 col-lg-2 col-sm-6 col-12 my-2 ">
                        <div class="boxsp ">
                            <div class="imgbxSp">
                                    <a href="{{route('product.show',$row->slug)}}"><img src= "{{asset("storage/$row->id/$row->thumbnail")}}" width="100%" alt="Card image cap"></a>
                            </div>
                            <div class="link-content">
                                <a href="{{route('product.show',$row->slug)}}" title="{{$row->name}}">{{\Illuminate\Support\Str::limit($row->name,18)}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{--page--}}
                <div class="clearfix pagegi mt-4">
                    {{ $products->links() }}
                </div>
			</div>
        </div>
	</div>
@endsection
