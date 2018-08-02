@section('title', trans('strings.soccer_expert'))

@extends('layouts.frontend.bot')

@section('content')

    <div class="container">
		<div class="row page-header">
        	<div class="col-lg-12 col-12 col-md-12 col-sm-12">
        		<h1 style="display: inline">
                    {{ trans('strings.soccer_expert') }}
                </h1>
                <a href="{{route('frontend.how_to_play_soccer_expert')}}" class="btn btn-md btn-primary pull-right">
					{{ trans('strings.how_to_play') }} {{ trans('strings.soccer_expert') }}
				</a>
        	</div>
        </div>
    
        <div class="row">
            @foreach($soccers as $key => $value)
            <div class="col-12 col-md-6 col-sm-6 col-lg-4">
                <div class="soccer-expert">
                    <header class="soccer-expert-header">
                        @if($value->new == 1)
                            <div class="extras">
                                <img src="/img/new.png" alt="new" class="game-badge">
                            </div>
                        @endif
                        <img class="header-image img-fluid" alt="{{$value->nome}}" src="{{$value->imagem_capa}}">
                        <div class="descript">
                            <h2 class="ng-binding">{{ $value->nome }}</h2>
                            <p class="ng-binding">{{ $value->descricao }}</p>
                        </div>
                    </header>

                    <div class="soccer-expert-body">
                        <div class="amount">
                            {{ $value->nome }}
                        </div>
                        <div class="jackpot-table">
                            <div class="row vcenter">
                                <div class="col-lg-8 col-12 col-md-8 col-sm-12">
                                    <a href="#" class="btn description">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                        &nbsp;
                                        Tabela de Premios
                                    </a>
                                </div>
                                <!-- <div class="col-lg-4 col-12 col-md-4 col-sm-12">
                                    <a @click.prevent="handleDemo($event)" :data-id="soccer_expert.id" href="#" class="btn btn-md demo">
                                        Demo
                                    </a>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <footer class="soccer-expert-footer">
                        <div class="row vcenter" style="margin-top: 15px; background: none;">
                            <div class="col-12 col-md-12 col-xs-12 col-sm-12 text-center">
                                <a class="btn btn-primary btn-md play" href="{{route('frontend.soccer_expert.play', $value->slug)}}">
                                    {{ trans('strings.to_enter') }}
                                </a>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-sm-6 col-lg-4 no-mobile">
            </div>
            <div class="col-12 col-md-6 col-sm-6 col-lg-4">
                <a href="{{route('frontend.create_your_league')}}" class="btn create_your_league btn-md btn-warning">
                    {{ trans('strings.create_your_own_league') }}
                </a>
            </div>
            <div class="col-12 col-md-6 col-sm-6 col-lg-4 no-mobile">
                
            </div>			
        </div>
    </div>

@endsection