@extends('layouts.app')

@section('css-styles')
    <link rel="stylesheet" href="{{ asset('css/styleLoginForm.css') }}">
@endsection

@section('content')
<div id="wrap" style="background-image: url({{ asset('images/bg.jpg') }})">

    <div class="container pt-3">
    <h1 class="text-center mb-3" style="color:rgb(49, 197, 49)">{{ config('app.name', 'Laravel') }}</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Регистрация</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Имя</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Повторите пароль</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-3 offset-md-4">
                                <a href="{{ route('login') }}" class="text-primary" style="color: #218838 !important;">
                                   Уже есть аккаунт? Войдите!
                                </a>
                            </div>
                            <div class="col-3 p-0">
                                <button type="submit" class="btn btn-success">
                                    Зарегстрироваться
                                </button>
                            </div>
                        </div>


    {{--                        <div class="form-group row">--}}
    {{--                            <div class="col-md-6 offset-md-4 text-right">--}}
    {{--                                <a href="{{ route('login') }}" class="text-primary">--}}
    {{--                                    У вас уже есть аккаунт? Войдите!--}}
    {{--                                </a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
