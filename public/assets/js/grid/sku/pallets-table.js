import {pagerRenderer} from "../components/pager.js";
import {toolbarRender} from "../components/toolbar-advanced.js";
import {listbox} from "../components/listbox.js";

const listBoxSetting = listbox.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});
const pagerRendererLeftovers = pagerRenderer.bind({});

$(document).ready(function () {

    let table = $("#pallets-table");

    let dataFields = [
        {name: "barcode", type: "number"},
        {name: "user", type: "string"},
        {name: "changed", type: "string"},
    ];


    var myDataSource = {
        datatype: "array",
        datafields: dataFields,
        localdata: customData,
    };

    let dataAdapter = new $.jqx.dataAdapter(myDataSource);
    var grid = table.jqxGrid({
        theme: "light-wms",
        width: "100%",
        autoheight: true,
        pageable: true,
        source: dataAdapter,
        pagerRenderer: function () {
            return pagerRendererLeftovers(table);
        },
        virtualmode: true,
        rendergridrows: function () {
            return dataAdapter.records;
        },
        ready() {
            checkUrl();
        },
        sortable: true,
        columnsResize: false,
        filterable: true,
        filtermode: "default",
        localization: getLocalization("uk"),
        selectionMode: "checkbox",
        enablehover: false,
        columnsreorder: true,
        autoshowfiltericon: true,
        pagermode: "advanced",
        rowsheight: 35,
        filterbarmode: "simple",
        toolbarHeight: 45,
        showToolbar: true,
        filter: function () {
            var columnindex = table.jqxGrid("getcolumnindex", "Action");

            var filterinfo = table.jqxGrid("getfilterinformation")[columnindex];

            // Disable filtering for the "Name" column
            if (filterinfo != null && filterinfo.filter != null) {
                filterinfo.filter.setlogic("and");
                filterinfo.filter.setoperator(0);
                filterinfo.filter.setvalue("");
            }
        },
        rendertoolbar: function (statusbar) {
            var columns = table.jqxGrid("columns").records;
            var columnCount = columns.length;
            //console.log(columns)
            //console.log(columnCount)
            return toolbarRendererLeftovers(
                statusbar,
                table,
                true,
                1,
                columnCount - 1,
                '-pallets'
            ); // Subtract 1 to exclude the action column
        },
        columns: [

            {
                dataField: "barcode",
                align: "left",
                cellsalign: "right",
                text: "Штрих код",
                width: 300,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary   " style="padding-left: 5px" >${value}</p>`;
                },
            },
            {
                dataField: "user",
                align: "left",
                cellsalign: "right",
                text: "Користувач",
                minwidth: 110,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<a href="#" class="mb-0 d-flex  " style="padding-left: 5px" >${value}</a>`;
                },
            },
            {
                dataField: "changed",
                align: "left",
                cellsalign: "right",
                text: "Змінено",
                width: 200,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary   " style="padding-left: 5px" >${value}</p>`;

                },
            },
            {
                width: '70px',
                dataField: 'action',
                align: 'center',
                cellsalign: 'center',
                text: "Дія",
                renderer: function () {
                    return '<div style="display: flex; align-items: center; justify-content: center; height: 100%;"><img src="' + window.location.origin + '/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/setting-button-table.svg" alt="setting-button-table"></div>';
                },
                filterable: false,
                sortable: false,
                id: "action",
                cellClassName: "action-table-drop ",
                className: "action-table",
                cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
                    // let button = '<button style="padding:0" class="btn btn-table-cell" type="button" data-bs-toggle="popover"> <img src="' + window.location.origin + '/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/menu_dots_vertical.svg" alt="menu_dots_vertical"> </button>';
                    // $(document).on('click', '[data-bs-toggle="popover"]', function () {
                    //     $(this).popover({
                    //         html: true,
                    //         sanitize: false,
                    //         content: function () {
                    //             return '<div><ul class="popover-castom" style="list-style: none">     <li><a class="dropdown-item" href="#">Перегляд</a></li><li><a class="dropdown-item" href="#">Редагування</a></li><li><a class="dropdown-item" href="#">Видалення</a></li>  </ul></div>'; // Replace with your popover content
                    //         },
                    //         placement: 'left',
                    //         trigger: 'focus',
                    //
                    //     }).popover('show');
                    // });
                    // return '<div class="jqx-popover-wrapper">' + button + '</div>';

                    return '<button style="padding:0" class="btn btn-table-cell" type="button"  data-bs-toggle="modal" id="button_paking" data-bs-target="#edit_bar_code"> <img src="' + window.location.origin + '/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/menu_dots_vertical.svg" alt="menu_dots_vertical"> </button>';

                }

            },

        ],
    });

    let listSource = [
        {label: "Штрих код", value: "barcode", checked: true},
        {label: "Користувач", value: "user", checked: true},
        {label: "Змінено", value: "changed", checked: true},
        {label: "Дії", value: "action", checked: true}

    ];
    listBoxSetting(table, listSource, "-pallets");

});

var customData = [
    {
        barcode: 2123123128,
        user: "Тарас Іванів",
        changed: "14:34 30/07/21",
    },
    {
        barcode: 2123123128,
        user: "Тарас Іванів",
        changed: "14:34 30/07/21",
    },

    {
        barcode: 2123123128,
        user: "Тарас Іванів",
        changed: "14:34 30/07/21",
    },

    {
        barcode: 2123123128,
        user: "Тарас Іванів",
        changed: "14:34 30/07/21",
    },
    {
        barcode: 2123123128,
        user: "Тарас Іванів",
        changed: "14:34 30/07/21",
    },
    {
        barcode: 2123123128,
        user: "Тарас Іванів",
        changed: "14:34 30/07/21",
    },
    {
        barcode: 2123123128,
        user: "Тарас Іванів",
        changed: "14:34 30/07/21",
    },
    {
        barcode: 2123123128,
        user: "Тарас Іванів",
        changed: "14:34 30/07/21",
    },
    {
        barcode: 2123123128,
        user: "Тарас Іванів",
        changed: "14:34 30/07/21",
    },
    {
        barcode: 2123123128,
        user: "Тарас Іванів",
        changed: "14:34 30/07/21",
    }, {
        barcode: 2123123128,
        user: "Тарас Іванів",
        changed: "14:34 30/07/21",
    },
]