<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Mostly SEO & Sharing -->
    <meta name="description" content="{{$description ?? 'Browser-Based Mining for Charity Crowdfunding'}}">
    <meta property="og:description" content="{{$description ?? 'Browser-Based Mining for Charity Crowdfunding'}}">

    @if(isset($mainImage))
        {{--TODO: Add nice default photo here--}}
    <meta property="og:image" content="{{$mainImage ?? ''}}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">
    @endif

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') . ($title ?? null ? ' - ' . $title : '')  }}</title>

    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <link rel="shortcut icon" type="image/png" href="{{url('/favicon.png')}}"/>

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '1953156704776752');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1"
             src="https://www.facebook.com/tr?id=1953156704776752&ev=PageView
&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

    {{--TODO: Remove these cause they are already in app.js, but make sure first--}}
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
    @modal(['id' => 'oldNewModal'])
        @include('public.partials.old-new-modal')
    @endmodal
    <body>
        {{--NOTE: flex-wrapper is used to position footer at the bottom of page when content is not long enough--}}
        <div class="flex-wrapper">
            @yield('html-body')
            @include('partials.footer')
        </div>
    </body>

</html>
