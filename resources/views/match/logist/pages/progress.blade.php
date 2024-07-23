@extends('layouts.admin')
@section('title','Кабінет логіста')
@section('before-style')
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/pickadate/pickadate.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/forms/pickers/form-pickadate.css'))}}">

    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/maps/leaflet.min.css'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset(mix('css/base/plugins/maps/map-leaflet.css'))}}">

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
         let baseUrl = window.location.origin + '/match/consolidation/filter?status=in_progress&type='
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
                    @include('match.logist.content.in-progress')
                 
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{asset('vendors/js/maps/leaflet.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

    <script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script type="module">   
import {setActiveTab} from '{{asset('assets/js/entity/match/utils/setActiveTab.js')}}';
    setActiveTab();
    $(document).on("click", ".jqx-fill-state-pressed", function () {
        setActiveTab();
    });
        </script>
<script>var enableHover = true;

var dataActions =[
    {
        id: "1",

        name: "loading",
        address: "126 G, Bohdan Khmelnitsky St. Lviv",
        time: { date: "06.11.2023", period: "08:00-09:00" },
        tns: ['2', '4']
    },
    {
        id: "2",
 
        name: "moving",
        address: "112 Mykhailo Hrushevskyi St. Dubno",
        time: { date: "06.11.2022", period: "09:30-11:30" },
        tns: ['2', '4']
    },
    {
        id: "3",
    
        name: "loading",
        address: "112 Mykhailo Hrushevskyi St. Dubno",
        time: { date: "06.11.2022", period: "09:30-11:30" },
        tns: ['5', '1', '3']
    },
    {
        id: "4",
   
        name: "moving",
        address:"33 Zelena St. Kyiv",
        time: { date: "07.11.2002", period: "16:00-19:00" },
        tns: ['1', '2', '3','4', '5']
    },
    {
        id: "5",
       
        name: "unloading",
        address:"33 Zelena St. Kyiv",
        time: { date: "07.11.2002", period: "16:00-19:00" },
        tns: ['3', '2', '4']
    },
    {
        id: "6",
        
        name: "moving",
        address: "45,Shevchenka St. Kyiv",
        time: { date: "06.11.2022", period: "09:30-11:30" },
        tns: ['1', '5']
    },
    {
        id: "7",
      
        name: "unloading",
        address: "45,Shevchenka St. Kyiv",
        time: { date: "07.11.2002", period: "19:20-19:45" },
        tns: ['1','5']
    }
]


</script>
<script>
    $(".nav-link").click(function () {
            $(".nav-link").removeClass("active");
            $(this).addClass("active");
        });
        function setActiveTab() {
    var $pressedElements = $(".jqx-fill-state-pressed");
    $(".alert").removeClass("alert-active-tab");

    $pressedElements.each(function () {
        var $this = $(this);
        var $alertElement = $this.find(".alert");
        $alertElement.addClass("alert-active-tab");
    });
}
$(document).ready(function () {
    setActiveTab();
    $(document).on("click", ".jqx-fill-state-pressed", function () {
        setActiveTab();
    });
});
        </script>
    <script type="module" src="{{asset('assets/js/entity/match/logist/in-progress.js')}}"></script>
    <script type="module" src="{{asset('assets/js/entity/match/logist/visual-in-progress.js')}}"></script>
    <script type="module" src="{{asset('assets/js/entity/match/logist/route-map.js')}}"></script>

    <script type="module">
           import {tableSetting} from '{{asset('assets/js/grid/components/table-setting.js')}}';
        tableSetting($('#logist-table'));
    </script>
    <script type="module">
     import {offCanvasByBorder} from '{{asset('assets/js/utils/offCanvasByBorder.js')}}';
        offCanvasByBorder($('#logist-table'));
    </script>
@endsection
