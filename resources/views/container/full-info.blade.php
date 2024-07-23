@extends('layouts.admin')
@section('title','Склад')
@section('page-style')
@endsection
@section('before-style')

@endsection

@section('table-js')
    @include('layouts.table-scripts')

@endsection

@section('content')
    <div class=" mx-2 px-0">
        <div class="tn-details-header d-flex justify-content-between">
            <div class="tn-details-breadcrumbs-nav pb-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-slash">
                        <li class="breadcrumb-item"><a href="/containers" style="color: #4B465C;">Тара</a></li>
                        <li class="breadcrumb-item fw-bolder active" aria-current="page">Перегляд
                            тари {{$container->name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="tn-details-actions d-flex gap-2">
                <div><i data-feather='printer' style="cursor: pointer; transform: scale(1.2);"></i></div>

                <div><i data-feather='copy' style="cursor: pointer; transform: scale(1.2);"></i></div>
                <div><a class="text-secondary" href="/containers/{{$container->id}}/edit"><i data-feather='edit'
                                                                                             style="cursor: pointer; transform: scale(1.2);"></i></a>
                </div>
                <div>
                    <div class="btn-group">
                        <i data-feather='more-horizontal' id="tn-details-header-dropdown" data-bs-toggle="dropdown"
                           aria-expanded="false" style="cursor: pointer; transform: scale(1.2);"></i>
                        <div class="dropdown-menu" aria-labelledby="tn-details-header-dropdown">
                            <a class="dropdown-item" href="#">Використання продукції</a>
                            <a class="dropdown-item" href="#">Переміщення PC палети </a>
                            <a class="dropdown-item" href="#">Рух продукції</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-0 mb-2">
            <div class="col-12 col-md-12 col-lg-4 pe-0 pe-md-1 ps-0">
                <div class="card px-2 py-1 ">
                    <div class="card-header px-0 pb-0">
                        <h4 class="card-title fw-bolder w-100 mb-0s"
                            style="padding-left: 6px;">{{$container->name}}</h4>
                    </div>
                    <div class="row">

                        <div class="col-lg-12 col-md-6 card-body px-1 mt-0 ">
                            <p class="text-uppercase mb-0 text-decoration-underline"
                               style="color: rgb(168, 170, 174); padding-left: 6px">Основні
                                дані
                            </p>
                            <div class="mx-0 gap-2 card-data-reverse-darker">


                                <div class="mx-0 py-1 " style="padding-left: 6px">
                                    <p class="fs-6 m-0  mb-50">Унікальний номер</p>
                                    <p class="fs-5 m-0 fw-medium-c ">{{$container->uniq_id}}</p>
                                </div>
                                <div class="mx-0 py-1 " style="padding-left: 6px">
                                    <p class="fs-6 m-0 mb-50">Компанія</p>
                                    <a href="/company/{{$container->company_id}}"
                                       class="fs-5 m-0  fw-medium-c text-secondary text-decoration-underline ">
                                        {{$container->company->company_type_id === 1 ? "{$container->company->company->first_name} {$container->company->company->surname}" : $container->company->company->name}}
                                    </a>
                                </div>
                                <div class="mx-0 py-1 " style="padding-left: 6px">
                                    <p class="fs-6 m-0  mb-50">Тип </p>
                                    <p class="fs-5 m-0 fw-medium-c ">{{$container->type->name}}</p>
                                </div>
                                <div class="mx-0 py-1 " style="padding-left: 6px">
                                    <p class="fs-6m-0  mb-50">Коментар</p>
                                    <p class="fs m-0 fw-medium-c ">{{$container->comment}}</p>
                                </div>


                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 card-body px-1 mt-0 pt-0">
                            <p class="text-uppercase mb-0 text-decoration-underline"
                               style="color: rgb(168, 170, 174); padding-left: 6px">Параметри
                            </p>
                            <div class="mx-0 gap-2 card-data-reverse-darker">


                                <div class="mx-0 py-1 " style="padding-left: 6px">
                                    <p class="m-0  mb-50"> Маса</p>
                                    <p class=" m-0 fw-medium-c ">{{$container->weight}} кг</p>
                                </div>
                                <div class="mx-0 py-1 " style="padding-left: 6px">
                                    <p class="m-0  mb-50">Висота/глубина/ширина</p>
                                    <p class=" m-0 fw-medium-c ">{{"{$container->height}/{$container->depth}/{$container->width}"}}
                                        см</p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('page-script')




@endsection
