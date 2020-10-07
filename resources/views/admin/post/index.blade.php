@extends('layouts.adminui')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ Session('message') }}
                    </div>
                @endif

                    @if(Session::has('delete-message'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ Session('delete-message') }}
                        </div>
                    @endif
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Danh sách bài viết
                        <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary float-right">Thêm
                            Mới</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col" width="60">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Đặc biệt</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col" width="200">Ngày tạo</th>
                                <th scope="col" width="129">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td><a href="{{route('posts.show',$post->id)}}">{{ $post->title }}</a></td>
                                    <td>
                                        @if($post->especially == 1)
                                           Có
                                        @else
                                            Không
                                        @endif
                                    </td>
                                    <td>
                                        @if($post->is_published == 1)
                                            Đang hiển thị
                                        @else
                                            Chờ xử lý
                                        @endif
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</td>
                                    <td>
                                        <a href="{{ route('postshow', $post->slug) }}"
                                           class="btn btn-sm btn-primary">Xem</a>
                                        <a href="{{ route('posts.edit', $post->id) }}"
                                           class="btn btn-sm btn-primary">Sửa</a>
                                        {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
                                        {!! Form::submit('Xóa', ['class' => 'btn btn-sm btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
