@extends('layouts.adminWiew')

@section('contentAfterlogin')

    <head-component></head-component>

<!-- анимированные переходы между компонентами -->
<transition name="component-fade" mode="out-in">
    <router-view></router-view>
</transition>

@endsection
