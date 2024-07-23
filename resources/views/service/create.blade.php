@extends('layouts.admin')
@section('title','service create')
@section('page-style')
@endsection

@section('content')
    <div class="container-fluid px-2">
        <!-- контейнер з навігацією і кнопками -->
        <div class="d-flex justify-content-between flex-column  flex-sm-column flex-md-row flex-lg-row flex-xxl-row">
            <div class=" pb-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a href="/services" style="color: #4B465C;">Послуги</a></li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">
                            Додавання послуги
                        </li>

                    </ol>
                </nav>
            </div>
            <div class="container_btn-createTP">
                <button type='button' class="btn   border-0" tabindex="4" id="create-save-as-draft-button"> <span
                        class="align-middle d-sm-inline-block  text-primary">Зберегти як чернетку</span>
                </button>
                <button type='button' class="btn btn-primary " id="create-save-button" tabindex="4">
                    <span class="align-middle d-sm-inline-block  ">Зберегти</span>
                </button>
            </div>
        </div>
        <!-- = -->
        <!-- контейнер  з селектами та полями  для створення послуги-->
        <div class="card p-2 pb-4">
            <h4 class="mb-2">Основні Дані</h4>

            <!-- набір селектів та інпутів  -->
            <div class="row  pb-4">

                <div class="col-12 col-sm-6 input-with-switch mb-1">
                    <div class="w-100 mr-1">
                        <label class="form-label" for="basicInput">Назва</label>
                        <input type="text" class="form-control" id="basicInput" placeholder="Вкажіть назву послуги "/>
                    </div>
                </div>

                <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="select-service-category">Категорія</label>
                    <select class="select2 form-select" id="select-service-category" data-dictionary="service_category"
                            data-placeholder="Виберіть категорію">
                        <option value=""></option>
                    </select>
                </div>

                <div class="service-create-textarea col-12 col-sm-6 mb-1">

                <textarea class="form-control " id="exampleFormControlTextarea1" rows="3"
                          placeholder="Коментар"></textarea>
                </div>
                <div class="col-12 ">
                    <div id="alert-error" class=" alert alert-danger  d-none" role="alert">
                        текст помилки
                    </div>
                </div>

            </div>

        </div>

    </div>

    </div>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/entity/service/service.js')}}"></script>
@endsection
