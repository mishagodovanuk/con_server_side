@extends('layouts.app')
@section('title','Логін')
@section('content')
    <div class="justify-content-center">
        <h2 class="welcome text-center">
            Вітаємо в SK WMS Pro!
        </h2>
        <div class="login_hint text-center">
            Введіть ваш логін і пароль щоб увійти
        </div>
        <div class="mt-4 flex">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-1 justify-content-center">
                    <div class="offset-2 col-8">
                        <label for="login" class="col-md-4 col-form-label input_label">Логін</label>

                        <input id="login" type="text" class="form-control"
                               name="login" value="{{ old('login') }}" required autocomplete="login" autofocus>

                    </div>
                </div>

                <div class="justify-content-center">

                    <div class="offset-2 col-8 mb-2">
                        <label class="form-label">Пароль</label>
                        <div class="input-group form-password-toggle input-group-merge">
                            <input type="password" class="form-control"
                                   required name="password" autocomplete="current-password">
                            <div class="input-group-text cursor-pointer ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </div>
                        </div>

                        @if($errors->any())
                        <div class="col-12">
                            <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                                {{ $errors->first() }}
                                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="justify-content-center">
                    <div class="offset-2 col-8">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                Запам’ятати мене
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-0 justify-content-center">
                    <div class="col-12">
                        <button type="submit" class="btn enter-button offset-2 col-8 mb-1">
                            Увійти
                        </button>
                    </div>

                    <div class="col-12 d-flex justify-content-center">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link forgot-password text-center"
                               href="{{ route('password.request') }}">
                                Забули пароль?
                            </a>
                        @endif
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
