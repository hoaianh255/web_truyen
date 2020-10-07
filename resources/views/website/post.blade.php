@extends('layouts.app')
@section('content')
    <div class="bg-light p-3 postshow">
        <h1 class="text-danger text-center">{{$post->title}}</h1>
        {!! $post->details !!}
    </div>
    <div class="post-relative row p-0 m-0 bg-light">
        <p style="font-size: 34px;color: red" class="col-lg-12">Có thể bạn sẽ thích</p>
        @foreach($postrelav as $row)
        <div class="col-md-4 col-lg-3 col-sm-6 col-12 my-2 ">
            <div class="boxsp ">
                <div class="imgbxSp">
                    <a href="{{route('postshow',$row->slug)}}"><img src="{{asset("storage/post/$row->image")}}" width="100%" height="auto"></a>
                </div>
                <div class="link-content p-1">
                    <a href="{{route('postshow',$row->slug)}}" title="{{$row->title}}">[{{\Carbon\Carbon::parse($row->updated_at)->format('d/m/Y')}}]{{\Illuminate\Support\Str::limit($row->title,18)}}</a>
                </div>

            </div>
        </div>
        @endforeach
    </div>
@endsection
