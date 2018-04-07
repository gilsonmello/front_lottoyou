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
        <link href="{{ asset('frontend/css/app.css') }}" rel="stylesheet" type="text/css">
        {{-- <link rel="shortcut icon" type="image/png" href="/favicon.ico"/> --}}

        <link rel="icon" type="image/x-icon" href="/favicon.ico" />
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
            var query = location.hash.split('/');           
            window.document.cookie = query[1] != undefined ? 'hash=' + query[1] : 'hash=en';

            if(query[1] == ''){
                query[1] = 'en';
            }

            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "/getTranslations/"+query[1], false);
            let token = document.head.querySelector('meta[name="csrf-token"]');
            xhttp.setRequestHeader("X-CSRF-TOKEN", token.content);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
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
        <script type="text/javascript" src="{{ asset('frontend/js/app.js') }}"></script>
        
    </body>
</html>
