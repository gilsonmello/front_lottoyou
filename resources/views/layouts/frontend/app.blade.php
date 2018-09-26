<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <meta name="fragment" content="!">
        <meta name="google-site-verification" content="7QPAEavdugQkBD7dCM9zMNHTMvl30D4HCggtbe_2i9Y" />

        <meta name="keywords" content="Lottoyou, lotto, lottery, loteria, apostas online, loterias online,games, bet, bet365, bet188, lottoland, soccer, soccer expert, bolão, futebol, raspadinha, , loterias mais faceis do mundo, palpites, cartola, apostas esportivas, jogos de azar, prêmios.">
        <meta name="description" content="Lottoyou, lotto, lottery, loteria, apostas online, loterias online,games, bet, bet365, bet188, lottoland, soccer, soccer expert, bolão, futebol, raspadinha, , loterias mais faceis do mundo, palpites, cartola, apostas esportivas, jogos de azar, prêmios.">
        <meta name="author" content="Lottoyou">

        <meta property="og:url" content="{{request()->root()}}"/>
        <meta property="og:type" content="product" />
        <meta property="og:title" content="Lottoyou, lotto, lottery, loteria, apostas online, loterias online,games, bet, bet365, bet188, lottoland, soccer, soccer expert, bolão, futebol, raspadinha, , loterias mais faceis do mundo, palpites, cartola, apostas esportivas, jogos de azar, prêmios." />
        <meta property="og:description" content="Lottoyou, lotto, lottery, loteria, apostas online, loterias online,games, bet, bet365, bet188, lottoland, soccer, soccer expert, bolão, futebol, raspadinha, , loterias mais faceis do mundo, palpites, cartola, apostas esportivas, jogos de azar, prêmios." >

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        
        {{-- <link rel="shortcut icon" type="image/png" href="/favicon.ico"/> --}}

        <link rel="icon" type="image/x-icon" href="/public/favicon.ico" />
        <style type="text/css">
            #app {
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>
    </head>
    <body>
       <div id="app">
            <img src="/img/home.jpeg">
        </div>
    </body>
</html>
