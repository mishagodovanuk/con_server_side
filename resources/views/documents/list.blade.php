@extends('layouts.admin')
@section('title','Documents')
@section('page-style')
@endsection
@section('before-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/vendors.min.css')) }}"/>

@endsection

@section('content')
    <div class="card mx-2 bg-transparent box-shadow-0">
        <div class="card-header mx-0 row px-0" style="row-gap: 1rem">
            <div class="col-12 col-md-12 col-lg-3"><h1 class="fw-semibold">Документи</h1></div>
            <div class="col-12 col-md-12 col-lg-6">
                <div class="input-group input-group-merge">
                    <span class="input-group-text" id="basic-addon-search2"><i data-feather="search"></i></span>
                    <input type="text" class="form-control ps-1" id="searchListDocument"
                           placeholder="Пошук типу документа"
                           aria-label="Search..." aria-describedby="basic-addon-search2"/>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-3">
                <a class="btn btn-green float-end" href="{{route('document-type.create')}}"><img
                        class="plus-icon" src="{{asset('assets/icons/plus.svg')}}">Створити тип документу
                </a>
            </div>
        </div>
        <div class="card-datatable mb-2">
            <div class="row justify-content-start m-0" id="listDocument">
                @foreach($documentTypes as $documentType)
                    @if($documentType->status_id !== 1 && $documentType->status_id !== 3)
                        <div class="col-12 col-sm-6 col-md-6 col-xl-3 col-xxl-3 ">
                            <div class="position-relative">
                                <a class="text-dark"
                                   href="{{route('document.table',['document_type'=>$documentType])}}">
                                    <div class="card  list-document-effect">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between flex-column"
                                                 style="height: 94px">
                                                <div class="d-flex justify-content-between" style="gap: 25px">
                                                    <h5 class="card-title mb-0 fw-bolder"
                                                        style="line-height: 24px; max-width: 200px">
                                                        {{$documentType->name}}</h5>

                                                </div>

                                                <p class="card-text">Кількість:
                                                    <b>{{$documentType->documents_count}}</b>
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </a>
                                <div class="position-absolute d-flex"
                                     style="gap:10px;top:21px!important; right: 21px!important;">
                                    <div class="badge badge-light-primary" style="padding: 5px 10px; font-size: 13px">12
                                    </div>
                                    <div class="dropstart d-flex align-items-center">
                                        <i data-feather="more-vertical"
                                           class="font-medium-3 cursor-pointer dropdown-toggle "
                                           data-bs-toggle="dropdown" aria-expanded="false"></i>
                                        <ul class="dropdown-menu" style="width: 189px">
                                            @if($isAdmin || $documentType->status_id === null)
                                                <a href="{{route('document-type.edit',['document_type'=>$documentType->id])}}"
                                                   class="dropdown-item w-100 doctype-menu-item"
                                                   style="padding-left: 24px">
                                                    Редагувати
                                                </a>
                                            @endif
                                            <a href="{{route('document.table',['document_type'=>$documentType])}}"
                                               class="dropdown-item w-100 doctype-menu-item"
                                               style="padding-left: 24px">
                                                Переглянути <br>
                                                документи
                                            </a>
                                            <a
                                                href="{{route('document.create',['document_type'=>$documentType->id])}}"
                                                class="dropdown-item w-100 doctype-menu-item"
                                                style="padding-left: 24px">
                                                Створити <br> документ
                                            </a>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                        </div>
                    @endif
                @endforeach

            </div>

        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>
    <script src="{{asset('assets/js/entity/document/document-list.js')}}"></script>

@endsection
