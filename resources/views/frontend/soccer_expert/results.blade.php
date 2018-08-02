@section('title', trans('strings.result').' | '.$soccer->nome)

@extends('layouts.frontend.bot')

@section('content')

    <div class="container">
        <!-- <h3 class="">&nbsp;</h3> -->
        <div class="sub-navigation">
			<a href="{{route('frontend.soccer_expert.play', $soccer->slug)}}" class="show" id="play-component">
                {{ trans('strings.play_on_the') }} {{ $soccer->nome }} 
            </a>
            <a href="{{route('frontend.soccer_expert.results', $soccer->slug)}}" class="show active" id="result-component">
                {{ trans('strings.results') }}
           	</a>
           	<a href="{{route('frontend.soccer_expert.ranks', $soccer->slug)}}" class="show" id="result-component">
                {{ trans('strings.rank') }}
           	</a>
        </div>

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
    
            <div class="row no-margin table-body">
                @foreach($tickets as $ticket)
                    <section class="col-lg-12 line">
                        <div class="row columns no-margin">
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