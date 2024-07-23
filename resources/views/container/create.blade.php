@extends('layouts.admin')
@section('title','')
@section('page-style')
@endsection
@section('before-style')

@endsection
@section('table-js')
    @include('layouts.table-scripts')

@endsection
@section('content')
    <div class="mx-0 px-2 ">
        <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between pb-2">
            <div class="tn-details-breadcrumbs-nav align-self-start">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a href="/containers" style="color: #4B465C;">
                                Тара
                            </a></li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">Додавання тари</li>
                    </ol>
                </nav>
            </div>
            <div class="tn-details-actions d-flex gap-1 align-self-end ">
                <button type="submit" class="btn btn-flat-primary" id="create-container-draft">
                    Зберегти як чернетку
                </button>
                <button type="submit" class="btn btn-green" id="create-container">
                    Зберегти
                </button>
            </div>
        </div>

        <form>
            <div class="card  mb-2">
                <div class="row mx-0">
                    <div class="card col-12 p-2 mb-0">
                        <div class="card-header p-0">
                            <h4 class="card-title fw-bolder">Основні дані</h4>
                        </div>
                        <div class="card-body p-0 mt-1">
                            <div class="row">

                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="name">Назва</label>
                                    <input type="text" class="form-control" id="name"
                                           name="name" placeholder="Вкажіть назву тари">
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                    <div class="d-flex align-items-center">

                                        <div class="d-flex flex-grow-1 flex-column mr-1">
                                            <label class="form-label" for="unique-number">Унікальний номер тари</label>
                                            <input type="text" class="form-control"
                                                   oninput="limitInputToNumbers(this,20)" id="unique-number"
                                                   name="unique-number"
                                                   placeholder="00000000">
                                        </div>
                                        <div class="form-check form-switch mt-2">
                                            <label class="form-label" style="margin-top: 4px"
                                                   for="switch_container_num">Оборотна</label>
                                            <input type="checkbox" class="form-check-input" id="switch_container_num"
                                                   checked>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="category_sku select2-hide-search">Компанія
                                    </label>
                                    <select class="select2 form-select" name="company" id="company"
                                            data-placeholder="Виберіть компанію" data-dictionary="company"> 
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label" for="category_sku"> Тип тари
                                    </label>
                                    <select class="select2 form-select" name="type_id" id="type_container"
                                            data-placeholder="Виберіть тип тари" data-dictionary="container_type" >
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 mb-1">
                                <textarea class="form-control" id="container-comment" rows="2"
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
            </div>


            <div class="card  mb-0">
                <div class="row mx-0">
                    <div class="card col-12 p-2 mb-0">
                        <div class="card-header p-0">
                            <h4 class="card-title fw-bolder">Основні дані</h4>
                        </div>
                        <div class="card-body p-0 mt-1">
                            <div class="row">


                                <div class="col-12 col-md-6 mb-1">
                                    <label class="form-label">Маса</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="weight" id="weight"
                                               oninput="maskFractionalNumbers(this,5)"
                                               placeholder="Вкажіть масу тари">
                                        <span class="input-group-text">кг</span>
                                    </div>
                                </div>


                                <div class="col-12 col-md-6 mb-1 d-flex flex-grow gap-1">
                                    <div class="w-100"><label class="form-label">Висота</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="height" id="height"
                                                   placeholder="000.0" oninput="maskFractionalNumbers(this,4)">
                                            <span class="input-group-text">см</span>
                                        </div>
                                    </div>
                                    <div class="w-100"><label class="form-label">Ширина</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="width" id="width"
                                                   placeholder="000.0" oninput="maskFractionalNumbers(this,4)">
                                            <span class="input-group-text">см</span>
                                        </div>
                                    </div>
                                    <div class="w-100"><label class="form-label">Довжина</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="depth" id="depth"
                                                   placeholder="000.0" oninput="maskFractionalNumbers(this,4)">
                                            <span class="input-group-text">см</span>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>


    </div>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/entity/container/container.js')}}"></script>
@endsection
