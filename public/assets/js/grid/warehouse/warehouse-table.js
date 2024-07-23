import {pagerRenderer} from "../components/pager.js";
import {toolbarRender} from "../components/toolbar-advanced.js";
import {listbox} from "../components/listbox.js";
import {hover} from "../components/hover.js";

const pagerRendererLeftovers = pagerRenderer.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});

$(document).ready(function () {
    let table = $("#warehouse-table");
    let isRowHovered = false;

    let dataFields = [
        {name: 'id', type: 'number'},
        {name: "name", type: "string"},
        {name: "company", type: "string"},
        {name: 'company_id', type: 'number'},
        {name: 'user_id', type: 'number'},
        {name: "type", type: "string"},
        {name: "location", type: "string"},
        {name: "contact", type: "string"},
    ];

    var myDataSource = {
        datatype: "json",
        datafields: dataFields,
        url: window.location.origin + '/warehouse/table/filter',
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
        theme: "light-wms warehouse-table-custom",
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
                minwidth: 120,
                editable: false,
                cellsrenderer: function (row, column, value, defaultHtml, columnSettings, rowData) {
                    return `<a href="${'warehouse/' + rowData.id}"  style="color: #D9B414;" class="ps-1 fw-bold my-auto">${value}</a>`;
                },
            },
            {
                dataField: "company",
                align: "left",
                cellsalign: "right",
                text: "Компанія",
                width: 160,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<a class="ps-1 my-auto fw-bold" href="${'company/' + (row + 1)}" style="color: #4B465C;">${value}</a>`;
                },
            },
            {
                width: 140,
                dataField: "type",
                align: "left",
                cellsalign: "right",
                text: "Тип",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class=" text-secondary ps-1 my-auto">${value}</p>`;
                },
            },
            {
                minwidth: 300,
                dataField: "location",
                align: "left",
                cellsalign: "right",
                text: "Адреса",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="ps-1 text-secondary my-auto" href="#" >${value}</p>`;
                },
            },
            {
                width: 180,
                dataField: "contact",
                align: "left",
                cellsalign: "right",
                text: "Контактна особа",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<a class="ps-1 my-auto fw-bold" href='${'user/show/' + (row + 1)}' style="color: #4B465C;">${value}</a>`;
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
                    var buttonId = 'button-' + rowdata.uid;
                    var popoverId = 'popover-' + rowdata.uid;

                    let button = '<button id="' + buttonId + '" style="padding:0" class="btn btn-table-cell" type="button" data-bs-toggle="popover"> <img src="' + window.location.origin + '/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/menu_dots_vertical.svg" alt="menu_dots_vertical"> </button>';

                    var popoverOptions = {
                        html: true,
                        sanitize: false,
                        placement: 'left',
                        trigger: 'focus',
                        container: 'body',
                        content: function () {
                            return '<div id="' + popoverId + '"><ul class="popover-castom" style="list-style: none">     ' +
                                '<li><a class="dropdown-item" href="' + window.location.origin + '/warehouse/' + (rowdata.uid + 1) + '">Перегляд складу</a></li>    ' +
                                ' <li><a class="dropdown-item" href="' + window.location.origin + '/warehouse/' + (rowdata.uid + 1) + '/edit' + '">Редагувати профіль <br> складу</a></li>    ' +
                                ' <li><a class="dropdown-item" href="' + window.location.origin + '/user/update/' + (rowdata.uid + 1) + '">Редагувати розклад <br> роботи складу</a></li>    ' +
                                '<li><a class="dropdown-item text-danger" href="#">Деактивувати склад</a></li></ul></div>'; // Replace with your popover content
                        }

                    };

                    $(document).off('click', '#' + buttonId).on('click', '#' + buttonId, function () {
                        $(this).popover(popoverOptions).popover('show');
                    });

                    $(document).off('click', '#' + popoverId + ' .delete-row').on('click', '#' + popoverId + ' .delete-row', function () {
                        var rowId = rowdata.uid;
                        grid.jqxGrid('deleterow', rowId);
                        $('#' + buttonId).popover('hide');
                    });

                    return '<div class="jqx-popover-wrapper">' + button + '</div>';
                }

            },
        ],
    });

    let listSource = [
        {label: "Назва", value: "name", checked: true},
        {label: "Компанія", value: "company", checked: true},
        {label: "Тип", value: "type", checked: true},
        {label: "Адреса", value: "location", checked: true},
        {label: "Контактна особа", value: "contact", checked: true},
        {label: "Дії", value: "action", checked: true},
    ];

    listbox(table, listSource);
    hover(table, isRowHovered);
});


