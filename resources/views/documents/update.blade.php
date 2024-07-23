@extends('layouts.admin')
@section('title','Documents')
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/pickadate/pickadate.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-pickadate.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/form-validation.css'))}}">

@endsection
@section('before-style')
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>
@endsection
@section('table-js')
    @include('layouts.table-scripts')

    <script src="{{asset('assets/js/utils/loader-for-tabs.js')}}"></script>

    @if(array_key_exists('nomenclature',$documentType->settings()['fields']))
        <script type="module" src="{{asset('assets/js/grid/document/update-sku-table.js')}}"></script>
    @endif

    @if(array_key_exists('container',$documentType->settings()['fields']))
        <script type="module" src="{{asset('assets/js/grid/document/update-container-table.js')}}"></script>
    @endif

    @if(array_key_exists('services',$documentType->settings()['fields']))
        <script type="module" src="{{asset('assets/js/grid/document/update-services-table.js')}}"></script>
    @endif

    <script type="module" src="{{asset('assets/js/grid/document/update-documents-table.js')}}"></script>

    @include('documents.module',['folder' => 'update'])
    @if(array_key_exists('nomenclature',$documentType->settings()['fields'])
    || array_key_exists('container',$documentType->settings()['fields'])
    || array_key_exists('services',$documentType->settings()['fields'])
    || $relatedDocumentsArray)
        <script type="text/javascript">
            $('#tabs').jqxTabs({
                width: '100%',
                height: '100%'
            });
        </script>
    @endif

@endsection

