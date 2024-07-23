@extends('layouts.admin')
@section('title','Категорія товару')
@section('page-style')
@endsection
@section('before-style')
@endsection

@section('content')
    @php ($i = 3)
    <div class="container-fluid px-3">
        <div class="row" style="column-gap: 144px">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xxl-3 px-0"
                 style="min-width: 208px; max-width: fit-content">
                @include('layouts.setting')
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xxl-9 px-0" style="max-width: 798px">
                <div class="tab-content card pb-0">
                    <div role="tabpanel" class="tab-pane mb-0 active" id="vertical-pill-5"
                         aria-labelledby="stacked-pill-5"
                         aria-expanded="true">
                        <div id="all-regulation">
                            <div class="p-2 d-flex flex-wrap gap-1 justify-content-between align-items-center">
                                <h4 class="fw-bolder mb-0">
                                    Категорії товарів
                                </h4>
                                <div style="height: 38px"
                                     class="d-flex col-12  col-sm-12 col-md-auto flex-grow-1 justify-content-end gap-1 align-items-center">
                                    <div>
                                        <div id="js-search-field" class="input-group d-none input-group-merge">
                                            <span class="input-group-text" id="basic-addon-search2">
                                                <i data-feather="search"></i>
                                            </span>
                                            <input type="text" class="form-control ps-50" id="searchListGoods"
                                                   placeholder="Пошук категорії товару"
                                                   aria-label="Search..." aria-describedby="basic-addon-search2"/>
                                        </div>
                                        <button class="btn p-50" id="js-search-show-field">
                                            <i data-feather="search"></i>
                                        </button>

                                    </div>

                                    <div class="js-type-goods-line">
                                        <img height="" src="{{asset('assets/icons/entity/type-goods/line.svg')}}"
                                             alt="line">
                                    </div>

                                    <div>
                                        <button data-bs-toggle="modal" id="add_category_goods_button"
                                                data-bs-target="#add_category_goods" type="submit"
                                                class="btn btn-outline-primary d-flex align-items-center justify-content-center">
                                            <i data-feather="plus" class="mr-1"></i>
                                            Створити категорію
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="list-type-goods">
                            @foreach($categories as $category)
                                <div class="accordion accordion-border" id="accordion{{$category->id}}">
                                    <x-category :category="$category" :i="$i"></x-category>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade text-start" id="add_category_goods" tabindex="-1"
             aria-labelledby="myModalLabel6" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                <div class="modal-content">
                    <div class="card popup-card p-3">
                        <h2 class="fw-bolder text-center mb-1">
                            Створення категорії
                        </h2>
                        <form class="js-modal-form" action="{{ route('type-goods.store') }}" method="POST">
                            @csrf
                            <div class="card-body row mx-0 p-0">

                                <div class="col-12 mb-1">
                                    <div class="col-12  mb-1">
                                        <label class="form-label">Назва</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="name"
                                                   placeholder="Вкажіть назву категорії" id="add_name_goods"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-12 mb-1">
                                        <label class="form-label" for="select2-hide-search">До якої категорії
                                            належить</label>
                                        <select class="hide-search form-select" name="parent_id" id="add_goods_category"
                                                data-dictionary="goods_category"
                                                data-placeholder="Виберіть категорію товару">
                                            <option value=""></option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <div class="d-flex float-end">
                                        <button type="button" class="btn btn-link cancel-btn"
                                                data-dismiss="modal">Скасувати
                                        </button>
                                        <button type="submit" class="btn btn-primary" id="save_new_goods_category">
                                            Зберегти
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade text-start" id="edit_category_goods" tabindex="-1"
             aria-labelledby="myModalLabel6" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                <div class="modal-content">
                    <div class="card popup-card p-3">
                        <h2 class="fw-bolder text-center mb-1">
                            Редагування категорії
                        </h2>
                        <form class="js-modal-form2" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body row mx-0 p-0">

                                <div class="col-12 mb-1">
                                    <div class="col-12  mb-1">
                                        <label class="form-label">Назва</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="name"
                                                   placeholder="Вкажіть назву категорії" id="edit_name_goods"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-12 mb-1">
                                        <label class="form-label" for="select2-hide-search">До якої категорії
                                            належить</label>
                                        <select class="hide-search form-select" id="edit_goods_category"
                                                data-dictionary="goods_category"
                                                data-placeholder="Виберіть категорію товару" name="parent_id">
                                            <option value=""></option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <div class="d-flex float-end">
                                        <button type="button" class="btn btn-link cancel-btn"
                                                data-dismiss="modal">Скасувати
                                        </button>
                                        <button type="submit" class="btn btn-primary" id="edit_new_goods_category">
                                            Зберегти
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/utils/modalHideButton.js')}}"></script>

    <script src="{{asset('assets/js/entity/type-goods/type-goods.js')}}"></script>
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>

@endsection
