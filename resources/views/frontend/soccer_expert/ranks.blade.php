@section('title', trans('strings.rank').' | '.$soccer->nome)

@extends('layouts.frontend.bot')

@section('content')

    <div class="container">
        <!-- <h3 class="">&nbsp;</h3> -->
        <div class="sub-navigation">
			<a href="{{route('frontend.soccer_expert.play', $soccer->slug)}}" class="show" id="play-component">
                {{ trans('strings.play_on_the') }} {{ $soccer->nome }} 
            </a>
            <a href="{{route('frontend.soccer_expert.results', $soccer->slug)}}" class="show" id="result-component">
                {{ trans('strings.results') }}
           	</a>
           	<a href="{{route('frontend.soccer_expert.ranks', $soccer->slug)}}" class="show active" id="result-component">
                {{ trans('strings.rank') }}
           	</a>
        </div>

        <h1 class="page-header" style="margin-top: 0; border: none;">
            {{ $soccer->nome }}
        </h1>
        

        <div class="table text-center">
            <div class="row no-margin table-head">
                <div class="col-lg-4 col-4 col-sm-4 col-md-4 table-column">
                    <span>
                        {{ trans('strings.name') }}
                    </span>
                </div>
                <div class="col-lg-3 col-3 col-sm-3 col-md-3 table-column">
                    <span>
                        {{ trans('strings.value') }}
                    </span>
                </div>
                <div class="col-lg-4 col-4 col-sm-4 col-md-4 table-column">
                    <span>
                        {{ trans('strings.date_end') }}
                    </span>
                </div>
            </div>


            <div class="row no-margin table-body" >
                @foreach($tickets as $ticket)
                    <section class="col-lg-12 line">
                        <div class="row columns collapsed no-margin">
                            <div class="col-lg-4 col-md-4 col-4 col-sm-4">
                                {{ $ticket->nome }}
                            </div>
                            <div class="col-lg-3 col-3 col-sm-3 col-md-3">
                                $ {{ $ticket->valor }}
                            </div>
                            <div class="col-lg-4 col-4 col-sm-4 col-md-4">
                                {{ $ticket->data_termino }}
                            </div>
                        </div>
                
                        
                        <div class="row no-margin">
                            @foreach($ticket->groups as $group)
                                <div class="col-lg-4 col-sm-6 col-md-6 col-12">
                                    <div class="group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <img src="{{$ticket->imagem_capa}}" class="img-fluid">
                                            </div>
                                            <div class="col-lg-6">
                                                <h5>{{ trans('strings.group') }} #{{ $group->identificacao }}</h5>
                                                <h5>{{ trans('strings.quantity') }} {{ $group->count }}</h5>
                                                <h5>
                                                    {{ $group->status == 1 ? trans('strings.available') : trans('strings.unavailable') }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    
                    </section>
                @endforeach                    
            </div>
        </div> 	
    
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="pull-left">
                    <br>
                    <label>Total {!! $tickets->total() !!}</label>
                </div>
                <div class="pull-right">
                    {!! $tickets->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection