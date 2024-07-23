@extends('layouts.empty')
@section('title','Onboarding')
@section('page-style')
@endsection
@section('before-style')
@endsection

@section('content')

    <div class="container d-flex justify-content-center">
        <div class="d-flex align-items-center align-content-center  row mx-0" style="width: 1150px; height: 100vh">
            <div class="col-12 col-md-12 col-lg-6">
                <h1 class="fw-bolder">Сторінку не знайдено :(</h1>
                <p>Ой! 😖 Потрібну URL-адресу не знайдено на цьому <br> сервері.</p>
                <div class="">
                    <a style="width: 443px"
                       class="btn btn-primary d-flex align-items-center fw-bold gap-50 justify-content-center"
                       href="{{url()->previous()}}">
                        <img src="{{asset('assets/icons/entity/errors/arrow-narrow-left.svg')}}"
                             alt="arrow-narrow-left">
                        Повернутися на попередню сторінку
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-6 d-flex justify-content-center">
                <img width="100%" src="{{asset('assets/icons/entity/errors/404.svg')}}" alt="404">
            </div>

        </div>

    </div>

@endsection

@section('page-script')
@endsection
