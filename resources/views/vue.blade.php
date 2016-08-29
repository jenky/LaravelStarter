@extends('layouts.base')

@section('js')
<script src="{{ elixir('js/vendor.js', 'assets') }}"></script>
<script src="{{ elixir('js/app.js', 'assets') }}"></script>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ elixir('css/vendor.css', 'assets') }}">
@endsection

@section('body')
<example></example>
@endsection