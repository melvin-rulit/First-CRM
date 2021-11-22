<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ trans('panel.site_title') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/dskprint.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/print.css') }}" rel="stylesheet" media="print">


    <style type="text/css">


    </style>

</head>

<tbody>
<div class='to_print'>

    <img src="/images/loading.svg">

    @foreach($racion_otchet as $key => $data)


        {{--        <table>--}}
        {{--            <tr>--}}
        {{--                <td> {{ $data->name }} -  <span class="name-input_racion_otchet"> {{ $data->itog_otchet }} </span> </td>--}}
        {{--                <br><br>--}}
        {{--                <td></td>--}}
        {{--            </tr>--}}
        {{--        </table>--}}

        <table width="100%" cellspacing="0" cellpadding="5" id="maket">
            <tr>
                <td width="300" valign="top">{{ $data->name }}</td>
                <td valign="top" id="rightcol">{{ $data->itog_otchet }}</td>
            </tr>
        </table>

    @endforeach

</div>


<div class="no-print">

    <a href="#" onClick="window.print()">Распечатать</a><br><br>
    <a href="/home">Вернуться в CRM </a>
</div>

</tbody>
</html>
