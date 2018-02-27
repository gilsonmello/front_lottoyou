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

        <link rel="icon" type="image/x-icon" href="//www.lottoland.com/skins/lottoland/images/ui/favicon-906cd6ceee89e2b3.ico" />
    </head>
    <body>
        <div id="app">
        </div>
        <script>
            window.trans = <?php
                // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
                $lang_files = File::files(resource_path() . '/lang/' . app()->getLocale());
                $trans = [];
                foreach ($lang_files as $f) {
                    $filename = pathinfo($f)['filename'];
                    $trans[$filename] = trans($filename);
                }
                echo json_encode($trans);
            ?>;
            window.locale = '<?= app()->getLocale(); ?>';
        </script>
        <script type="text/javascript" src="{{ asset('frontend/js/app.js') }}"></script>
    </body>
</html>
