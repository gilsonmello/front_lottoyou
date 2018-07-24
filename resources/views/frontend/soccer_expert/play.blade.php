@section('title', trans('strings.play').' | '.$soccer->nome)

@extends('layouts.frontend.bot')

@section('content')
    <div class="container">
		<div class="row">
        	<div class="col-lg-12">
        		<div class="sub-navigation">
                    <a href="{{route('frontend.soccer_expert.play', $soccer->slug)}}" class="active show">
	                    {{ trans('strings.play_on_the') }} {{ $soccer->nome }}
	                </a>
	                <a href="{{route('frontend.soccer_expert.results', $soccer->slug)}}" class="show">
	                    {{ trans('strings.results') }}
	               	</a>
	               	<a href="{{route('frontend.soccer_expert.ranks', $soccer->slug)}}" class="show">
		                {{ trans('strings.rank') }}
		           	</a>
        		</div>
        	</div>
        </div>	
       	
       	<div class="row">
        	<div class="col-lg-6 col-6 col-md-6 col-sm-6">
        		<h4 class="page-header" style="margin-top: 0; border: none;">
					{{ $soccer->nome }}
				</h4>
        	</div>
        </div>

	</div>
@endsection