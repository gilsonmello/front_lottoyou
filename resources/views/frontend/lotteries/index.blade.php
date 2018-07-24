@section('title', trans('strings.lotteries'))

@extends('layouts.frontend.bot')

@section('content')
    <div class="container">
        <div class="row page-header">
        	<div class="col-lg-12 col-12 col-md-12 col-sm-12">
        		<h1 style="display: inline">{{ trans('strings.lotteries') }}</h1>
                <a href="{{route('frontend.how_to_play_easy_money')}}" class="btn btn-md btn-primary pull-right">
					{{ trans('strings.how_to_play') }} {{ trans('strings.lottery') }}
                </a>
        	</div>
        </div>

        @if(count($lotteries) == 0)
            <div class="row">
                <div class="col-lg-12">
                    <h3>Nenhuma loteria disponível no momento</h3>
                </div>				
            </div>
        @endif

		<div class="row">
            @foreach($lotteries as $key => $lottery)
			    <div class="col-lg-4 col-12 col-md-6 col-sm-6">				
                    <div class="tickets">
                        <header class="tickets-header">
                            @if($lottery->new == 1)
                                <div class="extras">
                                    <img src="/img/new.png" alt="new" class="img-fluid">
                                </div>
                            @endif
                            <img class="header-image img-fluid" alt="{{$lottery->nome}}" src="{{$lottery->img_loteria}}">
                            <div class="descript">
                                <h2 class="ng-binding">
                                    {{ $lottery->nome }}
                                </h2>
                                <p>Realize seu sonho por apenas 1 dólar</p>
                            </div>
                        </header>
                        <div class="tickets-body">
                            {{-- <div class="amount">
                                <span class="countdown">
                                    <span v-if="days > 1">
                                        {{ days }} {{ trans('strings.days') }} e
                                    </span>
                                    <span v-else-if="days == 1">
                                        {{ days }} {{ trans('strings.day') }} e
                                    </span>				
                                    {{ hours }}:{{ minutes }}:{{ seconds }} {{ trans('strings.hours_left') }}
                                </span>
                            </div> --}}
                            <div class="jackpot-table">
                                <div class="row vcenter">
                                    <div class="col-lg-8 col-12 col-md-8 col-sm-12">
                                        <a href="#" class="btn description">
                                            <i class="fa fa-money" aria-hidden="true"></i>
                                            &nbsp;
                                            Tabela de Premios
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <footer class="tickets-footer">
                            <a href="{{route('frontend.lotteries.play', $lottery->slug)}}" class="btn btn-md btn-primary">
                                {{ trans('strings.play_now') }}
                            </a>
                        </footer>
                    </div>
                </div>
            @endforeach
		</div>
    </div>
@endsection