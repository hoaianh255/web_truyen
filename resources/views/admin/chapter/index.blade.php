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
                        Danh sách chương
                        <a href="{{route('products.chapters.create',$product)}}" class="btn btn-sm btn-primary float-right">Thêm
                            Mới</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col" width="60">Tập</th>
                                <th scope="col">Tên</th>
                                <th scope="col" width="200">Ngày tạo</th>
                                <th scope="col" width="129">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($chapters as $row)
                                <tr>
                                    <td>{{ $row->chapter }}</td>
                                    <td><a href="{{ url("product/$slug/$row->slug/$row->id") }}">{{ $row->name }}</a></td>
                                    <td>{{\Carbon\Carbon::parse($row->created_at)->format('d/m/Y')}}</td>
                                    <td> <a href="{{ url("product/$slug/$row->slug/$row->id") }}"
                                            class="btn btn-sm btn-primary">Xem</a>
                                        {!! Form::open(['route' => ['products.chapters.destroy',[$product, $row->id]], 'method' => 'delete', 'style' => 'display:inline']) !!}
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
