@extends('layouts.adminui')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Chapter - create</div>

                    <div class="card-body">
                        {!! Form::open(['route' => ['products.chapters.store',$product],'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group @if($errors->has('chapter')) has-error @endif">
                            {!! Form::label('Tập số') !!}
                            {!! Form::text('chapter', null, ['class' => 'form-control', 'placeholder' => 'Nhập số tập']) !!}
                            @if ($errors->has('chapter'))
                                <span class="help-block text-danger">{!! $errors->first('chapter') !!}</span>@endif

                        </div>
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            {!! Form::label('Tên') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block text-danger">{!! $errors->first('name') !!}</span>@endif
                        </div>
                        <div class="form-group @if($errors->has('author')) has-error @endif">
                            {!! Form::label('Ảnh') !!}
                            {!! Form::file('image_url[]', ['multiple' => 'multiple']) !!}
                            @if ($errors->has('image_url'))<span
                                class="help-block">{!! $errors->first('image_url') !!}</span>@endif
                        </div>
                        {!! Form::submit('Create',['class' => 'btn btn-sm btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
