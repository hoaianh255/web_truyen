@extends('layouts.adminui')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tạo bài viết</div>

                    <div class="card-body">
                        {!!  Form::open(['route' => 'posts.store', 'enctype' => 'multipart/form-data'])  !!}
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            {!! Form::label('Tiêu đề') !!}
                            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Tiêu đề']) !!}
                            @if ($errors->has('title'))
                                <span class="help-block text-danger">{!! $errors->first('title') !!}</span>@endif
                        </div>
                        <div class="form-group">
                            <p>Hình ảnh</p>
                            <img id="showimage" width="200px"height="auto" src="" alt="">
                        </div>
                        <div class="form-group @if($errors->has('image_url')) has-error @endif">
                            {!! Form::label('Ảnh') !!}
                            {!! Form::file('image_url', ['multiple' => 'multiple','id'=>'image_url']) !!}
                            @if ($errors->has('image_url'))<span
                                class="help-block">{!! $errors->first('image_url') !!}</span>@endif
                        </div>
                        <div class="form-group @if($errors->has('details')) has-error @endif">
                            {!! Form::label('Nội dung') !!}
                            {!! Form::textarea('details',old('details'), ['class' => 'form-control', 'placeholder' => 'Nội dung']) !!}
                            @if ($errors->has('details'))
                                <span class="help-block">{!! $errors->first('details') !!}</span>@endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('Đặc biệt') !!}
                            {!! Form::select('especially', [1 => 'Có', 0 => 'Không'], null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Publish') !!}
                            {!! Form::select('is_published', [1 => 'Hiển thị', 0 => 'Chờ'], null, ['class' => 'form-control']) !!}
                        </div>

                        {!! Form::submit('Create',['class' => 'btn btn-sm btn-primary']) !!}
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
