@extends('layouts.not_for_user')

@section('not_for_user')

    <!-- анимированные переходы между компонентами -->
    <transition name="component-fade" mode="out-in">
        <router-view></router-view>
    </transition>

@endsection
