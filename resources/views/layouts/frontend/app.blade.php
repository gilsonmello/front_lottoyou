<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            {{ config('app.name') }}
        </title>

        <meta name="fragment" content="!">
        <meta name="google-site-verification" content="7QPAEavdugQkBD7dCM9zMNHTMvl30D4HCggtbe_2i9Y" />

        <meta name="keywords" content="Lottoyou, lotto, lottery, loteria, apostas online, loterias online,games, bet, bet365, bet188, lottoland, soccer, soccer expert, bolão, futebol, raspadinha, , loterias mais faceis do mundo, palpites, cartola, apostas esportivas, jogos de azar, prêmios.">
        <meta name="description" content="Lottoyou, lotto, lottery, loteria, apostas online, loterias online,games, bet, bet365, bet188, lottoland, soccer, soccer expert, bolão, futebol, raspadinha, , loterias mais faceis do mundo, palpites, cartola, apostas esportivas, jogos de azar, prêmios.">
        <meta name="author" content="Lottoyou">

        <meta property="og:url" content="{{request()->root()}}"/>
        <meta property="og:type" content="product" />
        <meta property="og:title" content="Lottoyou, lotto, lottery, loteria, apostas online, loterias online,games, bet, bet365, bet188, lottoland, soccer, soccer expert, bolão, futebol, raspadinha, , loterias mais faceis do mundo, palpites, cartola, apostas esportivas, jogos de azar, prêmios." />
        <meta property="og:description" content="Lottoyou, lotto, lottery, loteria, apostas online, loterias online,games, bet, bet365, bet188, lottoland, soccer, soccer expert, bolão, futebol, raspadinha, , loterias mais faceis do mundo, palpites, cartola, apostas esportivas, jogos de azar, prêmios." 

        <!-- Font -->
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
        <link href="{{ mix('frontend/css/app.css') }}" rel="stylesheet" type="text/css">
        <style>
            .first-load {
                font-size: 100px;
                color: #003874;
            }
        </style>
        {{-- <link rel="shortcut icon" type="image/png" href="/favicon.ico"/> --}}

        <link rel="icon" type="image/x-icon" href="/public/favicon.ico" />

        <script> window.prerenderReady = false; </script>
    </head>
    <body>
        <div class="app-loading" id="prerendered-content">
            <i class="fa fa-refresh fa-spin first-load"></i>
        </div>
        
        <div id="app">
        </div>

        <?php 
            /*$email = "<script>document.write(window.localStorage.getItem('access_token'));</script>";
            echo "Olá $email";*/
        ?>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
        <script>
           
            window.app = {
                title: '{!! config('app.name') !!}',
                basePath: '{!! url('/') !!}/',
            };
            let query = location.pathname.split('/');
            
            if(query.length === 0) {
                query.push('en_US');
            }
            if(query[1] === ''){
                query[1] = 'en_US';
            }
            if(query[1] != 'en_US' && query[1] != 'es_ES' && query[1] != 'pt_BR') {
                query[1] = 'en_US';
            }
            if (query[1] !== undefined) {
                Cookies.set('hash', query[1], { domain: '{!! config("session.domain") !!}' }) 
            } else { 
                Cookies.set('hash', 'en_US', { domain: '{!! config("session.domain") !!}' });
            }
            
            if (query[1] !== undefined) { 
                Cookies.set('locale', query[1], { domain: '{!! config("session.domain") !!}' }) 
            } else {
                Cookies.set('locale', 'en_US', { domain: '{!! config("session.domain") !!}' });
            }         
            
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "/api/getTranslations/"+query[1], false);
            let token = document.head.querySelector('meta[name="csrf-token"]');
            xhttp.setRequestHeader("X-CSRF-TOKEN", token.content);
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                  window.trans = JSON.parse(this.response);
                }
            };
            xhttp.send(); 
            <?php /*
                $locale = '';
                if(isset($_COOKIE['locale'])){
                    switch($_COOKIE['locale']) {
                        case 'pt_BR': {
                            $locale = 'pt_BR';
                            break;
                        }
                        case 'es_ES': {
                            $locale = 'es_ES';
                            break;
                        }
                        default: {
                            $locale = 'en_US';
                            break;
                        }
                    }
                }
            */?>
            /*window.trans = <?php
/*                //$locale = isset($_COOKIE['locale']) && !empty($_COOKIE['locale']) ? $_COOKIE['locale'] : $locale;
                
                if($locale == ''){
                    $locale = "en_US";
                }
                // copy all translations from /resources/lang/CURRENT_LOCALE/!* to global JS variable
                $lang_files = File::files(resource_path() . '/lang/' . $locale);
                $trans = [];
                foreach ($lang_files as $f) {
                    $filename = pathinfo($f)['filename'];
                    $trans[$filename] = trans($filename);
                }
                echo json_encode($trans);
            */?>;*/
            //window.locale = query[1];
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
        
        {{-- <script type="text/javascript" src="{{ asset('frontend/js/app.js') }}?q={{time()}}"></script> --}}
        <script type="text/javascript" src="{{ mix('frontend/js/manifest.js') }} "></script>
        <script type="text/javascript" src="{{ mix('frontend/js/vendor.js') }} "></script>
        <script type="text/javascript" src="{{ mix('frontend/js/app.js') }} "></script>
        
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
