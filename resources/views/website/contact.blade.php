@extends('layouts.app')
@section('content')
    <section id="contact" class="my-1">
        <div class="col-12 p-0 bg-white">
            <h5 class="titleCot" data-aos="fade-right">Báo cáo</h5>
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session('message')}}
                </div>
            @endif
            <div class="row p-0 m-0 justify-content-center">
                <div class="col-md-6 col-12" data-aos="fade-right">
                    <div class="card-body">
                        {!! Form::open(['route' => 'contact.submit']) !!}
                        <div class="form-group @if($errors->has('name')) has-error @endif">
                            {!! Form::label('Tên') !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Tên']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block text-danger">{!! $errors->first('name') !!}</span>@endif
                        </div>
                        <div class="form-group @if($errors->has('author')) has-error @endif">
                            {!! Form::label('Vấn đề') !!}
                            {!! Form::text('problem', old('problem'), ['class' => 'form-control', 'placeholder' => 'Vấn đề']) !!}
                            @if ($errors->has('problem'))
                                <span class="help-block text-danger">{!! $errors->first('problem') !!}</span>@endif
                        </div>
                        <div class="form-group @if($errors->has('details')) has-error @endif">
                            {!! Form::label('Mô tả') !!}
                            {!! Form::textarea('message',old('message'), ['class' => 'form-control', 'placeholder' => 'Mô tả']) !!}
                            @if ($errors->has('message'))
                                <span class="help-block">{!! $errors->first('message') !!}</span>@endif
                        </div>

                        {!! Form::submit('Gửi',['class' => 'btn btn-sm btn-warning']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
