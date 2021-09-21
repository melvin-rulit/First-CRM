@extends('layouts.adminWiew')

@section('contentAfterlogin')

<!-- анимированные переходы между компонентами -->
<transition name="component-fade" mode="out-in">
    <router-view></router-view>
</transition>

      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}"></script>

@endsection
