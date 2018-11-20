<div id="mobileNav" class="mobile-menu hidden d-block d-sm-none">
    <div class="mobile-menu-controls">
        <a class="mobile-menu-toggle" href="#"><i class="fas fa-bars"></i></a>
        <a class="logo d-block" href="/">
            <img src="/img/logo-gradient.png" alt="Powershare logo">
        </a>
    </div>
    <span class="mobile-menu-items hidden">
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('about') }}">About us</a>
        <a href="{{ \App\Models\Campaign::createPath() }}">Register Campaign</a>
        <a href="{{ route('faq') }}">FAQ</a>
        @include('public.partials.auth-buttons')
        <ul class="social-links">
            @include('public.partials.social')
        </ul>
    </span>
</div>
