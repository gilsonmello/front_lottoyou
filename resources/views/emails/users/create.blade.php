{{-- <a href="{{ route('frontend.users.active', $user->remember_token) }}">{!! $user->remember_token !!}</a> --}}

<table cellpadding="0" cellspacing="0" width="100%" border="0">
    <thead>
        <tr>
            <th align="center">
                <img src="{{ asset('imgs/logo.png') }}" class="img-fluid logo" style="height: 54px; width: 127px;">
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                {{ $user->name }} {{ $user->last_name }}, bem-vindo(a) a Lottoyou.
            </td>
        </tr>
        <tr>
            <a href="{{route('frontend.users.activate', $user->email_verified)}}">
                Clique no link para confirmar seu cadastro e desfrute de infinitas possibilidades
            </a>
        </tr>
        <tr>
            <p>
                Atenciosamente,
            </p>
        </tr>
        <tr>
            <p>
                &nbsp;
            </p>
        </tr>
        <tr>
            <p>
                Equipe Lottoyou<br>Aqui é mais fácil
            </p>
        </tr>
    </tbody>
</table>