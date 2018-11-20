<div class="side-menu d-none d-sm-block">
    <a href="{{ url('/') }}">Home</a>
    <a href="{{ route('about') }}">About us</a>
    <a href="{{ \App\Models\Campaign::createPath() }}">Register Campaign</a>
    <a href="{{ route('faq') }}">FAQ</a>
</div>
