@extends('layouts.app')
@section('content')
    <!-- <div class="spmoi">
            <div class="bgblur"></div>
            <div class="boxspN">
                <a class="link" href="#sanpham"><img src="images/sanpham/3.jpg"></a>
            </div>
            <div class="bg-text">
              <h2></h2>
              <h1 style="font-size:50px">Sức mạnh của Hashira</h1>
              <p>Tóm tắt: Ở Nhật Bản thời Taisho, Kamado Tanjiro là một cậu bé tốt bụng, kiếm sống bằng nghề bán than củi.Nhưng cuộc sống bình yên của anh tan vỡ khi một con quỷ tàn sát cả gia ình anh</p>
            </div>
            <img id="new" src="images/new-logo-png-6.png">
        </div> -->
    <div class="col-md-12 bg-white my-2 py-3">
        <h2>Sản phẩm đề cử</h2>
        <div class="slider ">
            <div class="slide-one">
                @foreach($productespec as $row)
                <div class=" block">
                    <div class="img">
                        <a href="{{route('product.show',$row->slug)}}" title=""><img src="{{asset("storage/$row->id/$row->thumbnail")}}" alt="$row->name"></a>
                    </div>

                    </a>
                    <div class="text-block text-center p-1">
                        <a href="{{route('product.show',$row->slug)}}" title="{{$row->name}}">{{\Illuminate\Support\Str::limit($row->name,18)}}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="news bg-white col-md-12 p-2">
        <ul class="menuNews">
            <h2>Thông báo</h2>
            <li><span >HOT</span><a href="#" style="color:#e53935;padding-left: 10px">[25/05/2020] Shop sẽ nhập số lượng lớn truyện Kimetsu yaiba!</a></li>
            <li><span >HOT</span><a href="#" style="color:#e53935;padding-left: 10px">[25/05/2020] Tổ chức EVENT bốc thăm trúng thưởng nhé!!</a></li>
        </ul>
    </div>

    <section id="main" class="bg-white mb-1 p-2">
        <h2>Tin tức mới cập nhật</h2>
        <div class="row">

            <div class="col-md-7" data-aos="fade-down">
                @foreach($postespec as $row)
                <div class="box1r bg-white p-1">
                    <a href="{{route('postshow',$row->slug)}}"><img src="{{asset('/storage/post/'.$row->image)}}"></a>
                    <a href="{{route('postshow',$row->slug)}}">[{{\Carbon\Carbon::parse($row->updated_at)->format('d/m/Y')}}] {{$row->title}}</a>
                </div>
                @endforeach
            </div>
            <div class="col-md-5" data-aos="fade-right">
                @foreach($postnew as $row)
                <div class="box1r bg-white p-1">
                    <a href="{{route('postshow',$row->slug)}}"><img src="{{asset('/storage/post/'.$row->image)}}"></a>
                    <a href="{{route('postshow',$row->slug)}}">[{{\Carbon\Carbon::parse($row->updated_at)->format('d/m/Y')}}] {{$row->title}}</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <section id="sanpham"class="my-1">
        <div class="col-12 p-0 bg-white">
            <h5 class="titleSp" data-aos="fade-right">Truyện <span style="padding: 3px 6px;background: #f53b57;color: #fff;border-radius: 3px;">Mới</span></h5>
            <div class="row p-2" data-aos="fade-down">
                @foreach($productnew as $row)
                <div class="col-md-3 col-lg-2 col-sm-6 col-12 my-2 ">
                    <div class="boxsp">
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
              <div class="text-center p-3">
                <a class="" style="padding: 6px 12px;background: #ff7675;border-radius: 5px;color: #ffeaa7" href="{{route('product')}}">Xem thêm</a>
            </div>
        </div>
    </section>

@endsection

