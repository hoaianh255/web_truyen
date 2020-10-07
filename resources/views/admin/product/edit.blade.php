@extends('layouts.adminui')
@section('stylesheet')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Sửa sản phẩm</div>

                    <div class="card-body">
                        {!! Form::open(['route' => ['products.update', $product->id], 'method' => 'patch','enctype' => 'multipart/form-data']) !!}
                        {!! Form::token() !!}
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            {!! Form::label('Tên') !!}
                            {!! Form::text('name', $product->name, ['class' => 'form-control', 'placeholder' => 'Tên']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block text-danger">{!! $errors->first('name') !!}</span>@endif
                        </div>
                        <div class="form-group">
                            <p>Hình ảnh</p>
                            <img id="showimage" width="200px"height="auto" src="{{asset("storage/$product->id/$product->thumbnail")}}" alt="">
                        </div>
                        <div class="form-group @if($errors->has('author')) has-error @endif">
                            {!! Form::label('Ảnh') !!}
                            {!! Form::file('image_url', ['multiple' => 'multiple','id'=>'image_url']) !!}
                            @if ($errors->has('image_url'))<span
                                class="help-block">{!! $errors->first('image_url') !!}</span>@endif
                        </div>
                        <div class="form-group @if($errors->has('author')) has-error @endif">
                            {!! Form::label('Tác giả') !!}
                            {!! Form::text('author', $product->author, ['class' => 'form-control', 'placeholder' => 'Tác giả']) !!}
                            @if ($errors->has('author'))
                                <span class="help-block text-danger">{!! $errors->first('author') !!}</span>@endif
                        </div>
                        <div class="form-group @if($errors->has('details')) has-error @endif">
                            {!! Form::label('Mô tả') !!}
                            {!! Form::textarea('details', $product->details, ['class' => 'form-control', 'placeholder' => 'Mô tả']) !!}
                            @if ($errors->has('details'))
                                <span class="help-block">{!! $errors->first('details') !!}</span>@endif
                        </div>
                        <div class="form-group @if($errors->has('category_id')) has-error @endif">
                            {!! Form::label('Danh mục') !!}
                            {!! Form::select('category_id[]', $categories, null, ['class' => 'form-control', 'id' => 'category_id', 'multiple' => 'multiple']) !!}
                            @if ($errors->has('category_id'))
                                <span class="help-block">{!! $errors->first('category_id') !!}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('Đặc biệt') !!}
                            {!! Form::select('especially', [1 => 'Có', 0 => 'Không'], isset($product->especially) ? $product->especially : null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Publish') !!}
                            {!! Form::select('is_published', [1 => 'Hiển thị', 0 => 'Chờ'], isset($product->is_published) ? $product->is_published : null, ['class' => 'form-control']) !!}
                        </div>

                        {!! Form::submit('Update',['class' => 'btn btn-sm btn-warning']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            CKEDITOR.replace('details');

            $('#category_id').select2({
                placeholder: "Select categories"
            }).val({!! json_encode($product->categories()->allRelatedIds()) !!}).trigger('change');

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#showimage').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#image_url").change(function() {
                readURL(this);
            });
        });
    </script>
@endsection
