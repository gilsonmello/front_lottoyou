@section('description', 'Lottoyou, lotto, lottery, loteria, apostas online, loterias online,games, bet, bet365, bet188, lottoland, soccer, soccer expert, bolão, futebol, raspadinha, , loterias mais faceis do mundo, palpites, cartola, apostas esportivas, jogos de azar, prêmios.')

@section('title', trans('strings.lottoyou'))

@section('author', trans('strings.lottoyou'))

@extends('layouts.frontend.bot')

@section('content')
    <div class="container-fluid vcenter main-banner no-padding">
        <div class="row no-margin" style="width: 100%;">
            <div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
                <div class="banner-main" style="position: relative">
                    <img style="width: 100%;" alt="Aqui é mais fácil" class="img-fluid" src="/img/new1/BAN-princi_S_TX.png">
                    <div class="content-left">
                        <h1 class="" style="">
                            Aqui é mais fácil
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
                    <ol class="carousel-indicators" style="bottom: -46px;">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <a href="{{route('frontend.scratch_cards.index')}}">
                                        <img style="width: 100%; margin-bottom: 10px" class="img-fluid" src="/img/new/index_2.jpeg">
                                    </a>
                                </div>
                                <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <a href="{{route('frontend.lotteries.play', 'easy-money')}}">
                                        <img style="width: 100%; margin-bottom: 10px" class="img-fluid" src="/img/index_easy_money.png">
                                    </a>
                                </div>
                                <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <a href="{{route('frontend.scratch_cards.index')}}">
                                        <img style="width: 100%; margin-bottom: 10px" class="img-fluid" src="/img/new/index_golden_goal.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <a href="{{route('frontend.soccer_expert.play', 'custom')}}">
                                        <img style="width: 100%; margin-bottom: 10px" class="img-fluid" src="/img/new/slide_4.png">
                                    </a>
                                </div>
                                <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <a href="{{route('frontend.soccer_expert.play', 'world')}}">
                                        <img style="width: 100%; margin-bottom: 10px" class="img-fluid" src="/img/new/slide_3.png">
                                    </a>
                                </div>
                                <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <a href="{{route('frontend.soccer_expert.play', 'special')}}">
                                        <img style="width: 100%; margin-bottom: 10px" class="img-fluid" src="/img/new/slide_5.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" id="prev-slide-content" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="fa fa-angle-left" style="color: black"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" id="next-slide-content" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="fa fa-angle-right" style="color: black"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="row" id="conteudo" style="">
            <div class="col-lg-12" style="min-height: 50px; background-color: #fff;">
                    
            </div>
        </div>
    </div>




    <div class="container">
        <div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
            <!-- <h1 class="text-center">Banner 02<br>960 x 200px</h1> -->
            <a href="{{route('frontend.create_your_league')}}">
                <div class="banner-custom" style="position: relative">
                    <img style="width: 100%; " class="img-fluid" src="/img/banner_custom.png">	

                    <div class="content-left">
                        <h2 class="text-center">
                            CRIE AGORA MESMO<br>
                            A SUA PRÓPRIA LIGA!
                        </h2>
                        <h2 class="text-center" style="margin-bottom: 6px;">
                            VOCÊ JÁ COMEÇA
                        </h2>
                        <h1 class="text-center">
                            <strong>GANHANDO 5%</strong>
                        </h1>
                        <h2 class="text-center">
                            DE TODAS AS APOSTAS
                        </h2>
                    </div>

                    <div class="content-right">
                        <h1>
                            No <strong>Soccer Expert</strong> da <strong>Lottoyou</strong><br>
                            você pode criar a sua própria liga<br>
                            com <strong>qualquer time do mundo.</strong><br>
                            Convide seus amigos e descubra<br>
                            quem é o "expert" do futebol.
                        </h1>
                        <br>
                        <h4>
                            <em>É momento de começar a desfrutar deste<br>
                            mundo de infinitas possibilidades com Lottoyou!</em>
                        </h4>
                    </div>
                </div>
            </a>
        </div>			
    </div>

    <br>
    <div class="container">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 vcenter no-padding">
            <!-- <h1 class="text-center">Banner 03<br>960 x 200px</h1> -->
            <a href="{{route('frontend.scratch_cards.index')}}">
                <div class="banner-golden-goal" style="position: relative">
                    <img style="width: 100%; " class="img-fluid" src="/img/new1/RASPADINHAS.jpg">	
                    <div class="content-left">
                        <h2 style="font-weight: bold; text-shadow: 0 1px #808d9300, -1px 0 #cdd2d5, -1px 2px #808d9300, -2px 1px #cdd2d500, -2px 3px #808d93;">
                            RASPE E GANHE !!!
                        </h2>
                    </div>
                </div>
            </a>
        </div>
    </div>
    
    <br>
    <div class="container">
        <div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
            <!-- <h1 class="text-center">Banner 02<br>960 x 200px</h1> -->
            <a href="{{route('frontend.soccer_expert.index')}}">
                <div class="banner-soccer-expert" style="position: relative">
                    <img style="width: 100%; " class="img-fluid" src="/img/new1/Soccer_Exp_S_TX.jpg">	
                    <div class="content-left">
                        <h2>
                            AQUI SEU PALPITE<br>
                            VALE MAIS QUE UM GOL
                        </h2>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <br>
    <div class="container">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 vcenter no-padding">
            <!-- <h1 class="text-center">Banner 03<br>960 x 200px</h1> -->
            <a href="{{route('frontend.lotteries.play', 'easy-money')}}">
                <div class="banner-easy-loteria" style="position: relative">
                    <img style="width: 100%; " class="img-fluid" src="/img/new1/easy_loteria_S_TX.jpg">
                    <div class="content-left">
                        <h5 class="text-center">
                            <em><strong>NUNCA FOI TÃO FÁCIL GANHAR</strong></em>
                        </h5>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <br>
    <div class="container">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div id="how-to-play">
                <h1 class="text-center">Como jogar na Nossa Loteria - Easy Money</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-4 col-sm-4 vcenter" style="justify-content: center;">
                <div class="col-lg-4 no-padding">
                    <img src="/img/icon_11.png" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-4 col-sm-4 vcenter" style="justify-content: center;">
                <div class="col-lg-4 no-padding">
                    <img src="/img/icon_22.png" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-4 col-sm-4 vcenter" style="justify-content: center;">
                <div class="col-lg-4 no-padding">
                    <img src="/img/icon_33.png" class="img-fluid">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-4 col-sm-4">
                <h5 class="text-center"><strong>1. Escolha seus números</strong></h5>
                <h6 class="text-center">Escolha 5 números no universo de 35 números</h6>
            </div>
            <div class="col-lg-4 col-md-4 col-4 col-sm-4">
                <h5 class="text-center"><strong>2. Escolha a data do Sorteio</strong></h5>
                <h6 class="text-center">Os sorteios ocorrem de segunda a sábado</h6>
            </div>
            <div class="col-lg-4 col-md-4 col-4 col-sm-4">
                <h5 class="text-center"><strong>3. Confirme seu bilhete</strong></h5>
                <h6 class="text-center">Escolha como deseja pagar seu jogo com segurança</h6>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
            <div class="banner-explic-soccer" style="position: relative">
                <img class="img-fluid" style="width: 100%; " src="/img/new1/explic_soccer.jpg">
                <div class="content-left">
                    <h3 style="font-weight: bold; font-style: italic;">
                        Soccer Expert
                    </h3>
                    <h4 style="text-align: justify; line-height: 1.5;">
                        <p style="margin-bottom: 6px;">O Soccer Expert (SE) é um produto do Lottoyou.bet
                        onde se organizam ligas, no qual cada participante realizará uma	aposta indicando o resultado de um conjunto de jogos de futebol dos principais campeonatos do mundo.
                        </p>
                        <p style="margin-bottom: 6px;">
                            Escolha uma das três modalidades: Word; Special e Custom e junte-se a nós neste mundo do futebol!
                        </p>
                    </h4>
                </div>
            </div>			
        </div>
        <br>
        <div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">
            <div class="banner-explic-ras" style="position: relative">
                <img class="img-fluid" style="width: 100%; " src="/img/new1/explic_piratas.jpg">
                <div class="content-left">
                    <h3 style="font-weight: bold; font-style: italic;">
                        {{ trans('strings.scratch_cards') }}
                    </h3>
                    <h4 style="text-align: justify; line-height: 1.2;">
                        <p>
                            Nas raspadinhas Lottoyou você se diverte e ainda ganha dinheiro.<br>
                            Conheça esse universo de possibilidades onde poucos centavos podem render milhares de dólares!!!<br>
                            O Pirates Treasure e o Golden Goal lhe reservam grandes prêmios.
                        </p>
                        <p><strong>A cada 3 bilhetes, um é premiado.</strong></p>
                        <p>Aqui é mais fácil! </p>
                    </h4>
                </div>
            </div>

        </div>
        <br>

    
        <div class="vcenter col-lg-12 col-md-12 col-xs-12 col-sm-12 no-padding">

            <div class="banner-explic-easy-loteria" style="position: relative">
                <img class="img-fluid" style="width: 100%; " src="/img/new1/explic_easy.jpg">
                <div class="content-left">
                    <h3 style="font-weight: bold; font-style: italic;">
                        Easy Money - A loteria da Lottoyou
                    </h3>
                    
                    <h4 style="text-align: justify; line-height: 1.2;">
                        <p>Quem nunca sonhou em transformar 1 dólar em $20,000 dólares?<br>
                        Provavelmente você já tem os seus planos e aqui na Easy Money todos os dias você pode concretizá-los. Para ganhar o prêmio máximo basta acertar apenas 5 números em um universo de 35 números!!!
                        Na Easy Money vôcê também ganha acertando 4, 3, 2 ou até mesmo 1 número.</p>
                        <!-- <p>Easy Money, <em><strong>nunca foi tão fácil ganhar</strong></em></p> -->
                        <p>Easy Money, nunca foi tão fácil ganhar</p>
                    </h4>
                </div>
            </div>
        </div>
    </div>
@endsection