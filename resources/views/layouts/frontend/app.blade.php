<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

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
        
        {{-- Tag para que ao inicializar o sistema, faça o download do gif load --}}        
        
        <div id="app">
        </div>
        <script>
            window.app = {
                title: '{!! config('app.name') !!}',
                basePath: '{!! url('/') !!}/',
            }

            let query = location.hash.split('/');
            window.document.cookie = query[1] !== undefined ? 'hash=' + query[1] : 'hash=en';

            if(query.length === 0) {
                query.push('en');
            }

            if(query[1] === ''){
                query[1] = 'en';
            }

            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "/getTranslations/"+query[1], false);
            let token = document.head.querySelector('meta[name="csrf-token"]');
            xhttp.setRequestHeader("X-CSRF-TOKEN", token.content);
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                  window.trans = JSON.parse(this.response);
                }
            };
            xhttp.send();


            /*<?php 
                $locale = '';
                if(isset($_COOKIE['hash'])){
                    switch($_COOKIE['hash']) {
                        case 'br': {
                            $locale = 'pt_BR';
                            break;
                        }
                        case 'es': {
                            $locale = 'es_ES';
                            break;
                        }
                        default: {
                            $locale = 'en';
                            break;
                        }
                    }
                }
            ?>            

            window.trans = <?php
                $locale = isset($_GET['locale']) && !empty($_GET['locale']) ? $_GET['locale'] : $locale;
                if($locale == ''){
                    $locale = "en";
                }
                // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
                $lang_files = File::files(resource_path() . '/lang/' . $locale);
                $trans = [];
                foreach ($lang_files as $f) {
                    $filename = pathinfo($f)['filename'];
                    $trans[$filename] = trans($filename);
                }
                echo json_encode($trans);
            ?>;     */       

            window.locale = query[1];
            window.QueryString = <?php echo json_encode($_GET); ?>;
        </script>

        
        
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '218659952283316',
                    xfbml      : true,
                    version    : 'v3.0'
                });
                FB.AppEvents.logPageView();
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        
       
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-121313526-1', 'auto');
            ga('send', 'pageview');
        </script>
        
        <script type="text/javascript" src="{{ asset('frontend/js/app.js') }}"></script>
        
       {{--
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-121313526-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-121313526-1');
        </script>  --}}
    </body>
</html>
