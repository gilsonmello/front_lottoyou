@section('keywords')

@endsection

@extends('layouts.frontend.bot')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="sub-navigation">
                <a href="{{route('frontend.lotteries.play', $lottery->slug)}}" class="active show active router-link-active" id="play-component">
                    {{ trans('strings.play_on_the') }} {{$lottery->nome}}
                </a> 
                <a href="{{route('frontend.lotteries.results', $lottery->slug)}}" class="show" id="result-component">
                    {{ trans('strings.results') }}
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-6 col-md-6 col-sm-6">
            <h1 class="page-header" style="margin-top: 0; border: none;">
                {{$lottery->nome}}
            </h1>
        </div>
        <div class="col-lg-6 col-6 col-md-6 col-sm-6">
            <button class="btn btn-md btn-back pull-right btn-primary">
                {{ trans('strings.back') }}
            </button>
        </div>
    </div>
    
@endsection