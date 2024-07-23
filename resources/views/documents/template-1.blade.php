@extends('layouts.admin')
@section('title','Documents')
@section('page-style')
@endsection
@section('before-style')
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>
@endsection

@section('table-js')
    @include('layouts.table-scripts')
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

    {{--    Лоадер для табів --}}
    <script src="{{asset('assets/js/utils/loader-for-tabs.js')}}"></script>

    @if(array_key_exists('nomenclature',$documentType->settings()['fields']))
        <script type="module" src="{{asset('assets/js/grid/document/preview-document-sku-table.js')}}"></script>
    @endif
    @if(array_key_exists('container',$documentType->settings()['fields']))
        <script type="module" src="{{asset('assets/js/grid/document/preview-container-table.js')}}"></script>
    @endif
    @if(array_key_exists('services',$documentType->settings()['fields']))
        <script type="module" src="{{asset('assets/js/grid/document/preview-services-table.js')}}"></script>
    @endif

    <script type="module" src="{{asset('assets/js/grid/document/goods-invoices-table.js')}}"></script>
    <script type="module" src="{{asset('assets/js/grid/document/preview-documents-table.js')}}"></script>

    {{--Не працює без цих скриптів, що напевно не підключено в table-scripts--}}

@endsection

@section('content')

    <div id="jqxLoader"></div>

    <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between px-2">
        <div class=" align-self-start">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-slash">
                    @include('panels.breadcrumb', ['options' => [
    ['url' => '/document', 'name' => 'Документи'],
    ['name' => 'Перегляд "' . $documentType->name  ." №". $document->id . '"']
]])
                </ol>
            </nav>
        </div>

        <div class="header-options d-flex mb-1 align-items-center align-self-end">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center btn btn-flat-secondary p-0" style="margin-right: 6px;">
                    <li class="nav-item nav-search list-unstyled">
                        <a href="" class="d-flex  align-items-center nav-link external-link nav-link-grid">
                            <img class="nav-img" src="{{asset('assets/icons/print_document.svg')}}">
                        </a>
                    </li>
                </div>
                <div class="d-flex align-items-center btn btn-flat-secondary p-0" style="margin-right: 6px;">
                    <li class="nav-item nav-search list-unstyled">
                        <a href="" class="d-flex  align-items-center nav-link external-link nav-link-grid">
                            <img class="nav-img" src="{{asset('assets/icons/copy_document.svg')}}">
                        </a>
                    </li>
                </div>
                <div class="d-flex align-items-center btn btn-flat-secondary p-0" style="margin-right: 6px;">
                    <li class="nav-item nav-search list-unstyled">
                        <a href="{{route('document.edit',['document'=>$document->id])}}"
                           class="d-flex align-items-center nav-link external-link nav-link-grid">
                            <img class="nav-img" src="{{asset('assets/icons/edit_document.svg')}}">
                        </a>
                    </li>
                </div>
            </div>

            <div class="d-inline-flex">
                <a class="dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="19.0002" cy="18.9987" r="0.916667" stroke="#4B465C" stroke-width="1.75"
                                stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="19.0002" cy="18.9987" r="0.916667" stroke="white" stroke-opacity="0.1"
                                stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="19.0002" cy="25.4167" r="0.916667" stroke="#4B465C" stroke-width="1.75"
                                stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="19.0002" cy="25.4167" r="0.916667" stroke="white" stroke-opacity="0.1"
                                stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                        <ellipse cx="19.0002" cy="12.5846" rx="0.916667" ry="0.916667" stroke="#4B465C"
                                 stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                        <ellipse cx="19.0002" cy="12.5846" rx="0.916667" ry="0.916667" stroke="white"
                                 stroke-opacity="0.1" stroke-width="1.75" stroke-linecap="round"
                                 stroke-linejoin="round"/>
                    </svg>

                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="javascript:;" class="dropdown-item">
                        Скасувати накладну
                    </a>
                    <a href="javascript:;" class="dropdown-item">
                        Очисти контроль
                    </a>
                    <a href="javascript:;" class="dropdown-item">
                        Провести накладну
                    </a>
                </div>
            </div>
        </div>

    </div>

    <div class=" mx-2 px-0">
        <div class="row mx-0" style="column-gap:24px;">
            <div class="col-7 px-0 order-1 order-lg-0" style="flex-grow: 1;">
                <div class="card  pt-1 pb-2">
                    <div class="card-header py-50 px-2">
                        <div class="d-flex gap-1">
                            <h4 class="card-title fw-bolder">{{$documentType->name. " №". $document->id}}</h4>
                            <div><span class="badge badge-light-primary">Статус</span></div>
                        </div>

                        <div>Приорітет: <span class="badge bg-light-danger">10</span></div>
                    </div>
                    <div class="card-body pb-0 px-0">
                        <div class="row mx-0" style="row-gap: 1rem">
                            <div class="col-12  ps-50">
                                <div class="row mx-0">
                                    <h5 class="fw-bolder mt-1 mb-1"> Основна інформація </h5>
                                    @php
                                        $settingsFields = json_decode($document->documentType->settings, true)['fields'];
                                        $documentData = $document->data()['header'];
                                    @endphp
                                    {{--                                    <script>console.log(@json($settingsFields))</script>--}}
                                    {{--                                    <script>console.log(@json($documentData))</script>--}}
                                    <div class="col-6">

                                        @foreach ($settingsFields['header'] as $fieldKey => $fieldData)
                                            @if (array_key_exists($fieldKey, $documentData))
                                                @if($loop->odd)
                                                    <div class="d-flex gap-1 mb-1">
                                                        <div class="f-15 col-6">
                                                            {{ $fieldData['name'] }}
                                                        </div>
                                                        <div class="fw-6 col-6">

                                                            @if (is_array($documentData[$fieldKey]))
                                                                @foreach ($documentData[$fieldKey] as $element)
                                                                    {{ $element.' ' }}
                                                                @endforeach
                                                            @else
                                                                {{ $documentData[$fieldKey] }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-6">
                                        @foreach ($settingsFields['header'] as $fieldKey => $fieldData)
                                            @if (array_key_exists($fieldKey, $documentData))
                                                @if ($loop->even)
                                                    <div class="d-flex gap-1 mb-1">
                                                        <div class="f-15 col-6">
                                                            {{ $fieldData['name'] }}
                                                        </div>
                                                        <div class="fw-6 col-6">

                                                            @if (is_array($documentData[$fieldKey]))
                                                                @foreach ($documentData[$fieldKey] as $element)
                                                                    {{ $element.' ' }}
                                                                @endforeach
                                                            @else
                                                                {{ $documentData[$fieldKey] }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @for($i=0;$i<count(json_decode($document->documentType->settings,true)['custom_blocks']);$i++)
                        <div class="card-header px-0 py-50">
                            <h5 class=" fw-bolder px-2 mb-50 mt-50">{{$document->documentType->settings()['block_names'][$i]}}</h5>
                        </div>
                        <div class="card-body pb-0 px-0">
                            <div class="row mx-0" style="row-gap: 1rem">
                                <div class="col-12 col-md-6 ps-50 ">
                                    <div class="row mx-0">
                                        <div class="col-6 d-flex flex-column gap-1">

                                            @foreach(json_decode($document->documentType->settings,true)['custom_blocks'][$i] as $item)
                                                @if($loop->iteration % 2)
                                                    <div class="f-15">
                                                        {{$item['name']}}
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                        <div class="col-6 d-flex flex-column gap-1">

                                            @foreach($document->data()['custom_blocks'][$i] as $item)
                                                @if($loop->iteration % 2)
                                                    <div class="f-15 fw-6">
                                                        @if(gettype($item)=='array')
                                                            @foreach($item as $element)
                                                                {{$element.' '}}
                                                            @endforeach
                                                        @else
                                                            {{$item}}
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="col-12 col-lg-3 px-0 order-lg-1 order-0">
                <div class="card px-2 py-1 mb-1">
                    <div class="card-body p-0 pb-2">
                        <div class="row mx-0">
                            <div class="col-12 mt-1">
                                <h4 class="fw-bolder mb-1">Дії з документом</h4>
                                <div class="d-flex flex-column">
                                    @if(!is_null($documentType->key))
                                        @switch($documentType->key)

                                            @case('pryhid_vid_postachalnyka')
                                                @include('documents.actions.income-supplier', ['document', 'document'])
                                                @break

                                            @case('vnutrischnie_peremischchennya')
                                                @include('documents.actions.internal-displacement', ['document', 'document'])
                                                @break

                                            @case('spysannya')
                                                @include('documents.actions.write-off', ['document', 'document'])
                                                @break

                                            @default
                                                @include('documents.actions.default-actions')

                                        @endswitch
                                    @else
                                        @include('documents.actions.default-actions')
                                    @endif
                                </div>
                            </div>
                            <div id="main-data-message"></div>
                        </div>
                    </div>
                </div>

            </div>
            @if(array_key_exists('nomenclature',$documentType->settings()['fields'])
           || array_key_exists('container',$documentType->settings()['fields'])
           || array_key_exists('services',$documentType->settings()['fields'])
           || $relatedDocumentsArray)
                <div id="tabs" class="p-0 order-3 tabs-document-create-сss invisible">
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
                                    <div class="table-block" id="previewSkuDataTable"></div>
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
                                    <div class="table-block" id="previewContainerDataTable"></div>
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
                                    <div class="table-block" id="previewServicesDataTable"></div>
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
                                    <div class="table-block" id="document-{{$relatedDocumentsArray[$i]['id']}}"></div>
                                </div>
                            </div>

                        </div>
                    @endfor
                </div>
            @endif

            {{--            <div class="col-12 px-0 mt-1" style="flex-grow: 1;">--}}
            {{--                <!-- Basic Tabs starts -->--}}
            {{--                <div class="col-xl-12 col-lg-12">--}}
            {{--                    <div class="card-body">--}}
            {{--                        <div class="d-flex justify-content-between">--}}

            {{--                            <div id="tabs-2">--}}
            {{--                                <ul>--}}
            {{--                                    <li>Зміни накладної</li>--}}
            {{--                                    <li>Дії з накладними</li>--}}
            {{--                                    <li>Дії з комірками</li>--}}
            {{--                                    <li>Зв’язані--}}
            {{--                                        накладні--}}
            {{--                                    </li>--}}
            {{--                                </ul>--}}

            {{--                                <div>--}}
            {{--                                    1--}}
            {{--                                </div>--}}
            {{--                                <div>--}}
            {{--                                    2--}}
            {{--                                </div>--}}
            {{--                                <div>--}}
            {{--                                    3--}}
            {{--                                </div>--}}
            {{--                                <div>--}}
            {{--                                    4--}}
            {{--                                </div>--}}

            {{--                            </div>--}}
            {{--                        </div>--}}

            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <!-- Basic Tabs end -->--}}
            {{--            </div>--}}
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>
    @include('documents.table-init')

    <script type="module">
        import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';

        @if(array_key_exists('nomenclature', $documentType->settings()['fields']))
        tableSetting($('#previewSkuDataTable'));
        @endif

        @if(array_key_exists('container', $documentType->settings()['fields']))
        tableSetting($('#previewContainerDataTable'), '-container');
        @endif

        @if(array_key_exists('services', $documentType->settings()['fields']))
        tableSetting($('#previewServicesDataTable'), '-services');
        @endif

        @for($i=0;$i<count($relatedDocumentsArray);$i++)
        tableSetting($('#document-{{$relatedDocumentsArray[$i]['id']}}'), '-{{$relatedDocumentsArray[$i]['id']}}');
        @endfor

    </script>
    <script type="module">
        import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';

        @if(array_key_exists('nomenclature', $documentType->settings()['fields']))
        offCanvasByBorder($('#previewSkuDataTable'));
        @endif

        @if(array_key_exists('services', $documentType->settings()['fields']))
        offCanvasByBorder($('#previewServicesDataTable'), '-services');
        @endif

        @if(array_key_exists('container', $documentType->settings()['fields']))
        offCanvasByBorder($('#previewContainerDataTable'), '-container');
        @endif

        @for($i=0;$i<count($relatedDocumentsArray);$i++)
        offCanvasByBorder($('#document-{{$relatedDocumentsArray[$i]['id']}}'), '-{{$relatedDocumentsArray[$i]['id']}}');
        @endfor
    </script>

    <script>
        $('.cancel-btn').on('click', function () {
            $('.modal').modal('hide')
        });
    </script>

@endsection
