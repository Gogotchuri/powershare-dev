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

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    {{--TODO: vendor.css here is only fileupload stuff needs better organisation--}}
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
    @modal(['id' => 'oldNewModal'])
        @include('public.partials.old-new-modal')
    @endmodal
    @yield('html-body')
</html>
