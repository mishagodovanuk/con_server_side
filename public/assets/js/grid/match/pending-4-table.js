import {pagerRenderer} from "../components/pager.js";
import {toolbarRender} from "../components/toolbar-advanced.js";
import {listbox} from "../components/listbox.js";
import {hover} from "../components/hover.js";
import {customData} from "../../entity/match/db/data-logist-tables.js";
import {getLocalizedText} from  "../../entity/match/localization/getLocalizedText.js";

const pagerRendererLeftovers = pagerRenderer.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});

$(document).ready(function () {
    let table = $("#pending-4-table");
    let isRowHovered = false;

// Function to apply the lookup filter and capture filtered data

    let dataFields = [
        {name: "number", type: "string"},
        {name: "created", type: "string"},
        {name: "members", type: "string"},
        {name: "startPoint", type: "string"},
        {name: "endPoint", type: "string"},
        {name: "pallets", type: "string"},
        {name: "id", type: "string"},
    ];

    var myDataSource = {
        datatype: "json",
        datafields: dataFields,
        localData:customData.filter(el=>(el.status==="Очікує на розгляд" || el.status==="Pending review") && el.typeConsolidation === "Backhaul"),   
        // url: window.location.origin + '/company/table/filter',
        // root: 'data',
        // beforeprocessing: function (data) {
        //     myDataSource.totalrecords = data.total;
        // },
        // filter: function () {
        //     // update the grid and send a request to the server.
        //     table.jqxGrid('updatebounddata', 'filter');
        // },
        // sort: function () {
        //     $('.search-btn')[0].click()
        // },
    };

    let dataAdapter = new $.jqx.dataAdapter(myDataSource);
    var grid = table.jqxGrid({
        theme: "light-wms companies-table-custom",
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

            return toolbarRendererLeftovers(
                statusbar,
                table,
                true,
                1,
                columnCount - 1,
                '-4'
            ); // Subtract 1 to exclude the action column
        },
        columns: [
            {
                dataField: "number",
                align: "left",
                cellsalign: "right",
                text: `${getLocalizedText('consolidation')}`,
                editable: false,
                cellsrenderer: function (row,
                                         columnfield,
                                         value,
                                         defaulthtml,
                                         columnproperties,
                                         rowdata) {
                    return `<a style="" class=" ps-1 d-flex my-auto open-view-consolid" data-id="${rowdata.id}"  href='#'>${value}</a>`;
                },
                width: 150
            },
            {
                dataField: "created",
                align: "left",
                cellsalign: "right",
                text: `${getLocalizedText('created')}`,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    const objDate= JSON.parse(value);
                    return `<p style="" class="text-secondary ps-1  my-auto" >${objDate.date} ${getLocalizedText('at')} ${objDate.time}</p>`;
                },
                minwidth: 170,
                filterable: false
            },
            {
                dataField: "members",
                align: "left",
                cellsalign: "right",
                text:  `${getLocalizedText('particioants')}`,
                minwidth: 90,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class=" text-secondary ps-1  my-auto" style="" >${value.length}</p>`;
                },
            },
            {
                minwidth: 120,
                dataField: "startPoint",
                align: "left",
                cellsalign: "right",
                text: `${getLocalizedText('starting_point')}`,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class=" text-secondary ps-1 my-auto " style="" >${value}</p>`;
                },
            },
            {
                minwidth: 120,
                dataField: "endPoint",
                align: "left",
                cellsalign: "right",
                text: `${getLocalizedText('end_point')}`,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class=" text-secondary ps-1 my-auto " style="" >${value}</p>`;
                },
            },
            {
                minwidth: 90,
                dataField: "pallets",
                align: "left",
                cellsalign: "right",
                text: `${getLocalizedText('pallet_space')}`,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="text-secondary  ps-1  my-auto" style="" >${value || '-'}</p>`;
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
                        '<div style="display: flex; align-items: center; justify-content: center; height: 100%;"><img src="' +
                        window.location.origin +
                        '/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/setting-button-table.svg" alt="setting-button-table"></div>'
                    );
                },
                filterable: false,
                sortable: false,
                id: "action",
                cellClassName: "action-table-drop ",
                className: "action-table",
                cellsrenderer: function (
                    row,
                    columnfield,
                    value,
                    defaulthtml,
                    columnproperties,
                    rowdata
                ) {

                    var buttonId = "button-" + rowdata.uid;
                    var popoverId = "popover-" + rowdata.uid;

                    let button =
                        '<button id="' +
                        buttonId +
                        '" style="padding:0" class="btn btn-table-cell" type="button" data-bs-toggle="popover"> <img src="' +
                        window.location.origin +
                        '/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/menu_dots_vertical.svg" alt="menu_dots_vertical"> </button>';

                    var popoverOptions = {
                        html: true,
                        sanitize: false,
                        placement: "left",
                        trigger: "focus",
                        container: "body",
                        content: function () {
                            return `<div id=${popoverId}>
                                          <ul class="popover-castom" style="list-style: none">
                                          <li><a class="dropdown-item" href="#">Перегляд </a></li>
                                          <li><a class="dropdown-item" href="#">Редагувати </a></li>
                                          <li><a class="dropdown-item delete-row" href="#">Видалити</a></li>
                                         </ul>
                                      </div>`;
                        },
                    };

                    $(document)
                        .off("click", "#" + buttonId)
                        .on("click", "#" + buttonId, function () {
                            $(this).popover(popoverOptions).popover("show");
                        });

                    $(document)
                        .off("click", "#" + popoverId + " .delete-row")
                        .on(
                            "click",
                            "#" + popoverId + " .delete-row",
                            function () {
                                var rowId = rowdata.uid;
                                grid.jqxGrid("deleterow", rowId);
                                $("#" + buttonId).popover("hide");
                            }
                        );

                    return (
                        '<div class="jqx-popover-wrapper">' + button + "</div>"
                    );
                },
            },
        ],
    });

    let listSource = [
        {label: `${getLocalizedText('consolidation')}`, value: "number", checked: true},
        {label: `${getLocalizedText('created')}`, value: "created", checked: true},
        {label: `${getLocalizedText('particioants')}`, value: "members", checked: true},
        {label: `${getLocalizedText('starting_point')}`, value: "starPoint", checked: true},
        {label: `${getLocalizedText('end_point')}`, value: "endPoint", checked: true},
        {label: `${getLocalizedText('pallet_space')}`, value: "address", checked: true},
        {label: "Дії", value: "action", checked: true},
    ];

    listbox(table, listSource);
    hover(table, isRowHovered);
});

