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
                <p>{{ $user->name }} {{ $user->last_name }}, bem-vindo(a) a Lottoyou.</p>
            </td>
        </tr>
        <tr>
            <p>
                <a href="{{route('frontend.users.activate', $user->email_verified)}}">
                    Clique no link para confirmar seu cadastro e desfrute de infinitas possibilidades
                </a>
            </p>
        </tr>
        <tr>
            <p>
                Atenciosamente,
            </p>
        </tr>
        <tr>
            <p>
                Equipe Lottoyou<br>Aqui é mais fácil
            </p>
        </tr>
    </tbody>
</table>