@section('content')

    <div id="jqxLoader"></div>

    <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between px-2 pb-2">

        <div class=" align-self-start">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-slash">
                    @include('panels.breadcrumb', ['options' => [
    ['url' => '/document', 'name' => 'Документи'],
    ['url' => '/document/'. $document->id, 'name' => 'Перегляд "' . $documentType->name  ." №". $document->id . '"'],
    ['name' => 'Редагування "' . $documentType->name  ." №". $document->id . '"']
]])
                </ol>
            </nav>
        </div>
        <div class="d-flex align-self-end">
            <div class="d-flex gap-1">
                <button type="button" id="draft-save" class="btn btn-flat-primary">Зберегти як чернетку</button>
                <button type="submit" id="document-save" class="btn btn-primary">Зберегти</button>
            </div>
        </div>
    </div>

    <div class=" mx-2 px-0">
        <div class="row mx-0" style="column-gap:24px;">
            <div class="col-12 px-0" style="flex-grow: 1;">
                <div class="card px-2 py-1">
                    <div class="card-header px-0 pb-0 pt-50">
                        <h4 class="card-title fw-bolder">{{$document->documentType->name}}</h4>
                    </div>
                    <form method="post" id="header_form" data-type="{{$document->type_id}}">
                        <input type="hidden" name="type_id" value="{{$document->documentType->id}}">
                        <div class="card-body px-0" style="margin-top: 8px;">
                            <div class="row">
                                {{--                                TODO In other block--}}
                                @foreach(collect(json_decode($documentType->settings, true)['fields']['header'])->sortBy('id') as $key => $field)
                                    @if (array_key_exists($key, $document->data()['header']))
                                        @include('documents.fields.update-block-generator')
                                    @endif
                                @endforeach

                                <div id="validation-message"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        @if(array_key_exists('custom_blocks',$documentType->settings()))
            @foreach($documentType->settings()['custom_blocks'] as $i=>$block)
                <div class="row mx-0" style="column-gap:24px;">
                    <div class="col-12 px-0" style="flex-grow: 1;">
                        <div class="card px-2 py-1">
                            <div class="card-header px-0 pb-0 pt-50">
                                <h4 class="card-title fw-bolder">{{$documentType->settings()['block_names'][$i]}}</h4>
                            </div>
                            <form method="post" id="custom_form_{{$i}}" class="custom-block">
                                <div class="card-body px-0 pt-1">
                                    <div class="row">
                                        @foreach(collect($block)->sortBy('id') as $key=>$field)
                                            @include('documents.fields.update-custom-block')
                                        @endforeach
                                        <div id="validation-message"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            @endforeach
        @endif

    </div>

    @if(array_key_exists('nomenclature',$documentType->settings()['fields'])
 || array_key_exists('container',$documentType->settings()['fields'])
 || array_key_exists('services',$documentType->settings()['fields'])
 || $relatedDocumentsArray)
        <div class="px-2">
            <div id="tabs" class="tabs-document-create-сss invisible">
                <ul class="d-flex">
                    @if(array_key_exists('nomenclature',$documentType->settings()['fields']))
                        <li data-modal="button_sku_doc">Товар</li>
                    @endif
                    @if(array_key_exists('container',$documentType->settings()['fields']))
                        <li data-modal="button_container_doc">Тара</li>
                    @endif
                    @if(array_key_exists('services',$documentType->settings()['fields']))
                        <li data-modal="button_services_doc">Послуги</li>
                    @endif
                    @foreach($relatedDocumentsArray as $doc)
                        <li data-modal="button_document-{{$loop->iteration - 1}}">{{$doc['name']}}</li>
                    @endforeach
                </ul>
                @if(array_key_exists('nomenclature',$documentType->settings()['fields']))
                    <div>
                        <!-- SKU use of products table -->
                        <div>
                            <div class="card-grid" style="position: relative;">

                                <div id="offcanvas-end-example">
                                    <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1"
                                         id="settingTable" aria-labelledby="settingTableLabel"
                                         style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 51;"
                                         data-bs-scroll="true">
                                        <div class="offcanvas-header">
                                            <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування
                                                таблиці</h4>
                                            <li class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas"
                                                aria-label="Close" style="list-style: none;"><a
                                                    class="nav-link nav-link-grid">
                                                    <img src="{{asset('assets/icons/close-button.svg')}}"></a>
                                            </li>
                                        </div>
                                        <div class="offcanvas-body p-0">
                                            <div class="" id="body-wrapper">
                                                <div
                                                    class="d-flex flex-row align-items-center justify-content-between px-2">
                                                    <div class="form-check-label f-15">Змінити висоту рядка:
                                                    </div>
                                                    <div
                                                        class="form-check form-check-warning form-switch d-flex align-items-center"
                                                        style="">
                                                        <button class="changeMenu-3">
                                                            <svg width="30" height="30" viewBox="0 0 30 30"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9 10.5H21" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M9 15H21" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M9 19.5H21" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>
                                                        <button class="changeMenu-2 active-row-table ">
                                                            <svg width="18" height="18" viewBox="0 0 18 18"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3 6H15" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M3 12H15" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>

                                                    </div>
                                                </div>
                                                <div
                                                    class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                    <label class="form-check-label f-15" for="changeFonts">Збільшити
                                                        шрифт</label>
                                                    <div class="form-check form-check-warning form-switch">
                                                        <input type="checkbox" class="form-check-input checkbox"
                                                               id="changeFonts"/>
                                                    </div>
                                                </div>
                                                <div
                                                    class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                    <label class="form-check-label f-15" for="changeCol">Зміна
                                                        розміру
                                                        колонок</label>
                                                    <div class="form-check form-check-warning form-switch">
                                                        <input type="checkbox" class="form-check-input checkbox"
                                                               id="changeCol"/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="d-flex flex-column justify-content-between h-100" id="">
                                                    <div>
                                                        <div style="float: left;" id="jqxlistbox"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="table-block" id="updateSkuDataTable"></div>
                            </div>
                        </div>

                    </div>

                    <!-- Add Modal Paking Doc-->

                @endif
                @if(array_key_exists('container',$documentType->settings()['fields']))
                    <div>
                        <!-- SKU use of products table -->
                        <div>
                            <div class="card-grid" style="position: relative;">

                                <div id="offcanvas-end-example">
                                    <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1"
                                         id="settingTable-container" aria-labelledby="settingTableLabel"
                                         style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 51;"
                                         data-bs-scroll="true">
                                        <div class="offcanvas-header">
                                            <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування
                                                таблиці</h4>
                                            <li class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas"
                                                aria-label="Close" style="list-style: none;"><a
                                                    class="nav-link nav-link-grid">
                                                    <img src="{{asset('assets/icons/close-button.svg')}}"></a>
                                            </li>
                                        </div>
                                        <div class="offcanvas-body p-0">
                                            <div class="" id="body-wrapper">
                                                <div
                                                    class="d-flex flex-row align-items-center justify-content-between px-2">
                                                    <div class="form-check-label f-15">Змінити висоту рядка:
                                                    </div>
                                                    <div
                                                        class="form-check form-check-warning form-switch d-flex align-items-center"
                                                        style="">
                                                        <button class="changeMenu-3">
                                                            <svg width="30" height="30" viewBox="0 0 30 30"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9 10.5H21" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M9 15H21" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M9 19.5H21" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>
                                                        <button class="changeMenu-2 active-row-table ">
                                                            <svg width="18" height="18" viewBox="0 0 18 18"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3 6H15" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M3 12H15" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>

                                                    </div>
                                                </div>
                                                <div
                                                    class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                    <label class="form-check-label f-15" for="changeFonts">Збільшити
                                                        шрифт</label>
                                                    <div class="form-check form-check-warning form-switch">
                                                        <input type="checkbox" class="form-check-input checkbox"
                                                               id="changeFonts"/>
                                                    </div>
                                                </div>
                                                <div
                                                    class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                    <label class="form-check-label f-15" for="changeCol">Зміна
                                                        розміру
                                                        колонок</label>
                                                    <div class="form-check form-check-warning form-switch">
                                                        <input type="checkbox" class="form-check-input checkbox"
                                                               id="changeCol"/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="d-flex flex-column justify-content-between h-100" id="">
                                                    <div>
                                                        <div style="float: left;" id="jqxlistbox-container"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="table-block" id="updateСontainerDataTable"></div>
                            </div>
                        </div>

                    </div>

                    <!-- Add Modal Paking Doc-->
                @endif
                @if(array_key_exists('services',$documentType->settings()['fields']))
                    <div>
                        <!-- SKU use of products table -->
                        <div>
                            <div class="card-grid" style="position: relative;">

                                <div id="offcanvas-end-example">
                                    <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1"
                                         id="settingTable-services" aria-labelledby="settingTableLabel"
                                         style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 51;"
                                         data-bs-scroll="true">
                                        <div class="offcanvas-header">
                                            <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування
                                                таблиці</h4>
                                            <li class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas"
                                                aria-label="Close" style="list-style: none;"><a
                                                    class="nav-link nav-link-grid">
                                                    <img src="{{asset('assets/icons/close-button.svg')}}"></a>
                                            </li>
                                        </div>
                                        <div class="offcanvas-body p-0">
                                            <div class="" id="body-wrapper">
                                                <div
                                                    class="d-flex flex-row align-items-center justify-content-between px-2">
                                                    <div class="form-check-label f-15">Змінити висоту рядка:
                                                    </div>
                                                    <div
                                                        class="form-check form-check-warning form-switch d-flex align-items-center"
                                                        style="">
                                                        <button class="changeMenu-3">
                                                            <svg width="30" height="30" viewBox="0 0 30 30"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9 10.5H21" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M9 15H21" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M9 19.5H21" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>
                                                        <button class="changeMenu-2 active-row-table ">
                                                            <svg width="18" height="18" viewBox="0 0 18 18"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3 6H15" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M3 12H15" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>

                                                    </div>
                                                </div>
                                                <div
                                                    class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                    <label class="form-check-label f-15" for="changeFonts">Збільшити
                                                        шрифт</label>
                                                    <div class="form-check form-check-warning form-switch">
                                                        <input type="checkbox" class="form-check-input checkbox"
                                                               id="changeFonts"/>
                                                    </div>
                                                </div>
                                                <div
                                                    class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                    <label class="form-check-label f-15" for="changeCol">Зміна
                                                        розміру
                                                        колонок</label>
                                                    <div class="form-check form-check-warning form-switch">
                                                        <input type="checkbox" class="form-check-input checkbox"
                                                               id="changeCol"/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="d-flex flex-column justify-content-between h-100" id="">
                                                    <div>
                                                        <div style="float: left;" id="jqxlistbox-services"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="table-block" id="updateServicesDataTable"></div>
                            </div>
                        </div>

                    </div>

                    <!-- Add Modal Paking Doc-->

                @endif
                @for($i=0;$i<count($relatedDocumentsArray);$i++)
                    <div>
                        <!-- SKU use of products table -->
                        <div>
                            <div class="card-grid" style="position: relative;">

                                <div id="offcanvas-end-example">
                                    <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1"
                                         id="settingTable-{{$relatedDocumentsArray[$i]['id']}}"
                                         aria-labelledby="settingTableLabel"
                                         style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 51;"
                                         data-bs-scroll="true">
                                        <div class="offcanvas-header">
                                            <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування
                                                таблиці</h4>
                                            <li class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas"
                                                aria-label="Close" style="list-style: none;"><a
                                                    class="nav-link nav-link-grid">
                                                    <img src="{{asset('assets/icons/close-button.svg')}}"></a>
                                            </li>
                                        </div>
                                        <div class="offcanvas-body p-0">
                                            <div class="" id="body-wrapper">
                                                <div
                                                    class="d-flex flex-row align-items-center justify-content-between px-2">
                                                    <div class="form-check-label f-15">Змінити висоту рядка:
                                                    </div>
                                                    <div
                                                        class="form-check form-check-warning form-switch d-flex align-items-center"
                                                        style="">
                                                        <button class="changeMenu-3">
                                                            <svg width="30" height="30" viewBox="0 0 30 30"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9 10.5H21" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M9 15H21" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M9 19.5H21" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>
                                                        <button class="changeMenu-2 active-row-table ">
                                                            <svg width="18" height="18" viewBox="0 0 18 18"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3 6H15" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M3 12H15" stroke="#A8AAAE"
                                                                      stroke-width="1.75" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>

                                                    </div>
                                                </div>
                                                <div
                                                    class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                    <label class="form-check-label f-15" for="changeFonts">Збільшити
                                                        шрифт</label>
                                                    <div class="form-check form-check-warning form-switch">
                                                        <input type="checkbox" class="form-check-input checkbox"
                                                               id="changeFonts"/>
                                                    </div>
                                                </div>
                                                <div
                                                    class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                    <label class="form-check-label f-15" for="changeCol">Зміна
                                                        розміру
                                                        колонок</label>
                                                    <div class="form-check form-check-warning form-switch">
                                                        <input type="checkbox" class="form-check-input checkbox"
                                                               id="changeCol"/>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="d-flex flex-column justify-content-between h-100" id="">
                                                    <div>
                                                        <div style="float: left;"
                                                             id="jqxlistbox-{{$relatedDocumentsArray[$i]['id']}}"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="table-block"
                                     id="update-document-{{$relatedDocumentsArray[$i]['id']}}"></div>
                            </div>
                        </div>

                    </div>
                @endfor

            </div>
        </div>
    @endif
    <!-- Add Modal Paking Doc-->
    @if(array_key_exists('nomenclature',$documentType->settings()['fields']))
        <div class="modal text-start" id="add_sku_doc" tabindex="-1" aria-labelledby="myModalLabel6"
             aria-hidden="true"
             style="">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 1033px!important;">
                <div class="modal-content">
                    <div class="">
                        <div class="popup-header mt-4">
                            Додати номенклатуру
                        </div>
                        <div class="card-body px-4 pb-4">
                            <div class="row mx-0">
                                <div class="col-6">
                                    <form method="post" id="sku-form">
                                        <div class="col-12 mb-2">

                                            <label class="form-label"
                                                   for="add_paking_category select2">Категорія
                                                <span class="text-danger fs-5"> * </span>
                                            </label>
                                            <select class="select2 form-select required-field-select"
                                                    id="sku_category"
                                                    data-placeholder="Оберіть категорію"
                                                    required>
                                                <option value=""></option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 mb-1">
                                            <label class="form-label"
                                                   for="add_paking_name select2">Найменування
                                                <span class="text-danger fs-5"> * </span>
                                            </label>
                                            <select class="select2 form-select required-field-select"
                                                    name="sku_id" id="sku_list"
                                                    data-placeholder="Оберіть товар"
                                                    required
                                            >
                                                <option value=""></option>

                                            </select>
                                        </div>

                                        @if($documentType->settings()['document_kind'] == 1)
                                            <div class="col-12 mb-1">
                                                <label class="form-label"
                                                       for="add_paking_name select2">Партія
                                                    <span class="text-danger fs-5"> * </span>
                                                </label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text"
                                                           class="form-control js-current-data flatpickr-basic flatpickr-input required-field"
                                                           id="consignment"
                                                           name="consignment"
                                                           aria-describedby="basic-addon6"
                                                           required
                                                    />
                                                    <span class="input-group-text" id="basic-addon6">
                                                            <img class="" src="{{asset('assets/icons/calendar.svg')}}">
                                                        </span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-12 mb-1">
                                                <label class="form-label"
                                                       for="add_paking_name select2">Партія
                                                    <span class="text-danger fs-5"> * </span>
                                                </label>
                                                <select class="select2 form-select required-field-select"
                                                        name="consignment"
                                                        id="consignment"
                                                        data-placeholder="Оберіть товар"
                                                        required>
                                                    <option value=""></option>

                                                </select>
                                            </div>
                                        @endif

                                        <div class="col-12 mb-1">
                                            <label class="form-label" for="count">Кількість
                                                <span class="text-danger fs-5"> * </span>
                                            </label>
                                            <input type="number" class="form-control required-field" name="count"
                                                   id="edit_number_paking"
                                                   placeholder="Вкажіть кількість товару"
                                                   required>
                                        </div>

                                        @if(array_key_exists('nomenclature',$documentType->settings()['fields']))
                                            @foreach(json_decode($documentType->settings,true)['fields']['nomenclature'] as $key=>$field)
                                                @include('documents.fields.pop-up-generator',['fieldsID'=>'popup-goods'])
                                            @endforeach
                                        @endif
                                    </form>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="card p-2 mt-2">
                                        <div class="d-flex gap-1 flex-column">
                                            <h4 class="fw-bolder mb-0">Дані про товар</h4>
                                            <p id="empty_packing" class="text-danger m-0">Виберіть товар</p>
                                        </div>


                                        <div id="info-block" class="row d-none">

                                            <div class="col-12 mt-1 px-0">
                                                <div class="row mx-0">
                                                    <p class="col-5 mb-0">Найменування</p>
                                                    <div class="col-7">
                                                        <p id="sku-name" class="mb-0 fw-bolder"></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-1 px-0">
                                                <div class="row mx-0">
                                                    <p class="col-5 mb-0">Параметри</p>
                                                    <div class="col-7">
                                                        <div class="mb-0 fw-bolder d-flex">Висота:&nbsp; <span
                                                                id="sku-height"></span> &nbsp;см
                                                        </div>
                                                        <div class="mb-0 fw-bolder d-flex">Ширина:&nbsp; <span
                                                                id="sku-width"></span> &nbsp;см
                                                        </div>
                                                        <div class="mb-0 fw-bolder d-flex">Довжина:&nbsp; <span
                                                                id="sku-length"> </span> &nbsp;см
                                                        </div>
                                                        <div class="mb-0 fw-bolder d-flex">Маса нетто:&nbsp; <span
                                                                id="sku-weight-netto"></span>&nbsp; кг
                                                        </div>
                                                        <div class="mb-0 fw-bolder d-flex">Маса брутто:&nbsp; <span
                                                                id="sku-weight-brutto"></span> &nbsp;кг
                                                        </div>
                                                        <div class="mb-0 fw-bolder d-flex">Темп-ний режим:
                                                            &nbsp;<span id="sku-temperature"></span>&nbsp; °C
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-1 px-0">
                                                <div class="row mx-0">
                                                    <p class="col-5 mb-0">Залишки</p>
                                                    <div class="col-7">
                                                        <div class="mb-0 fw-bolder d-flex">Сonsolid: &nbsp;<span
                                                                id="sku-wms-leftovers"></span> &nbsp;
                                                        </div>
                                                        <div class="mb-0 fw-bolder d-flex">ERP:&nbsp; <span
                                                                id="sku-erp-leftovers"></span> &nbsp;
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-1 px-0">
                                                <div class="row mx-0">
                                                    <p class="col-5 mb-0">Од. виміру</p>
                                                    <div class="col-7">
                                                        <p class="mb-0 fw-bolder" id="measurement-unit"></p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-1">
                                    <div class="d-flex float-end">
                                        <button class="btn btn-link cancel-btn" data-dismiss="modal">Скасувати
                                        </button>
                                        <button class="btn btn-primary" id="add_sku">Додати</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif
    @if(array_key_exists('container',$documentType->settings()['fields']))
        <div class="modal fade text-start px-1" id="add_container_doc" tabindex="-1" aria-labelledby="myModalLabel6"
             aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" style="max-width: 1033px!important;">
                <div class="modal-content">
                    <div class="">
                        <div class="popup-header mt-4">
                            Додати тару
                        </div>
                        <div class="card-body px-1 px-md-4 pb-4">
                            <div class="row mx-0">
                                <div class="col-12 col-lg-6 ">
                                    <form method="post" id="container-form">
                                        <div class="col-12 mb-1">
                                            <label class="form-label"
                                                   for="container_category select2">Категорія
                                                <span class="text-danger fs-5"> * </span>
                                            </label>
                                            <select class="select2 form-select required-field-select"
                                                    id="container_category"
                                                    data-placeholder="Оберіть категорію"
                                                    required>
                                                <option value=""></option>
                                                @foreach($containerTypes as $type)
                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 mb-1">
                                            <label class="form-label"
                                                   for="add_paking_name select2">Найменування
                                                <span class="text-danger fs-5"> * </span>
                                            </label>
                                            <select class="select2 form-select required-field-select"
                                                    name="container_id"
                                                    id="container_list"
                                                    data-placeholder="Оберіть товар"
                                                    required>
                                                <option value=""></option>

                                            </select>
                                        </div>


                                        <div class="col-12 mb-1">
                                            <label class="form-label" for="count">Кількість
                                                <span class="text-danger fs-5"> * </span>
                                            </label>
                                            <input type="number" class="form-control required-field" name="count"
                                                   id="edit_number_container"
                                                   placeholder="Вкажіть кількість тари"
                                                   required>
                                        </div>

                                        @if(array_key_exists('nomenclature',$documentType->settings()['fields']))
                                            @foreach(json_decode($documentType->settings,true)['fields']['container'] as $key=>$field)
                                                @include('documents.fields.pop-up-generator',['fieldsID'=>'popup-container'])
                                            @endforeach
                                        @endif
                                    </form>
                                </div>


                                <div class="col-12 col-lg-6">
                                    <div class="card p-2 mt-2">
                                        <div class="d-flex gap-1 flex-column">
                                            <h4 class="fw-bolder mb-0">Дані про тару</h4>
                                            <p id="container-empty-packing" class="text-danger m-0">Виберіть
                                                тару</p>
                                        </div>


                                        <div id="container-info-block" class="row d-none">

                                            <div class="col-12 mt-1 px-0">
                                                <div class="row mx-0">
                                                    <p class="col-5 mb-0">Найменування</p>
                                                    <div class="col-7">
                                                        <p id="container-name" class="mb-0 fw-bolder"></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-1 px-0">
                                                <div class="row mx-0">
                                                    <p class="col-5 mb-0">Параметри</p>
                                                    <div class="col-7">
                                                        <div class="mb-0 fw-bolder d-flex">Висота:&nbsp; <span
                                                                id="container-height"></span> &nbsp;см
                                                        </div>
                                                        <div class="mb-0 fw-bolder d-flex">Ширина:&nbsp; <span
                                                                id="container-width"></span> &nbsp;см
                                                        </div>
                                                        <div class="mb-0 fw-bolder d-flex">Довжина:&nbsp; <span
                                                                id="container-length"></span> &nbsp;см
                                                        </div>
                                                        <div class="mb-0 fw-bolder d-flex">Маса:&nbsp;<span
                                                                id="container-weight"></span>&nbsp;кг
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-1 px-0">
                                                <div class="row mx-0">
                                                    <p class="col-5 mb-0">Залишки</p>
                                                    <div class="col-7">
                                                        <div class="mb-0 fw-bolder d-flex">Сonsolid: &nbsp;<span
                                                                id="container-wms-leftovers"></span> &nbsp;
                                                        </div>
                                                        <div class="mb-0 fw-bolder d-flex">ERP:&nbsp; <span
                                                                id="container-erp-leftovers"></span> &nbsp;
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-1">
                                    <div class="d-flex float-end">
                                        <button class="btn btn-link cancel-btn" data-dismiss="modal">Скасувати
                                        </button>
                                        <button class="btn btn-primary" id="add_container">Додати</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(array_key_exists('services',$documentType->settings()['fields']))
        <div class="modal fade text-start px-1" id="add_service_doc" tabindex="-1" aria-labelledby="myModalLabel6"
             aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" style="max-width: 1033px!important;">
                <div class="modal-content">
                    <div class="">
                        <div class="popup-header mt-4">
                            Додати послугу
                        </div>
                        <div class="card-body px-1 px-md-4 pb-4">
                            <div class="row mx-0">
                                <div class="col-12 col-lg-6 ">
                                    <form method="post" id="service-form">
                                        <div class="col-12 mb-1">
                                            <label class="form-label"
                                                   for="container_category select2">Категорія
                                                <span class="text-danger fs-5"> * </span>
                                            </label>
                                            <select class="select2 form-select required-field-select"
                                                    id="service_category"
                                                    data-placeholder="Оберіть категорію"
                                                    required>
                                                <option value=""></option>
                                                @foreach($serviceCategories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 mb-1">
                                            <label class="form-label"
                                                   for="add_paking_name select2">Послуга
                                                <span class="text-danger fs-5"> * </span>
                                            </label>
                                            <select class="select2 form-select required-field-select"
                                                    name="service_id"
                                                    id="service_list"
                                                    data-placeholder="Оберіть товар"
                                                    required>
                                                <option value=""></option>

                                            </select>
                                        </div>

                                        @if(array_key_exists('services',$documentType->settings()['fields']))
                                            @foreach(json_decode($documentType->settings,true)['fields']['services'] as $key=>$field)
                                                @include('documents.fields.pop-up-generator',['fieldsID'=>'popup-service'])
                                            @endforeach
                                        @endif
                                    </form>
                                </div>

                                <div class="col-12 mt-1">
                                    <div class="d-flex float-end">
                                        <button class="btn btn-link cancel-btn" data-dismiss="modal">Скасувати
                                        </button>
                                        <button class="btn btn-primary" id="add_service">Додати</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @foreach($relatedDocumentsArray as $document)
        <div class="modal-size-xl d-inline-block">
            <div class="modal fade  text-start px-1" id="modal-document-{{$loop->iteration - 1}}"
                 tabindex="-1" aria-labelledby="myModalLabel6"
                 aria-hidden="true"
            >
                <div class="modal-dialog modal-dialog-centered" style="max-width: 1033px!important;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body-title pb-2">
                                <h3 class="text-center fw-bolder">{{$document['name']}}</h3>
                            </div>
                            <div class="card m-2">
                                <div class="card-header border border-bottom-0 row mx-0">
                                    <h5 class="card-title col-9 fw-semibold">Товарна накладна</h5>
                                    <div class="col-3">
                                        <button id="add-document-row-{{$document['id']}}" disabled
                                                class="btn btn-green float-end"
                                        >Додати
                                        </button>
                                    </div>
                                </div>
                                <div class="card-grid" style="position: relative;">

                                    <div id="offcanvas-end-example">

                                        <div class="offcanvas offcanvas-end" data-bs-backdrop="false"
                                             tabindex="-1"
                                             id="settingTable-{{$document['id']}}"
                                             aria-labelledby="settingTableLabel"
                                             style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 51;"
                                             data-bs-scroll="true">
                                            <div class="offcanvas-header">
                                                <h4 id="offcanvasEndLabel" class="offcanvas-title">
                                                    Налаштування
                                                    таблиці</h4>
                                                <li class="nav-item nav-search text-reset"
                                                    data-bs-dismiss="offcanvas"
                                                    aria-label="Close" style="list-style: none;"><a
                                                        class="nav-link nav-link-grid">
                                                        <img
                                                            src="{{asset('assets/icons/close-button.svg')}}"></a>
                                                </li>
                                            </div>
                                            <div class="offcanvas-body p-0">
                                                <div class="" id="body-wrapper">
                                                    <div
                                                        class="d-flex flex-row align-items-center justify-content-between px-2">
                                                        <div class="form-check-label f-15">Змінити висоту
                                                            рядка:
                                                        </div>
                                                        <div
                                                            class="form-check form-check-warning form-switch d-flex align-items-center"
                                                            style="">
                                                            <button class="changeMenu-3">
                                                                <svg width="30" height="30"
                                                                     viewBox="0 0 30 30"
                                                                     fill="none"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M9 10.5H21" stroke="#A8AAAE"
                                                                          stroke-width="1.75"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"/>
                                                                    <path d="M9 15H21" stroke="#A8AAAE"
                                                                          stroke-width="1.75"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"/>
                                                                    <path d="M9 19.5H21" stroke="#A8AAAE"
                                                                          stroke-width="1.75"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"/>
                                                                </svg>
                                                            </button>
                                                            <button class="changeMenu-2 active-row-table ">
                                                                <svg width="18" height="18"
                                                                     viewBox="0 0 18 18"
                                                                     fill="none"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M3 6H15" stroke="#A8AAAE"
                                                                          stroke-width="1.75"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"/>
                                                                    <path d="M3 12H15" stroke="#A8AAAE"
                                                                          stroke-width="1.75"
                                                                          stroke-linecap="round"
                                                                          stroke-linejoin="round"/>
                                                                </svg>
                                                            </button>

                                                        </div>
                                                    </div>
                                                    <div
                                                        class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                        <label class="form-check-label f-15"
                                                               for="changeFonts">Збільшити
                                                            шрифт</label>
                                                        <div
                                                            class="form-check form-check-warning form-switch">
                                                            <input type="checkbox"
                                                                   class="form-check-input checkbox"
                                                                   id="changeFonts"/>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                                        <label class="form-check-label f-15"
                                                               for="changeCol">Зміна
                                                            розміру
                                                            колонок</label>
                                                        <div
                                                            class="form-check form-check-warning form-switch">
                                                            <input type="checkbox"
                                                                   class="form-check-input checkbox"
                                                                   id="changeCol"/>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div
                                                        class="d-flex flex-column justify-content-between h-100"
                                                        id="">
                                                        <div>
                                                            <div style="float: left;"
                                                                 id="jqxlistbox-{{$document['id']}}"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-block" id="pop-up-document-{{$document['id']}}"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endforeach

@endsection

@section('page-script')
    @include('documents.table-init')
    <script>
        let buttonsString = '<li class="btn-tabs-watch-all ms-auto">'
        let visible = 'block'

        if (settings['fields'].hasOwnProperty('nomenclature')) {
            buttonsString += '<a data-bs-toggle="modal" id="button_sku_doc" data-bs-target="#add_sku_doc" class="btn btn-outline-primary float-end modal-btn" ' +
                'href="{{route('transport-equipment.create')}}"><img ' +
                'class="plus-icon" src="{{asset("assets/icons/plus-yellow.svg")}}">Додати ' +
                'товар </a>'
            visible = 'none'
        }

        if (settings['fields'].hasOwnProperty('container')) {
            buttonsString += '<a data-bs-toggle="modal" style="display:' + visible + '" id="button_container_doc" data-bs-target="#add_container_doc" class="btn btn-outline-primary float-end modal-btn" ' +
                'href="{{route('transport-equipment.create')}}"><img ' +
                'class="plus-icon" src="{{asset("assets/icons/plus-yellow.svg")}}">Додати ' +
                'тару </a>'
            visible = 'none'
        }

        if (settings['fields'].hasOwnProperty('services')) {
            buttonsString += '<a data-bs-toggle="modal" style="display:' + visible + '" id="button_service_doc" data-bs-target="#add_service_doc" class="btn btn-outline-primary float-end modal-btn" ' +
                'href="{{route('transport-equipment.create')}}"><img ' +
                'class="plus-icon" src="{{asset("assets/icons/plus-yellow.svg")}}">Додати ' +
                'послугу </a>'
            visible = 'none'
        }

            {{--// TODO Invoices--}}
            {{--buttonsString += '<a data-bs-toggle="modal" style="display:' + visible + '" id="button_invoices" data-bs-target="#add_invoices" class="btn btn-outline-primary float-end modal-btn" ' +--}}
            {{--    'href="{{route('transport-equipment.create')}}"><img ' +--}}
            {{--    'class="plus-icon" src="{{asset("assets/icons/plus-yellow.svg")}}">Додати документ </a>'--}}
            {{--visible = 'none'--}}

        for (let i = 0; i < relatedDocuments.length; i++) {
            buttonsString += '<a data-bs-toggle="modal" style="display:' + visible + '" id=button_document-' + i +
                ' data-bs-target="#modal-document-' + i + '" class="btn btn-outline-primary float-end modal-btn" ' +
                'href="{{route('transport-equipment.create')}}"><img ' +
                'class="plus-icon" src="{{asset("assets/icons/plus-yellow.svg")}}">Додати ' +
                relatedDocuments[i]['name'] + '</a>'
            visible = 'none'
        }
        buttonsString += '</li>'
        var addButtons = $(buttonsString);

        addButtons.appendTo('#tabs > .jqx-tabs-header > .jqx-tabs-title-container');
    </script>
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script src="{{asset('assets/js/entity/document/document-update.js')}}"></script>

    <script src="{{asset('assets/js/utils/modalHideButton.js')}}"></script>

    <script>
        const selectElement = $('#add_paking_name');
        const selectPackingElement = $('#select_packing');
        const emptyPackingElement = $('#empty_paking');

        selectElement.on('select2:select', () => {
            if (selectElement.val()) {
                selectPackingElement.removeClass('d-none');
                emptyPackingElement.addClass('d-none');
            } else {
                selectPackingElement.addClass('d-none');
                emptyPackingElement.removeClass('d-none');
            }
        });

    </script>

    <script type="module">
        import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';

        @if(array_key_exists('nomenclature', $documentType->settings()['fields']))
        tableSetting($('#updateSkuDataTable'));
        @endif

        @if(array_key_exists('container', $documentType->settings()['fields']))
        tableSetting($('#updateСontainerDataTable'), '-container');
        @endif

        @if(array_key_exists('services', $documentType->settings()['fields']))
        tableSetting($('#updateServicesDataTable'), '-services');
        @endif

        @for($i=0;$i<count($relatedDocumentsArray);$i++)
        tableSetting($('#document-{{$relatedDocumentsArray[$i]['id']}}'), '-{{$relatedDocumentsArray[$i]['id']}}');
        @endfor
    </script>

    <script type="module">
        import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';

        @if(array_key_exists('nomenclature', $documentType->settings()['fields']))
        offCanvasByBorder($('#updateSkuDataTable'));
        @endif

        @if(array_key_exists('services', $documentType->settings()['fields']))
        offCanvasByBorder($('#servicesDataTable'), '-services');
        @endif

        @if(array_key_exists('container', $documentType->settings()['fields']))
        offCanvasByBorder($('#updateServicesDataTable'), '-container');
        @endif

        @for($i=0;$i<count($relatedDocumentsArray);$i++)
        offCanvasByBorder($('#document-{{$relatedDocumentsArray[$i]['id']}}'), '-{{$relatedDocumentsArray[$i]['id']}}');
        @endfor
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Отримання всіх елементів з класом "date"
            var dateInputs = document.querySelectorAll('.js-current-data');

            // Ітерація через кожен елемент і встановлення Flatpickr
            dateInputs.forEach(function (dateInput) {
                flatpickr(dateInput, {
                    defaultDate: 'today'   // Встановлення сьогоднішньої дати за замовчуванням
                });
            });
        });
    </script>

@endsection
