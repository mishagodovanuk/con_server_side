@extends('layouts.admin')
@section('title','Кабінет логіста')
@section('before-style')
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/libs/jqwidget/jqwidgets/styles/jqx.light-wms.css')}}" type="text/css"/>
    <style>
        #t1, #t2, #t3, #t4 {
            display: none !important;
        }

        #t5 {
            display: block!important;
        }
    </style>
@endsection
@section('table-js')
    @include('layouts.table-scripts')
    <script type="module" src="{{asset('assets/js/grid/match/logist/logist-table.js')}}"></script>
    <script type="text/javascript">
         let baseUrl = window.location.origin + '/match/consolidation/filter?status=unapproved&type='
        let url = baseUrl+'uploading'
        $('#tabs').jqxTabs({
            width: '100%',
            height: '100%'
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid px-3 ">
        <div class="row d-flex">
        @include('match.logist.layout.nav')
            <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xxl-10 px-0 h-100">
                <div class="tab-content pb-0 h-100">
                @include('match.logist.content.view-review&rejected', ['breadcrumb_label' => __('local_logist.logist_cab_rejected')])
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')

<script type="module">   
import {setActiveTab} from '{{asset('assets/js/entity/match/utils/setActiveTab.js')}}';
    setActiveTab();
    $(document).on("click", ".jqx-fill-state-pressed", function () {
        setActiveTab();
    });
        </script>
    <script type="module" src="{{asset('assets/js/entity/match/logist/view-consolidation.js')}}"></script>
    <script type="module">
           import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';
        tableSetting($('#logist-table'));
    </script>
    <script type="module">
     import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';
        offCanvasByBorder($('#logist-table'));
    </script>
@endsection
