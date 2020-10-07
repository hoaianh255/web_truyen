@extends('layouts.app')
@section('content')
<div class="row bg-light p-0 m-0">
    <div class="col-md-8 row">
        @foreach($posts as $row)
            <div class="col-md-12  border-bottom border-dark py-2 m-2">
                <div class="boximage" style="width: 40%;float: left">
                    <img src="{{asset('/storage/post/'.$row->image)}}" width="100%" height="auto" alt="">
                </div>
                <div class="content-details p-2" style="width: 60%;float: left">
                    <a href="{{route('postshow',$row->slug)}}" style="font-size: 24px;display: block">{{$row->title}}</a>
                    <i>Cập nhật: {{{\Carbon\Carbon::parse($row->updated_at)->format('d/m/Y')}}}</i>
                    <p>{!!str_limit($row->details,150)!!}</p>
                </div>
            </div>
        @endforeach

    </div>
</div>
 @endsection
