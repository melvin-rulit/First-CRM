<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ trans('panel.site_title') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- fontawesome -->
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet">


    <!--  анимированные переходы между компонентами */ -->
    <style type="text/css">

        .component-fade-enter-active,
        .component-fade-leave-active {
            transition: opacity .3s ease;
        }

        .component-fade-enter,
        .component-fade-leave-to

            /* .component-fade-leave-active до версии 2.1.8 */
        {
            opacity: 0;
        }

    </style>

</head>

<body>

<h1>work</h1>
{{--@foreach($otchet as $key => $data)--}}
{{--    --}}{{--        @dd($data[1])--}}
{{--    <h1>   {{ $data}}</h1>--}}
{{--@endforeach--}}


<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
