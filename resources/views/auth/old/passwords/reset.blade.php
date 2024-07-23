@extends('layouts.app')
@section('title','Відновлення паролю')
@section('content')
    <div class="justify-content-center">
        <h2 class="reset reset-margin text-center">
            Створіть новий пароль
        </h2>
        <div class="reset_hint text-center">
            Придумайте новий пароль який не буде схожий на старий
        </div>


        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
            <div class="justify-content-center">
                <div class="offset-2 mt-2 col-8">
                    <label class="form-label">Новий пароль</label>
                    <div class="input-group form-password-toggle input-group-merge">
                        <input type="password" class="form-control"
                               required name="password" autocomplete="new-password">
                        <div class="input-group-text cursor-pointer ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-eye">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </div>
                    </div>

                    <label class="form-label mt-1">Повторіть пароль</label>
                    <div class="input-group form-password-toggle input-group-merge">
                        <input type="password" class="form-control" id="password-confirm"
                               required name="password_confirmation" autocomplete="new-password">
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

            <div class="row mb-0 justify-content-center">
                <div class="col-12">
                    <button type="submit" class="btn enter-button offset-2 col-8 mb-1">
                        Створити
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
