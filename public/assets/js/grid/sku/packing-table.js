import {pagerRenderer} from "../components/pager.js";
import {toolbarRender} from "../components/toolbar-advanced.js";
import {listbox} from "../components/listbox.js";
import {hover} from "../components/hover.js";

const listBoxSetting = listbox.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});
const pagerRendererLeftovers = pagerRenderer.bind({});

var packageTypes;

$(document).ready(function () {
    let table = $("#packing-table");
    let isRowHovered = false;

    let dataFields = [
        {name: "type", type: "string"},
        {name: "packingSetMain", type: "boolean"},
        {name: "count", type: "string"},
        {name: "packingWeight", type: "string"},
        {name: "weightNet", type: "string"},
        {name: "weightGross", type: "string"},
        {name: "size", type: "string"},
        {name: "id", type: "string"},
    ];
    var myDataSource = {}
    if (sku_id) {
        myDataSource = {
            datatype: "json",
            datafields: dataFields,
            url: window.location.origin + `/sku/table/${sku_id}/package-filter`,
            root: 'data',
            beforeprocessing: function (data) {
                myDataSource.totalrecords = data.total;
            },
            filter: function () {
                // update the grid and send a request to the server.
                table.jqxGrid('updatebounddata', 'filter');
            },
            sort: function () {
                // update the grid and send a request to the server.
                table.jqxGrid('updatebounddata', 'sort');
            },
        };
    } else {
        myDataSource = {
            datatype: "array",
            datafields: dataFields,
            localdata: packingData,
        };
    }
    let dataAdapter = new $.jqx.dataAdapter(myDataSource);
    var grid = table.jqxGrid({
        theme: "light-wms sku-use-of-products-custom",
        width: "100%",
        autoheight: true,
        pageable: true,
        source: dataAdapter,
        pagerRenderer: function () {
            return pagerRendererLeftovers(table);
        },
        // virtualmode: true,
        // rendergridrows: function () {
        //     return dataAdapter.records;
        // },
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
                columnCount,
            ); // Subtract 1 to exclude the action column
        },
        columns: [
            {
                dataField: "type",
                align: "left",
                cellsalign: "right",
                text: "Тип пакування",
                editable: false,
                cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {

                    const namePacking = isNumeric(value) ? packageTypes.find((el) => el.id == value).name : value;
                    return `<p class="mb-0 d-flex text-secondary px-1" >${namePacking}</p>${rowdata.packingSetMain ? '<div class="alert alert-primary p-0 mx" style="padding : 2px 10px !important;">Основне</div>' : ''}`;
                },
                minwidth: 120,
            },

            {
                dataField: "count",
                align: "left",
                cellsalign: "right",
                text: "К-сть одиниць (м2)",
                width: 160,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary   ps-1  " style="" >${value}</p>`;
                },
            },
            {
                dataField: "packingWeight",
                align: "left",
                cellsalign: "right",
                text: "Маса пакування",
                width: 160,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary   ps-1  " style="" >${value}</p>`;
                },
            },
            {
                width: 160,
                dataField: "weightNet",
                align: "left",
                cellsalign: "right",
                text: "Маса нетто (кг)",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary   ps-1  " style="" >${value}</p>`;
                },
            },
            {
                width: 160,
                dataField: "weightGross",
                align: "left",
                cellsalign: "right",
                text: "Маса брутто (кг)",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary   ps-1  " style="" >${value}</p>`;
                },
            },
            {
                minwidth: 280,
                dataField: "size",
                align: "left",
                cellsalign: "right",
                text: "Розміри (см)",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary   ps-1  " style="" >Висота ${value.height}, Ширина ${value.width}, Довжина ${value.length}</p>`;
                },
            },
//             {
//                 width: "70px",
//                 dataField: 'action',
//                 align: 'center',
//                 cellsalign: 'center',
//                 text: "Дія",
//                 renderer: function () {
//                     return '<div style="display: flex; align-items: center; justify-content: center; height: 100%;"><img src="' + window.location.origin + '/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/setting-button-table.svg" alt="setting-button-table"></div>';
//                 },
//                 filterable: false,
//                 sortable: false,
//                 id: "action",
//                 cellClassName: "action-table-drop ",
//                 className: "action-table",
//                 cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
//
// const rowDataStringiry= JSON.stringify(rowdata);
// const fullInfoPage = !window.location.pathname.includes('edit') && !window.location.pathname.includes('create') ;
//                     return `<button style="padding:0" class="btn btn-table-cell ${fullInfoPage && "d-none"}" type="button"  data-bs-toggle="modal" id="button_paking" data-bs-target="#edit_paking" data-packet='${rowDataStringiry}'> <img src="${window.location.origin}/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/menu_dots_vertical.svg" alt="menu_dots_vertical"> </button>`;
//                 }
//
//             },
        ],
    });

    let listSource = [
        {label: "Тип пакування", value: "type", checked: true},
        {label: "К-сть одиниць (м2)", value: "count", checked: true},
        {label: "Маса нетто (кг)", value: "weightNet", checked: true},
        {label: "Маса брутто (кг)", value: "weightGross", checked: true},
        {label: "Розміри (см)", value: "size", checked: true},
        // {label: "Дії", value: "action", checked: true}
    ];

    listBoxSetting(table, listSource);
    hover(table, isRowHovered);

    var packageTypesUrl = `${window.location.origin}/dictionary/package_type`;

    function fetchDataAndStore(url) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    resolve(data);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    reject(error);
                }
            });
        });
    }

    fetchDataAndStore(packageTypesUrl)
        .then(data => {
            packageTypes = data.data;
        })
        .catch(error => {
            console.log('error', error)
        });

    function isNumeric(str) {
        return !isNaN(str) && !isNaN(parseFloat(str));
    }

});



