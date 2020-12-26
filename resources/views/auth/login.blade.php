@extends('layouts.app')

<!-- Форма для авторизации -->

@section('login')

<div class="container">
    <!-- <div class="row justify-content-center"> -->
    <div class="row">
        <div class="col-12 col-md-5 col-xl-4 my-5 personal">
            <h2 class="display-5 text-center mb-3">{{ trans('panel.site_title') }}</h2>
            <h6 class="text-info text-center mb-5">{{ trans('panel.site_description') }}</h6>
           

                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    @csrf
                        <div class="form-group">
                            <label for="email" style="color:white;">{{ trans('global.login') }}</label>
                            <input id="email" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">

                              @if ($errors->has('email'))
                                <span class="help-block" style="color:red; font-size: 14px;">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col">
                              <label for="password"style="color:white;">{{ trans('global.login_password') }}</label>
                            </div>
                            <div class="col-auto">
                            @if(Route::has('password.request'))
                                <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                    {{ trans('global.forgot_password') }}
                                </a><br>
                            @endif
                            </div>
                        </div>
                            <div class="input-group input-group-merge">
                                <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;" /> Запомнить меня
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block btn-primary mb-3">
                      Войти
                    </button>
                </form>
        </div>
    </div>
</div>

@endsection