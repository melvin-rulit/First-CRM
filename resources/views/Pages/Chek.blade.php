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

    @foreach($orders as $key => $data)

        <img src="/images/loading.svg">

        <h1>счет</h1>

        <table>
            <tr>
                <td><span class="name-input">Номер заказа: </span> {{ $data->orderid }}</td>
                <td></td>
            </tr>
        </table>

        <div>

            @if ($data->status_zakaz == 1)
                <table class="border_error" width="100%">
            @else
                <table class="border" width="100%">
            @endif


                <tr>
                    <td class="name-input">Клиент:</td>
                    <td><input type="text" name="" value=" {{ $data->nameus }}" placeholder="" class="text"></td>
                </tr>
                <td class="name-input">Телефон:</td>
                <td><input type="text" name="" value=" {{ $data->tel }}" placeholder="" class="text"></td>

                <tr>
                    <td colspan="2" class="name-input">Адрес:</td>
                </tr>
                <tr>
                    <td colspan="2"><textarea class="text adress"> {{ $data->adress }}</textarea></td>
                </tr>
                <br>
                <tr>
                    <td lass="name-input">Заказ:</td>
                    <td><textarea class="text adress"> {{ $data->racion }}</textarea></td>
                </tr>

                <tr>
                    <td class="name-input">К оплате:</td>
                    <td><input type="text" value=" {{ $data->total }}" placeholder="" class="text"></td>
                </tr>

                @if ($data->pay == 1)
                    @php ( $data_pay = 'Картой')
                @else
                    @php ($data_pay = 'Наличными')
                @endif

                <tr>
                    <td class="name-input">Опалата:</td>
                    <td><input type="text" value=" {{ $data_pay}}" placeholder="" class="text"></td>
                </tr>

            </table>
            <br><br>

        </div>

        <div style="text-align: center;"><i>Фигура она или есть ... или не надо есть</i></div><br><br>

    @endforeach

</div>


<div class="no-print">

    <a href="#" onClick="window.print()">Распечатать</a><br><br>
    <a href="/home">Вернуться в CRM </a>
</div>

</tbody>
</html>
