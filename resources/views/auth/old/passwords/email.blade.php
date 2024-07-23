@extends('layouts.app')
@section('title','Відновлення паролю')
@section('content')
    <div class="justify-content-center">
        <h2 class="reset text-center">
            Відновлення паролю
        </h2>
        <div class="reset_hint text-center">
            Введіть свою поштову адресу і ми відправимо вам посилання на відновлення паролю
        </div>


        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="justify-content-center">
                <div class="offset-2 mt-2 col-8">
                    <label for="email" class="col-md-4 col-form-label input_label">Пошта</label>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                        @if (session('status'))
                            <div class="col-12">
                                <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                </div>
            </div>

            <div class="row mb-0 justify-content-center">
                <div class="col-12">
                    <button type="submit" class="btn enter-button offset-2 col-8 mb-1">
                        Надіслати
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
