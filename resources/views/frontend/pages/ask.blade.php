@section('title', trans('strings.ask') .' | '.trans('strings.lottoyou'))

@section('description', '')

@section('author', trans('strings.lottoyou'))

@extends('layouts.frontend.bot')

@section('content')
    <div class="container">
        <h1 class="page-header text-justify" style="border: none; margin: 44px 0 0;">
            {{ trans('strings.ask') }}
        </h1>

        <h6>
            Sinta-se a vontade para nos enviar uma mensagem.
            <br>Pode ser uma dúvida, sugestão, crítica, elogio ou qualquer outro assunto, sua mensagem será bem vinda! Entre em contato com nosso e-mail: contato@lottoyou.bet
        </h6>
    </div>
@endsection