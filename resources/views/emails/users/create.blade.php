<p>
    <img src="{{ asset('public/imgs/logo.png') }}" class="img-fluid logo" style="height: 54px; width: 127px;">
</p>
<p>{{ $user->name }} {{ $user->last_name }}, bem-vindo(a) a Lottoyou.</p>
<p>
    <a href="{{route('frontend.users.activate@get', $user->email_verified)}}">
        Clique no link para confirmar seu cadastro e desfrute de infinitas possibilidades
    </a>
</p>
<p>
    Atenciosamente,
</p>
<p>
    Equipe Lottoyou<br>Aqui é mais fácil
</p>