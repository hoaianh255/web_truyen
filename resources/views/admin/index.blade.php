@extends('layouts.adminui')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Danh mục mới</div>

                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col" width="60">#</th>
                                <th scope="col" width="60">Tên</th>
                                <th scope="col" width="200">Trang thái</th>
                                <th scope="col" width="200">Ngày tạo</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td><a href="{{route('categories.show',$category->id)}}">{{ $category->name }}</a></td>
                                    <td>
                                        @if($category->is_published == 1)
                                            Đang hiển thị
                                        @else
                                            Chờ xử lý
                                        @endif
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($category->created_at)->format('d/m/Y')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">Sản phẩm mới</div>

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
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">Tài khoản mới</div>

                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col" width="60">#</th>
                                <th scope="col" width="60">Name</th>
                                <th scope="col" width="60">Email</th>
                                <th scope="col" width="200">Created By</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{\Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</td>
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
