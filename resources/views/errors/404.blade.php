@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message')
    <img src="{{ asset('images/err.png') }}" alt="">
@endsection
