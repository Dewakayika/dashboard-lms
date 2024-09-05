@section('title')
    Meals on Wheels
@endsection
@vite('resources/css/welcome.css')
<!-- @vite('resources/css/flying.css') -->
<script src="{{ asset('js/components/welcome.js')}}"></script>

<style>
    .hiden{
    opacity: 0;
    filter: blur(5px);
    transform: translateX(-100%);
    transition: all 1.7s;
}

    .show{
        opacity: 1;
        filter: blur(0);
        transform: translateX(0);
    }
</style>
@extends('layouts.app')
@section('content')

<div>hallo</div>

</script>

@endsection
