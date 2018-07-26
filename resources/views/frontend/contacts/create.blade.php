@section('title', trans('strings.contact_us') .' | '.trans('strings.lottoyou'))

@section('description', trans('strings.contact_us'))

@section('author', trans('strings.lottoyou'))

@extends('layouts.frontend.bot')

@section('content')
    <div class="container">
        <h2 class="page-header">{{ trans('strings.contact_us') }}</h2>
        <form id="contacts-create">
            <div class="row">
                <div class="col-lg-3 col-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        {!! Form::label('name', trans('strings.name').' *', ['class' => '']) !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('strings.name')]) !!}
                    </div>
                </div>
                <div class="col-lg-3 col-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        {!! Form::label('email', trans('strings.email').' *', ['class' => '']) !!}
                        {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('strings.email')]) !!}
                    </div>
                </div>
                <div class="col-lg-3 col-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        {!! Form::label('category_id', trans('strings.categories').' *', ['class' => '']) !!}
                        {!! Form::select('category_id', $categories->pluck('name', 'id')->all(), old('category_id'),
                            [
                                'style' => 'width: 100%;',
                                'class' => '',
                                'data-placeholder' => trans('strings.categories')
                            ])
                        !!}
                    </div>
                </div>
                <div class="col-lg-3 col-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        {!! Form::label('subject', trans('strings.subject').' *', ['class' => '']) !!}
                        {!! Form::text('subject', old('subject'), ['class' => 'form-control', 'placeholder' => trans('strings.subject')]) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-12 col-sm-12 col-md-12">
                    <label for="file">{{ trans('strings.file') }} (jpg, png ou pdf)</label><br>
                    <span class="btn btn-primary btn-xs">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>{{ trans('strings.select_an_file') }}</span>
                        <input class="file" accept="image/*,application/pdf" type="file" name="file" id="file">
                    </span>
                    <span class="file-name">{{ trans('strings.no_file_selected') }}</span>
                    <label>Tamanho de arquivo até 5mb*</label>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        {!! Form::label('description', trans('strings.description').' *', ['class' => '']) !!}
                        {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => trans('strings.description')]) !!}
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12 col-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-md btn-primary">
                        {{ trans('strings.save_button') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection