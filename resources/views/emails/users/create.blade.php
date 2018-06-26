{{-- <a href="{{ route('frontend.users.active', $user->remember_token) }}">{!! $user->remember_token !!}</a> --}}
<a href="{{route('frontend.users.activate', $user->email_verified)}}">
    Clique aqui para ativar a conta
</a>