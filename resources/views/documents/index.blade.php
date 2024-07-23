@extends('layouts.admin')
@section('title','Documents')
@section('before-style')
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>
@endsection

@section('table-js')
    @include('layouts.table-scripts')
    <script type="module" src="{{asset('assets/js/grid/document/document-table.js')}}"></script>
@endsection

@section('content')
    <div class="d-flex align-items-center flex-column flex-lg-row justify-content-between px-2">
        @include('panels.breadcrumb', ['options' => [
    ['url' => '/document', 'name' => 'Документи'],
    ['name' => $documentType->name]
]])
    </div>
    @if($documentsCount)
        <div class="card m-2">
            <div class="card-header justify-content-between border-bottom row gap-1 mx-0">
                <h4 class="card-title col-auto fw-semibold">{{strtolower($documentType->name)}}</h4>
                <div class="col-auto  align-self-end">
                    <a class="btn btn-green float-end"
                       href="{{route('document.create',['document_type'=>$documentType->id])}}"><img class="plus-icon"
                                                                                                     src="{{asset('assets/icons/plus.svg')}}">Створити
                        документ
                    </a>
                </div>
            </div>
            <div class="card-grid" style="position: relative;">

                <div id="offcanvas-end-example">
                    <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1" id="settingTable"
                         aria-labelledby="settingTableLabel"
                         style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 1001;"
                         data-bs-scroll="true">
                        <div class="offcanvas-header">
                            <h4 id="offcanvasEndLabel" class="offcanvas-title">Налаштування таблиці</h4>
                            <li class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"
                                style="list-style: none;"><a class="nav-link nav-link-grid">
                                    <img src="{{asset('assets/icons/close-button.svg')}}"></a>
                            </li>
                        </div>
                        <div class="offcanvas-body p-0">
                            <div class="" id="body-wrapper">
                                <div class="d-flex flex-row align-items-center justify-content-between px-2">
                                    <div class="form-check-label f-15">Змінити висоту рядка:</div>
                                    <div class="form-check form-check-warning form-switch d-flex align-items-center"
                                         style="">
                                        <button class="changeMenu-3">
                                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 10.5H21" stroke="#A8AAAE" stroke-width="1.75"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9 15H21" stroke="#A8AAAE" stroke-width="1.75"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9 19.5H21" stroke="#A8AAAE" stroke-width="1.75"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                        <button class="changeMenu-2 active-row-table ">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3 6H15" stroke="#A8AAAE" stroke-width="1.75"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M3 12H15" stroke="#A8AAAE" stroke-width="1.75"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>

                                    </div>
                                </div>
                                <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                    <label class="form-check-label f-15" for="changeFonts">Збільшити шрифт</label>
                                    <div class="form-check form-check-warning form-switch">
                                        <input type="checkbox" class="form-check-input checkbox"
                                               id="changeFonts"/>
                                    </div>
                                </div>
                                <div class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                                    <label class="form-check-label f-15" for="changeCol">Зміна розміру
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
                <div class="table-block" id="documentDataTable">

                </div>
            </div>
        </div>
    @else
        <div class="px-1" style="margin-top: 253px">
            <div class="empty-company text-center">
                У вас ще немає жодного документу цього типу!
            </div>
            <div class="empty-company-title empty-company-title-m text-center mt-1">
                Створіть новий документ
            </div>
            <div class="text-center mt-2">
                <a href="{{route('document.create',['document_type'=>$documentType->id])}}"
                   class="btn btn-green">
                    <img class="plus-icon" src="{{asset('assets/icons/plus.svg')}}">
                    Створити документ
                </a>
            </div>
        </div>

    @endif
@endsection

@section('page-script')
    @if($documentsCount)
        <script type="module">
            import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';

            tableSetting($('#documentDataTable'));

        </script>
        <script type="module">
            import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';

            offCanvasByBorder($('#documentDataTable'));

        </script>

        <script>
            let settings = {!! $documentType->settings !!};
            let fieldsData = JSON.parse(JSON.stringify(settings['fields']['header']))
            let customBlocks = JSON.parse(JSON.stringify(settings['custom_blocks']))
            let fields = []
            let columns = []
            let listSourceArray = []
            for (let key in fieldsData) {
                if (fieldsData.hasOwnProperty(key)) {
                    let item = fieldsData[key];
                    fields.push({name: 'data->header->' + key, type: 'string'})
                    if (key.includes("uploadFile_")) {
                        columns.push({
                            minwidth: "200",
                            dataField: 'data->header->' + key,
                            align: 'left',
                            cellsalign: 'left',
                            text: item.name,
                            cellsrenderer: function (row, column, rowData) {
                                let rowObj = $('#documentDataTable').jqxGrid('getrowdata', row)
                                let filesArray = rowData.split(", ");
                                let html = '<div>'
                                filesArray.forEach(function (file) {
                                    let fileName = file.split('.')
                                    let md5String = md5(fileName[0] + '_' + rowObj.id) + '.' + fileName[1]
                                    console.log(md5String)
                                    let urlToUpload = window.location.origin + '/uploads/documents/' + md5String
                                    html += '<a href="' + urlToUpload + '" class="text-decoration-none" download>' + file + '</a> '
                                })
                                html += '</div>'
                                return html;
                            }
                        })
                    } else {
                        columns.push({
                            minwidth: "200",
                            dataField: 'data->header->' + key,
                            align: 'left',
                            cellsalign: 'left',
                            text: item.name,
                        })
                    }
                    listSourceArray.push({label: item.name, value: 'data->header->' + key, checked: true})
                }
            }

            for (let i = 0; i < Object.keys(customBlocks).length; i++) {
                for (let key in customBlocks[i]) {
                    let item = customBlocks[i][key];
                    fields.push({name: 'data->custom_blocks->' + i + '->' + key, type: 'string'})
                    if (key.includes("uploadFile_")) {
                        columns.push({
                            dataField: 'data->custom_blocks->' + i + '->' + key,
                            align: 'left',
                            minwidth: "200",
                            cellsalign: 'left',
                            text: item.name,
                            cellsrenderer: function (row, column, rowData) {
                                let rowObj = $('#documentDataTable').jqxGrid('getrowdata', row)
                                let filesArray = rowData.split(", ");
                                let html = '<div>'
                                filesArray.forEach(function (file) {
                                    let fileName = file.split('.')
                                    let md5String = md5(fileName[0] + '_' + rowObj.id) + '.' + fileName[1]
                                    console.log(md5String)
                                    let urlToUpload = window.location.origin + '/uploads/documents/' + md5String
                                    html += '<a href="' + urlToUpload + '" class="text-decoration-none" download>' + file + '</a> '
                                })
                                html += '</div>'
                                return html;
                            }
                        })
                    } else {
                        columns.push({
                            dataField: 'data->custom_blocks->' + i + '->' + key,
                            align: 'left',
                            minwidth: "200",
                            cellsalign: 'left',
                            text: item.name,
                        })
                    }

                    listSourceArray.push({
                        label: item.name,
                        value: 'data->custom_blocks->' + i + '->' + key,
                        checked: true
                    })
                }
            }

            //console.log(fields, columns, listSourceArray)

        </script>
        <script src="http://www.myersdaily.org/joseph/javascript/md5.js"></script>
    @endif
@endsection
