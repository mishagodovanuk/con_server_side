@extends('layouts.admin')
@section('title','Кабінет диспетчера')
@section('page-style')
@endsection
@section('before-style')
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/vendors.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/forms/wizard/bs-stepper.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/forms/select/select2.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/core/menu/menu-types/vertical-menu.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/form-validation.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/form-wizard.css'))}}">
    <style>
        #t2, #t3, #t4 {
            display: none !important;
        }

        #t1 {
            display: block!important;
        }
    </style>
@endsection
@section('table-js')
    @include('layouts.table-scripts')
    <script type="module" src="{{asset('assets/js/grid/match/dispatcher/created-table.js')}}"></script>
    <script type="text/javascript">
        let baseUrl = window.location.origin + '/match/consolidation/filter?status=draft&type='
        let url = baseUrl+'uploading'
        // Ініціалізуємо таби
        $('#tabs').jqxTabs({
            width: '100%',
            height: '100%'
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid px-3">
        <div class="row d-flex">
            @include('match.dispatcher.layout.left-nav')
            <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xxl-10 px-0">
                <div class="tab-content pb-0">
                @include('match.dispatcher.content.created', ['breadcrumb_label' => __('localization.draft_link')])
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script src="{{asset('vendors/js/forms/wizard/bs-stepper.min.js')}}"></script>
    <script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/form-wizard.js')}}"></script>

    <script type="module" src="{{asset('assets/js/entity/match/created-match.js')}}"></script>


    <script type="module">
        import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';

        tableSetting($('#created-consolidation-table'));
    </script>
    <script type="module">
        import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';

        offCanvasByBorder($('#created-consolidation-table'));
    </script>

@endsection
