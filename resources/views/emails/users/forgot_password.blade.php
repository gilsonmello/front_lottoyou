{{-- <a href="{{ route('frontend.users.active', $user->remember_token) }}">{!! $user->remember_token !!}</a> --}}

<p>
    <img src="{{ asset('public/imgs/logo.png') }}" class="img-fluid logo" style="height: 54px; width: 127px;">
</p>

<p>
    Prezado(a) {{ $user->name }} {{ $user->last_name }}
</p>

<p>
    Você deseja alterar a sua senha na www.lottoyou.bet? Por favor, clique no link abaixo ou copie e cole em seu navegador: <br><a href="{{ route('frontend.users.password_recovery@get', ['hash' => $password_reset->token]) }}">{{ route('frontend.users.password_recovery@get', ['hash' => $password_reset->password_reset]) }}</a>
</p>

<p>
    Após abrir o link, será solicitada a criação de uma nova senha que será utilizada para acessar a sua conta na www.lottoyou.bet
</p>

<p>
    Caso você não tenha solicitado a alteração da senha apenas ignore esse e-mail, sua senha está segura e permanecerá a mesma. 
</p>

<p>
    Atenciosamente
</p>

<p>
    Equipe de suporte Lottoyou<br>
    Aqui é mais fácil
</p>