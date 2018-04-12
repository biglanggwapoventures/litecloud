@extends('default')

@push('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('body')
@yield('content')
@endsection
