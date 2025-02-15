@extends('layouts.front')

@section('css')

@endsection

@section('title', 'İletişim')

@section('content')
    <h1>İletişim</h1>
    <br>

    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>

    <div class="container">
        <form action="{{ route('user', ['id' => 1]) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Adınız</label>
                <input type="text" name="name" class="form-control" placeholder="Adınız">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="subject">Konu</label>
                <textarea name="message" class="form-control" placeholder="Mesaj"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gönder</button>
        </form>

    </div>
@endsection

@section('js')

@endsection