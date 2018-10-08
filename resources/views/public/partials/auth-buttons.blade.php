<div class="authentication-buttons">
    @guest
        <a class="login" href="/login">Login</a><a class="register" href="/register">Register</a>
    @endguest

    @auth
        <a class="register" href="{{ auth()->user()->role_id === 1
            ? route('admin.campaigns.index')
            : route('user.campaigns.index') }}">
                {{ auth()->user()->name }}
        </a>
    @endauth
</div>