@extends('layouts.base')

@section('js')
{!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js') !!}
{!! Html::script('https://maxcdn.bootstrapcdn.com/bootstrap/latest/js/bootstrap.min.js') !!}
@endsection

@section('css')
{!! Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/latest/css/bootstrap.min.css') !!}
@endsection

@section('body')
<div class="page-container">
    @yield('content')
</div>
@endsection