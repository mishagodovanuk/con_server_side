import {pagerRenderer} from "../../../components/pager.js";
import {toolbarRender} from "../../../components/toolbar-advanced.js";
import {listbox} from "../../../components/listbox.js";
import {hover} from "../../../components/hover.js";


const pagerRendererLeftovers = pagerRenderer.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});

$(document).ready(function () {
    let table = $("#rv-transport-planning-table");
    let isRowHovered = false;

    window.Echo.channel('reserve-cargo-request').listen("ReserveTransportPlanning", (event) => {
        let tpId = event.id
        console.log(tpId)
    });

    window.Echo.channel('reserve-transport-planning').listen("UnreserveTransportPlanning", (event) => {
        let tpId = event.id
        console.log(tpId)
    });

    let dataFields = [
        {name: "id", type: "string"},
        {name: "download", type: "string"},
        {name: "upload", type: "string"},
        {name: "download_date", type: "string"},
        {name: "download_time", type: "string"},
        {name: "upload_date", type: "string"},
        {name: "upload_time", type: "string"},
        {name: "free_space_pallets", type: "string"},
        {name: "free_space_weight", type: "string"},
    ];

    var myDataSource = {
        datatype: "json",
        datafields: dataFields,
        url: window.location.origin + '/match/cargo-request/filter',
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

            return toolbarRendererLeftovers(
                statusbar,
                table,
                true,
                1,
                columnCount - 1,
            ); // Subtract 1 to exclude the action column
        },
        columns: [
            {
                dataField: "number",
                align: "left",
                cellsalign: "right",
                text: "Reqeust №",
                width: 120,
                editable: false,
                cellsrenderer: function (
                    row,
                    column,
                    value,
                    defaultHtml,
                    columnSettings,
                    rowData
                ) {

                    $(document).ready(function () {
                        $(".btn-table-cell-add-rv").click(function () {
                            $(".rv-loading-wizard-container").hide();
                            $(".rv-transport-tp-view").show();
                        });
                    });

                    return `<a data-id="${rowData.id}" style="color: #D9B414;" class="ps-1 fw-bold my-auto btn-table-cell-add-rv">${rowData.id}</a>`;
                },
            },
            {
                dataField: "download",
                align: "left",
                cellsalign: "right",
                text: "Dispatch",
                minwidth: 200,
                editable: false,
                cellsrenderer: function (row,
                                         column,
                                         value,
                                         defaultHtml,
                                         columnSettings,
                                         rowData) {
                    return `<p class="ps-1 text-secondary my-auto">${value}</p>`;
                },
            },
            {
                width: 140,
                dataField: "download_time",
                align: "left",
                cellsalign: "right",
                text: "Date/Time",
                editable: false,
                cellsrenderer: function (row,
                                         column,
                                         value,
                                         defaultHtml,
                                         columnSettings,
                                         rowData) {

                    return `<div class="ps-1"><div><span class="text-secondary">${rowData.download_date}</span></div><div><span class="text-secondary">${rowData.download_time}</span></div></div>`;
                },
            },
            {
                minwidth: 200,
                dataField: "upload",
                align: "left",
                cellsalign: "right",
                text: "Delivery",
                editable: false,
                cellsrenderer: function (row,
                                         column,
                                         value,
                                         defaultHtml,
                                         columnSettings,
                                         rowData) {
                    return `<p class="ps-1 text-secondary my-auto">${value}</p>`;
                },
            },
            {
                width: 140,
                dataField: "upload_time",
                align: "left",
                cellsalign: "right",
                text: "Date/Time",
                editable: false,
                cellsrenderer: function (row,
                                         column,
                                         value,
                                         defaultHtml,
                                         columnSettings,
                                         rowData) {
                    return `<div class="ps-1"><div><span class="text-secondary">${rowData.upload_date}</span></div><div><span class="text-secondary">${rowData.upload_time}</span></div></div>`;
                },
            },

            {
                width: 150,
                dataField: "freeSpace",
                align: "left",
                cellsalign: "right",
                text: "Space Available",
                editable: false,
                cellsrenderer: function (row,
                                         column,
                                         value,
                                         defaultHtml,
                                         columnSettings,
                                         rowData) {
                    return `<div class="ps-1"><div><span class="text-secondary">${rowData.free_space_pallets} pal</span></div><div><span class="text-secondary">${rowData.free_space_weight} kg</span></div></div>`;
                },
            },

            {
                width: "70px",
                dataField: "action",
                align: "center",
                cellsalign: "center",
                text: "Дія",
                renderer: function () {
                    return '<div style="display: flex; align-items: center; justify-content: center; height: 100%;"></div>';
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
                    let button = `<button data-id="${rowData.id}" style="padding:4px; border: 1px solid gray;" class="btn btn-table-cell rv-loading-add-tp" type="button"> <img src="${window.location.origin}/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/plus-gray.svg" alt="plus"> </button>`;

                    $(document).ready(function () {
                        $(".rv-loading-add-tp").click(function () {
                            $(".rv-loading-wizard-container").hide();
                            $(".rv-loading-items-view").show();
                        });
                    });

                    return (
                        '<div class="jqx-popover-wrapper">' + button + "</div>"
                    );
                },
            },
        ],
    });

    let listSource = [
        {label: "Reqeust №", value: "number", checked: true},
        {label: "Dispatch", value: "uploading", checked: true},
        {label: "Date/Time", value: "download_time", checked: true},
        {label: "Delivery", value: "offloading", checked: true},
        {label: "Date/Time", value: "upload_time", checked: true},
        {label: "Space Available", value: "freeSpace", checked: true},
        {label: "Actions", value: "action", checked: true},
    ];

    listbox(table, listSource);
    hover(table, isRowHovered);
});
