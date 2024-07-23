import {pagerRenderer} from "../components/pager.js";
import {toolbarRender} from "../components/toolbar-advanced.js";
import {listbox} from "../components/listbox.js";
import {hover} from "../components/hover.js";

const pagerRendererLeftovers = pagerRenderer.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});

$(document).ready(function () {
    let table = $("#companies-table");
    let isRowHovered = false;

// Function to apply the lookup filter and capture filtered data

    let dataFields = [
        {name: "name", type: "string"},
        {name: "property", type: "string"},
        {name: "type", type: "string"},
        {name: "edrpou", type: "string"},
        {name: "ipn", type: "string"},
        {name: "address", type: "string"},
        {name: "id", type: "string"},
    ];

    var myDataSource = {
        datatype: "json",
        datafields: dataFields,
        url: window.location.origin + '/company/table/filter',
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
                columnCount - 1
            ); // Subtract 1 to exclude the action column
        },
        columns: [
            {
                dataField: "name",
                align: "left",
                cellsalign: "right",
                text: "Назва",
                editable: false,
                cellsrenderer: function (row,
                                         columnfield,
                                         value,
                                         defaulthtml,
                                         columnproperties,
                                         rowdata) {
                    return `<a style="" class=" ps-1 d-flex my-auto " href='${
                        window.location.origin
                    }/company/${rowdata.id}'  >${value}</a>`;
                },
                minwidth: 170
            },
            {
                dataField: "property",
                align: "left",
                cellsalign: "right",
                text: "Власність",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p style="" class="text-secondary ps-1  my-auto" >${value || '-'}</p>`;
                },
                width: 130,
                filterable: false
            },
            {
                dataField: "type",
                align: "left",
                cellsalign: "right",
                text: "Тип",
                minwidth: 100,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class=" text-secondary ps-1  my-auto" style="" >${value || '-'}</p>`;
                },
            },
            {
                width: 120,
                dataField: "edrpou",
                align: "left",
                cellsalign: "right",
                text: "ЄДРПОУ",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class=" text-secondary ps-1 my-auto " style="" >${value || '-'}</p>`;
                },
            },
            {
                width: 120,
                dataField: "ipn",
                align: "left",
                cellsalign: "right",
                text: "ІПН",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class=" text-secondary ps-1 my-auto " style="" >${value || '-'}</p>`;
                },
            },
            {
                minwidth: 100,
                dataField: "address",
                align: "left",
                cellsalign: "right",
                text: "Адреса",
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
                                          <li><a class="dropdown-item" href="${window.location.origin}/company/${rowdata.id}">Перегляд компанії</a></li>
                                          <li><a class="dropdown-item" href="${window.location.origin}/company/${rowdata.id}/edit">Редагувати компанію</a></li>
                                          <li><a class="dropdown-item delete-row" href="#">Видалити компанію</a></li>
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
        {label: "Назва", value: "name", checked: true},
        {label: "Власність", value: "property", checked: true},
        {label: "Тип", value: "type", checked: true},
        {label: "ЄДРПОУ", value: "edrpou", checked: true},
        {label: "ІПН", value: "ipn", checked: true},
        {label: "Адреса", value: "address", checked: true},
        {label: "Дії", value: "action", checked: true},
    ];

    listbox(table, listSource);
    hover(table, isRowHovered);
});
