import {pagerRenderer} from "../../../components/pager.js";
import {toolbarRender} from "../../../components/toolbar-advanced.js";
import {listbox} from "../../../components/listbox.js";
import {hover} from "../../../components/hover.js";

const listBoxSetting = listbox.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});
const pagerRendererLeftovers = pagerRenderer.bind({});

$(document).ready(function () {
    let tabTypes =  ['all','common_trip','start_point','end_point']
    let tabType = tabTypes[0]

    let table = $("#rv-all-table");
    let isRowHovered = false;

    let dataFields = [
        {name: 'id', type: 'string'},
        {name: "shippingPoint", type: "string"},
        {name: "deliveryPoint", type: "string"},
        {name: 'dispatchDate', type: 'string'},
        {name: "cargoType", type: "string"},
        {name: "cargoTypeIds", type: "string"},
        {name: "palletsCount", type: "integer"},
        {name: "commonCount", type: "integer"},
    ];

    var myDataSource = {
        datatype: "json",
        datafields: dataFields,
        url: window.location.origin + '/match/transport-planning/filter-by-cargo-request?cargoRequest='
            +cargoRequestId+'&tab=' + tabType,
        root: 'data',
        beforeprocessing: function (data) {
            myDataSource.totalrecords = data.total;
        },
        filter: function () {
            // update the grid and send a request to the server.
            table.jqxGrid('updatebounddata', 'filter');
        },
        sort: function () {
            $('.search-btn')[0].click()
        },
    };

    $('#tabs20').bind('selected', function (event) {
        var item = event.args.item;
        tabType = tabTypes[item]
        myDataSource.url = window.location.origin
            + '/match/transport-planning/filter-by-cargo-request?cargoRequest='
        +cargoRequestId+'&tab=' + tabType,
        table.jqxGrid("updatebounddata")
    });

    var grid = table.jqxGrid({
        theme: "light-wms warehouse-table-custom",
        width: "100%",
        autoheight: true,
        pageable: true,
        source: new $.jqx.dataAdapter(myDataSource),
        pagerRenderer: function () {
            return pagerRendererLeftovers(table);
        },
        ready() {
            checkUrl();
        },
        sortable: true,
        columnsResize: false,
        filterable: true,
        filtermode: "default",
        localization: getLocalization("en"),
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

            return toolbarRendererLeftovers(
                statusbar,
                table,
                true,
                1,
                columnCount - 1,
                '-6'
            ); // Subtract 1 to exclude the action column
        },
        columns: [
            {
                dataField: "id",
                align: "left",
                cellsalign: "right",
                text: "Route №",
                minwidth: 120,
                editable: false,
                cellsrenderer: function (row, column, value, defaultHtml, columnSettings, rowData) {


                    return `<a data-id="${value}" style="color: #D9B414;" class="ps-1 fw-bold my-auto btn-view-tp-details">${value}</a>`;
                },
            },
            {
                dataField: "shippingPoint",
                align: "left",
                cellsalign: "right",
                text: "Shipping point",
                width: 160,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="ps-1 text-secondary my-auto">${value}</p>`;
                },
            },
            {
                width: 140,
                dataField: "deliveryPoint",
                align: "left",
                cellsalign: "right",
                text: "Delivery point",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class=" text-secondary ps-1 my-auto">${value}</p>`;
                },
            },
            {
                width: 150,
                dataField: "dispatchDate",
                align: "left",
                cellsalign: "right",
                text: "Dispatch date",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="ps-1 text-secondary my-auto">${value}</p>`;
                },
            },
            {
                minwidth: 180,
                dataField: "cargoType",
                align: "left",
                cellsalign: "right",
                text: "Cargo type",
                editable: false,
                cellsrenderer: function (row, column, value, defaultHtml, columnSettings, rowData) {
                    return `<p class="ps-1 text-secondary my-auto" id="cargo-type${rowData.id}">${value}</p>`;
                },
            },

            {
                width: 180,
                dataField: "pallets",
                align: "left",
                cellsalign: "right",
                text: "Pallets space",
                editable: false,
                cellsrenderer: function (row, column, value, defaultHtml, columnSettings, rowData) {
                    return `<p class="ps-1 my-auto text-secondary">${rowData.palletsCount + '/' + rowData.commonCount}</p>`;
                },
            },

            {
                width: '70px',
                dataField: 'action',
                align: 'center',
                cellsalign: 'center',
                text: "Дія",
                renderer: function () {
                    return '<div style="display: flex; align-items: center; justify-content: center; height: 100%;"></div>';
                },
                filterable: false,
                sortable: false,
                id: "action",
                cellClassName: "action-table-drop",
                className: "action-table",
                cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowData) {

                    let button = `<button data-id="${rowData.id}" style="padding:4px; border: 1px solid gray;" class="btn btn-table-cell add-item-tp" type="button"> <img src="${window.location.origin}/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/plus-gray.svg" alt="plus"> </button>`;



                    return '<div class="jqx-popover-wrapper">' + button + '</div>';
                }

            },
        ],
    });

    let listSource = [
        {label: "Route №", value: "id", checked: true},
        {label: "Shipping point", value: "startPoint", checked: true},
        {label: "Delivery point", value: "endPoint", checked: true},
        {label: "Dispatch date", value: "date", checked: true},
        {label: "Cargo type", value: "type", checked: true},
        {label: "Pallets space", value: "freePallets", checked: true},
        {label: "Actions", value: "action", checked: true},
    ];

    listbox(table, listSource, "-6");
    hover(table, isRowHovered);
});
