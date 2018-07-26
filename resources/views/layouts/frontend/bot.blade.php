<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @yield('title')
        </title>
        
        <meta name="google-site-verification" content="7QPAEavdugQkBD7dCM9zMNHTMvl30D4HCggtbe_2i9Y" />

        <meta name="keywords" content="Lottoyou, lotto, lottery, loteria, apostas online, loterias online,games, bet, bet365, bet188, lottoland, soccer, soccer expert, bolão, futebol, raspadinha, , loterias mais faceis do mundo, palpites, cartola, apostas esportivas, jogos de azar, prêmios.">
        <meta name="description" content="@yield('description')">
        <meta name="author" content="@yield('author')">

        <meta property="og:url" content="{{request()->root()}}"/>
        <meta property="og:type" content="product" />
        <meta property="og:title" content="@yield('title')" />
        <meta property="og:description" content="@yield('description')" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- <link href="/fonts/vendor/font-intersate/Interstate-Regular_24143.ttf" rel="stylesheet" type="text/css"> -->
        <style type="text/css">
            @font-face {
                font-family: "Interstate";
                src: url(/fonts/vendor/font-intersate/Interstate-UltraBlackItalic_24187.ttf) format("truetype");
            }
            @font-face {
                font-family: "OstrichSans-Heavy";
                src: url(/fonts/vendor/font-ostrich-sans-heavy/OstrichSans-Heavy.otf) format("truetype");
            }
            @font-face {
                font-family: "Impact";
                src: url(/fonts/vendor/font-impact/Impact.ttf) format("truetype");
            }
        </style>
        <link href="{{ asset('frontend/css/app.css') }}" rel="stylesheet" type="text/css">
        {{-- <link rel="shortcut icon" type="image/png" href="/favicon.ico"/> --}}

        <link rel="icon" type="image/x-icon" href="/public/favicon.ico" />
    </head>
    <body>
        <main>
            @include('frontend.includes.header')

            <section class="content">
                <div>
                    @yield('content')
                </div>
            </section>

            @include('frontend.includes.footer')
        </main>
    </body>
</html>
