@section('keywords')

@endsection

@extends('layouts.frontend.bot')

@section('content')
    
    <section class="container">
		<div class="sub-navigation">
			<a href="{{ route('frontend.lotteries.play', $lottery->slug) }}" class="show" id="play-component">
                {{ trans('strings.play_on_the') }} {{ $lottery->nome }} 
            </a>
            <a href="{{ route('frontend.lotteries.play', $lottery->slug) }}" class="show active" id="result-component">
                {{ trans('strings.results') }}
           	</a>
        </div>
        
        <h1 class="page-header" style="margin-top: 0; border: none;">
           {{ trans('strings.results') }}
        </h1>

		<div class="table text-center">
        	<div class="row no-margin table-head">
                <div class="col-lg-2">
                    <span>
                        {{ trans('strings.sweepstake') }}
                    </span>
                </div>
                <div class="col-lg-2">
                    <span>
                        {{ trans('strings.jackpot') }}
                    </span>
                </div>

                <div class="col-lg-2">
                    <span>
                        {{ trans('strings.date_end') }}
                    </span>
                </div>

                <div class="col-lg-2">
                    <span>
                        {{ trans('strings.contest') }}
                    </span>
                </div>
		    </div>

	        <div class="row no-margin table-body">
                
                @foreach($sweepstakes as $key => $sweepstake)
                    <section class="col-lg-12 line">
                        <div class="row columns collapsed no-margin">
                            <div class="col-lg-2">
                                {{ $sweepstake->sorteio }}
                            </div>
                            <div class="col-lg-2">
                                {{ $sweepstake->concurso }}
                            </div>
                            <div class="col-lg-2">
                                ${{ $sweepstake->premio }}
                            </div>
                            <div class="col-lg-2">
                                {{ $sweepstake->data_fim }}
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
                    <label>Total {!! $sweepstakes->total() !!}</label>
                </div>
                <div class="pull-right">
                    {!! $sweepstakes->render() !!}
                </div>
            </div>
        </div>


	</section>




@endsection