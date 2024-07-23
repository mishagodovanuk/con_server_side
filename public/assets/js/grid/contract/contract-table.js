import {pagerRenderer} from "../components/pager.js";
import {toolbarRender} from "../components/toolbar-advanced.js";
import {listbox} from "../components/listbox.js";
import {hover} from "../components/hover.js";

const pagerRendererLeftovers = pagerRenderer.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});

$(document).ready(function () {
    let table = $("#contract-table");
    let isRowHovered = false;

    let dataFields = [
        {name: "number", type: "string"},
        {name: "inputOutput", type: "string"},
        {name: "yourCompany", type: "string"},
        {name: "yourCompanyId", type: "string"},
        {name: "contractor", type: "string"},
        {name: "contractorId", type: "string"},
        {name: "type", type: "string"},
        {name: "status", type: "string"},
        {name: "id", type: "string"},
    ];

    var myDataSource = {
        datatype: "json",
        datafields: dataFields,
        url: window.location.origin + '/contracts/table/filter',
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
        theme: "light-wms contract-table-custom",
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
                dataField: "number",
                align: "left",
                cellsalign: "right",
                text: "№ договору",
                editable: false,
                cellsrenderer: function (row,
                                         columnfield,
                                         value,
                                         defaulthtml,
                                         columnproperties,
                                         rowdata) {
                    return `<a class=" ps-1 d-flex my-auto fw-bold" href='${window.location.origin}/contracts/${value}'>${value}</p>`;
                },
                width: 150
            },
            {
                dataField: "inputOutput",
                align: "left",
                cellsalign: "right",
                text: "Вхідний/вихідний",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `
                          <div class="d-flex align-items-center">
                            <p style="width: 100px" class="text-secondary ps-1 my-auto">${value}</p>
                            <img class="text-${value === "Вихідний" ? 'success' : 'danger'}"
                                 src="${window.location.origin}/assets/icons/entity/contract/arrow-${value === 'Вихідний' ? 'right' : 'left'}.svg"
                                 alt="triangle">
                          </div>`;
                },
                width: 170
            },
            {
                dataField: "yourCompany",
                align: "left",
                cellsalign: "right",
                text: "Ваша компанія",
                minwidth: 150,
                editable: false,
                cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
                    return ` <a class= "ps-1 text-secondary  my-auto fw-medium-c underline-on-hover text-truncate"
                    href = '${window.location.origin}/company/${rowdata.yourCompanyId}' >${value} </a>`;
                },
            },
            {
                minwidth: 150,
                dataField: "contractor",
                align: "left",
                cellsalign: "right",
                text: "Контрагент",
                editable: false,
                cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
                    return `<a class="ps-1 text-secondary  my-auto fw-medium-c underline-on-hover text-truncate" href='${window.location.origin}/company/${rowdata.contractorId}' >${value}</a>`;
                },
            },
            {
                minwidth: 300,
                dataField: "type",
                align: "left",
                cellsalign: "right",
                text: "Тип договору",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="text-secondary  ps-1  my-auto"  >${value}</p>`;
                },
            },
            {
                width: 230,
                dataField: "status",
                align: "left",
                cellsalign: "right",
                text: "Статус ",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    console.log(value)
                    return `<div class="ps-1"> <div class="fw-bolder alert alert-${
                        value === "Створено" ? "secondary" :
                            value === "Відхилено" ? "danger" :
                                value === "Відхилено контрагентом" ? "danger" :
                                    value === "Підписано всіма" ? "success" :
                                        value === "Розірвано" ? "secondary" : "primary"
                    }" style="padding : 2px 10px !important;"
                    > ${value} </div> </div>`
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
                cellClassName: "action-table-drop",
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
                                          <li><a class="dropdown-item" href="${window.location.origin}/contracts/${rowdata.id}">Переглянути договір</a></li>
                                          <li><a class="dropdown-item delete-row" href="#">Видалити договір</a></li>
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
                                fetch(window.location.origin + `/contracts/${rowdata.id}`, {
                                    method: 'delete',
                                    headers: {
                                        "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').content
                                    },
                                }).then(async function (res) {
                                    if (res.status === 200) {
                                        var rowId = rowdata.uid;
                                        grid.jqxGrid("deleterow", rowId);
                                        $("#" + buttonId).popover("hide");
                                    } else {
                                        console.log((await res.json()).message)
                                    }
                                });
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
        {label: "№ договору", value: "number", checked: true},
        {label: "Вхідний/вихідний", value: "inputOutput", checked: true},
        {label: "Ваша компанія", value: "yourCompany", checked: true},
        {label: "Контрагент", value: "contractor", checked: true},
        {label: "Тип договору", value: "type", checked: true},
        {label: "Статус", value: "status", checked: true},
        {label: "Дії", value: "action", checked: true},
    ];

    listbox(table, listSource);
    hover(table, isRowHovered);
});
