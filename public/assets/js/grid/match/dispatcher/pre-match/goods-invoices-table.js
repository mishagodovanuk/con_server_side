import {pagerRenderer} from "../../../components/pager.js";
import {toolbarRender} from "../../../components/toolbar-advanced.js";
import {listbox} from "../../../components/listbox.js";
import {hover} from "../../../components/hover.js";

const listBoxSetting = listbox.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});
const pagerRendererLeftovers = pagerRenderer.bind({});

$(document).ready(function () {
    let table = $("#goods-invoices-table");
    let isRowHovered = false;
    let tabTypes =  ['all','common_trip','start_point','end_point']
    let tabType = tabTypes[0]


    window.Echo.channel('reserve-goods-invoice').listen("ReserveGoodsInvoice", (event) => {
        let tnId = event.id
        console.log(tnId)
    });

    window.Echo.channel('reserve-goods-invoice').listen("UnreserveGoodsInvoice", (event) => {
        let tnId = event.id
        console.log(tnId)
    });

    // Optional: Event handler for changing tabs
    $('#tabs').bind('selected', function (event) {
        var item = event.args.item;
        tabType = tabTypes[item]
        goodsInvoiceDataSource.url = window.location.origin + '/match/goods-invoice/filter?transportPlanningId='
            +transportPlanningId+'&tab=' + tabType
        table.jqxGrid("updatebounddata")
    });

    let dataFields = [
        {name: "id", type: "number"},
        {name: "supplier", type: "object"},
        {name: "buyer", type: "object"},
        {name: "loading_info", type: "object"},
        {name: "unloading_info", type: "object"},
        {name: "pallet", type: "number"},
        {name: "cargoTypeIds", type: "string"},
    ];


    goodsInvoiceDataSource = {
        datatype: "json",
        datafields: dataFields,
        root: 'data',
        beforeprocessing: function (data) {
            goodsInvoiceDataSource.totalrecords = data.total;
        },
        filter: function () {
            // update the grid and send a request to the server.
            table.jqxGrid('updatebounddata', 'filter');
        },
        sort: function () {
            $('.search-btn')[0].click()
        },
    };

    let dataAdapter = new $.jqx.dataAdapter(goodsInvoiceDataSource);
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
        localization: getLocalization("en"),
        selectionMode: "checkbox",
        enablehover: false,
        columnsreorder: true,
        autoshowfiltericon: true,
        pagermode: "advanced",
        rowsheight: 70,
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
                "-6"
            ); // Subtract 1 to exclude the action column
        },
        columns: [
            {
                dataField: "number",
                align: "left",
                cellsalign: "right",
                text: "CN №",
                editable: false,
                cellsrenderer: function (row, column, value, defaultHtml, columnSettings, rowData) {
              
                    return `<a data-id="${rowData.id}" data-value="${rowData.id}" class="btn-view-tn-item mb-0 d-flex fw-bold ps-1 " style="color: #D9B414;">${rowData.id}</a>`;
                },
                width: "120px",
            },
            {
                dataField: "suplier",
                align: "left",
                cellsalign: "right",
                text: "Supplier",
                minwidth: "160px",
                editable: false,
                cellsrenderer: function (row, column, value, defaultHtml, columnSettings, rowData) {
                    return `<div><p class="mb-0 ps-1" style="">${rowData.supplier.company}</p><p class="mb-0 ps-1 text-secondary">${rowData.supplier.address}</p></div>`;
                },
            },
            {
                minwidth: "160px",
                dataField: "buyer",
                align: "left",
                cellsalign: "right",
                text: "Buyer",
                editable: false,
                cellsrenderer: function (row, column, value, defaultHtml, columnSettings, rowData) {
                    return `<div><p class="mb-0 ps-1" style="">${rowData.buyer.company}</p><p class="mb-0 ps-1 text-secondary">${rowData.buyer.address}</p></div>`;
                },
            },
            {
                width: "140px",
                dataField: "sending",
                align: "left",
                cellsalign: "right",
                text: "Dispatch",
                editable: false,
                cellsrenderer: function (row, column, value, defaultHtml, columnSettings, rowData) {
                    return `<div class="ps-1"><div><span class="text-secondary">${rowData.loading_info.date}</span></div><div><span class="text-secondary">${rowData.loading_info.start_at}-${rowData.loading_info.end_at}</span></div></div>`;
                },
            },
            {
                width: "140px",
                dataField: "delivery",
                align: "left",
                cellsalign: "right",
                text: "Delivery",
                editable: false,
                cellsrenderer: function (row, column, value, defaultHtml, columnSettings, rowData) {
                    return `<div class="ps-1"><div><span class="text-secondary">${rowData.unloading_info.date}</span></div><div><span class="text-secondary">${rowData.unloading_info.start_at}-${rowData.unloading_info.end_at}</span></div></div>`;
                },
            },
            {
                width: "120px",
                dataField: "pallets",
                align: "left",
                cellsalign: "right",
                text: "Pallets space",
                editable: false,
                cellsrenderer: function (row, column, value, defaultHtml, columnSettings, rowData) {
                    return `<div class="ps-1"><span class="text-secondary">${rowData.pallet}</span></div>`;
                },
            },
            {
                width: "70px",
                dataField: "action",
                align: "center",
                cellsalign: "center",
                text: "Дія",
                renderer: function () {
                    return (
                        '<div style="display: flex; align-items: center; justify-content: center; height: 100%;"></div>'
                    );
                },
                filterable: false,
                sortable: false,
                id: "action",
                cellClassName: "action-table-drop",
                className: "action-table",
                cellsrenderer: function (
                    row,
                    columnfield,
                    value,
                    defaulthtml,
                    columnproperties,
                    rowData
                ) {
                    let button = `<button data-id="${rowData.id}" style="padding:4px; border: 1px solid gray;" class="btn btn-table-cell add-tn-item" type="button"> <img src="${window.location.origin}/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/plus-gray.svg" alt="plus"> </button>`;
                    return '<div class="jqx-popover-wrapper">' + button + '</div>';
                },
            },
        ],
    });

    let listSource = [
        {label: "CN №", value: "number", checked: true},
        {label: "Supplier", value: "suplier", checked: true},
        {label: "Buyer", value: "buyer", checked: true},
        {label: "Dispatch", value: "sending", checked: true},
        {label: "Delivery", value: "delivery", checked: true},
        {label: "Pallets space", value: "pallets", checked: true},
        {label: "Actions", value: "action", checked: true},
    ];
    listBoxSetting(table, listSource, "-6");
    hover(table, isRowHovered);

});
