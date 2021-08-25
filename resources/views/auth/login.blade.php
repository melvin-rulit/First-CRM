@extends('layouts.login_app')

<!-- Форма для авторизации -->

@section('login')

    <div class="container">
        <!-- <div class="row justify-content-center"> -->
        <div class="row">
            <div class="col-12 col-md-5 col-xl-4 my-5 personal">
                <h2 class="display-5 text-center mb-3">{{ trans('panel.site_title') }}</h2>
                <h5 class="text-info text-center mb-5">{{ trans('panel.site_description') }}</h5>

                <form class="form-horizontal" method="POST" action="{{ route('login') }}">

                @csrf

                <!--  -->
                    <div class="form-group">
                        <label for="email" class="colors.coolGray #111827"
                               style="color:white;">{{ trans('global.login') }}</label>

                        <input id="email" name="email" type="text"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required
                               autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}"
                               value="{{ old('email', null) }}">


                    </div>

                    <!--  -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="password" style="color:white;">{{ trans('global.login_password') }}</label>

                            </div>
                        </div>

                        <div class="input-group input-group-merge">
                            <input id="password" name="password" type="password"
                                   class="form-control{{ $errors->all() ? ' is-invalid' : '' }}" required
                                   placeholder="{{ trans('global.login_password') }}">
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($errors->all())
                        <span class="help-block text-center pb-5" style="color:red; font-size: 17px;">
                                         <button type="submit" class="btn btn-lg btn-block btn-danger mt-5"> <strong>{{ $errors->first('email') }}</strong>

                        </button>

                                </span>

                    @else

                        <button type="submit" class="btn btn-lg btn-block btn-primary mt-5">
                            Войти в Систему
                        </button>

                    @endif


                </form>
            </div>
        </div>
    </div>

@endsection
