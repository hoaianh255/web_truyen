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
                        Danh sách sản phẩm
                        <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary float-right">Thêm mới</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col" width="60">#</th>
                                <th scope="col" width="60">Tên</th>
                                <th scope="col" width="200">Tác giả</th>
                                <th scope="col" width="200">Đặc biệt</th>
                                <th scope="col" width="200">Trạng thái</th>
                                <th scope="col" width="200">Ngày tạo</th>
                                <th scope="col" width="129">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td><a href="{{route('products.chapters.index',$product->id)}}">{{ $product->name }}</a></td>
                                    <td>{{ $product->author}}</td>
                                    <td>
                                        @if($product->especially == 1)
                                            Có
                                        @else
                                            Không
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->is_published == 1)
                                            Đang hiển thị
                                        @else
                                            Chờ xử lý
                                        @endif
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}</td>
                                    <td>
                                        <a href="{{ asset(url('product', $product->slug)) }}"
                                           class="btn btn-sm btn-info">Xem</a>
                                        <a href="{{ route('products.edit', $product->id) }}"
                                           class="btn btn-sm btn-primary">Sửa</a>
                                        {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
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
