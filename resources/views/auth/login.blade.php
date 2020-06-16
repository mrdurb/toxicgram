@extends('layouts.app')

@section('css-styles')
    <link rel="stylesheet" href="{{ asset('css/styleLoginForm.css') }}">
@endsection

@section('content')
<div id="wrap" style="background-image: url({{ asset('images/bg.jpg') }})">

    <div class="container pt-3">
    <h1 class="text-center mb-3" style="color:rgb(49, 197, 49)">{{ config('app.name', 'Toxicgram') }}</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Вход</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Запомнить меня
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 text-right">
                                <button type="submit" class="btn btn-success">
                                    Войти
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4 text-right">
                                <a href="{{ route('register') }}" class="text-primary" style="color: #218838 !important;">
                                    У вас нет аккаунта? Зарегистрируйтесь!
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
{{--<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-dialog-centered modal-sm">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-body">--}}
{{--                <div class="row justify-content-center ">--}}
{{--                    <div class="col-10 ">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                <h5 class="modal-title">Введите ваш код</h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <form>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col py-2">--}}
{{--                                    <input required type="text" class="form-control" name="code" placeholder="Ваш код">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row float-right">--}}
{{--                                <div class="col">--}}
{{--                                    <button type="submit" class="btn btn-success ">Подтвердить</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div id="wrap" style="background-image: url({{asset('images/bg.jpg')}})">--}}
{{--    <header>--}}
{{--        <div id="intro">--}}
{{--            <div class="mask rgba-black-strong">--}}
{{--                <div class="conteiner-fluid d-flex align-items-center justify-content-center h-100">--}}
{{--                    <div class="row d-flex justify-content-center text-center">--}}
{{--                        <div class="col-md-10">--}}
{{--                            <h2 class="display-4 font-weight-bold white-text pt-5 mb-2">--}}
{{--                                Добро пожаловать в <p style ="display:inline-block; color:forestgreen">Toxicgram</p>!--}}
{{--                            </h2>--}}
{{--                            <hr class="hr-light">--}}
{{--                            <h4 class="white-text my-4">--}}
{{--                                В нашем мессенджере вы можете чувствовать себя как дома (в родном болоте)!--}}
{{--                            </h4>--}}
{{--                            <div class="container">--}}
{{--                                <form action="">--}}
{{--                                    <div class="row justify-content-center">--}}
{{--                                        <div class="col-4">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col">--}}
{{--                                                    <label class="sr-only" for="email">E-mail</label>--}}
{{--                                                    <div class="input-group mb-2">--}}
{{--                                                        <div class="input-group-prepend">--}}
{{--                                                            <div class="input-group-text"><i class="fas fa-envelope"></i></div>--}}
{{--                                                        </div>--}}
{{--                                                        <input required type="email" class="form-control" id="email" name="email" placeholder="e-mail@example.com">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="row float-right">--}}
{{--                                                <div class="col">--}}
{{--                                                    <div class="form-check">--}}
{{--                                                        <input class="form-check-input" type="checkbox" id="autoSizingCheck" name ="remember">--}}
{{--                                                        <label class="form-check-label font-weight-bold " for="autoSizingCheck">--}}
{{--                                                            Запомнить меня--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-4">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col">--}}
{{--                                                    <label class="sr-only" for="name">Имя пользователя</label>--}}
{{--                                                    <div class="input-group mb-2">--}}
{{--                                                        <div class="input-group-prepend">--}}
{{--                                                            <div class="input-group-text">@</div>--}}
{{--                                                        </div>--}}
{{--                                                        <input required type="text" class="form-control" id="name" name="nickname" placeholder="Имя пользователя">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="row float-right">--}}
{{--                                                <div class="col">--}}
{{--                                                    <button type="submit" class="btn btn-success mb-2" data-toggle="modal" data-target=".bd-example-modal-sm">Отправить код</button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </header>--}}
{{--</div>--}}

@endsection

@section('js-script')
{{--    <script !src="">--}}
{{--        $("#intro").fadeIn(1000);--}}
{{--    </script>--}}
@endsection
