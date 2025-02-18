@extends('layouts.front')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    <h1>Anasayfa</h1>
    <br>

    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
    <p>Yaş: {{ $age }}</p>
    <p>Ad: {{ $name }}</p>
    <p>Soyad: {{ $surname }}</p>
    <p>Şehir: {{ $city }}</p>
    <p>Ülke: {{ $country }}</p>
    <p>Email: {{ $email }}</p>
@endsection

@section('js')
    <script src="{{ asset('js/script.js') }}"></script>
@endsection