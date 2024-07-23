import {pagerRenderer} from "../components/pager.js";
import {toolbarRender} from "../components/toolbar-advanced.js";
import {listbox} from "../components/listbox.js";
import {hover} from "../components/hover.js";

const pagerRendererLeftovers = pagerRenderer.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});

$(document).ready(function () {
    let table = $("#sku-table");
    let isRowHovered = false;

    let dataFields = [
        {name: "name", type: "string"},
        {name: "id", type: "string"},
        {name: "company", type: "string"},
        {name: "category", type: "string"},
        {name: "manufacturer", type: "string"},
        {name: "country", type: "string"},
    ];


    var myDataSource = {
        datatype: "json",
        datafields: dataFields,
        url: window.location.origin + '/sku/table/filter',
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
    let dataAdapter = new $.jqx.dataAdapter(myDataSource);
    var grid = table.jqxGrid({
        theme: "light-wms sku-table-custom",
        width: "100%",
        autoheight: true,
        pageable: true,   
        source: dataAdapter ,
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
                minwidth: 200,
                dataField: "name",
                align: "left",
                cellsalign: "right",
                text: "Назва",
                editable: false,
                cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
                    return `<a class="text-primary ps-1 my-auto" href='${window.location.origin}/sku/${rowdata.id}' >${value}</a>`;
                },
            },
            {
                dataField: "id",
                align: "left",
                cellsalign: "right",
                text: "ID",
                width: 70,
                editable: false,
                cellsrenderer: function (row, column, value, rowdata) {
                    return `<p style="" class="text-secondary ps-1 my-auto">${value}</p>`;
                },
            },
            {
                dataField: "company",
                align: "left",
                cellsalign: "right",
                text: "Компанія",
                minwidth: 120,
                editable: false,
                cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {

                    return `<a class="ps-1 text-secondary  my-auto fw-medium-c underline-on-hover" href='${window.location.origin}/company/${rowdata.id}' >${value}</a>`;
                },
            },

            {
                width: 140,
                dataField: "category",
                align: "left",
                cellsalign: "right",
                text: "Категорія",
                editable: false,
                cellsrenderer: function (row, column, value, rowdata) {
                    return `<a class="ps-1 text-secondary my-auto" href="#" >${value}</a>`;
                },
            },
            {
                width: 160,
                dataField: "manufacturer",
                align: "left",
                cellsalign: "right",
                text: "Виробник",
                editable: false,
                cellsrenderer: function (row, column, value, rowdata) {
                    return `<a class="ps-1 text-secondary my-auto" href="#" >${value}</a>`;
                },
            },
            {
                width: 140,
                dataField: "country",
                align: "left",
                cellsalign: "right",
                text: "Країна",
                editable: false,
                cellsrenderer: function (row, column, value, rowdata) {
                    return `<a class="ps-1 text-secondary my-auto" href="#" >${value}</a>`;
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
                            return `<div id=${popoverId}>
                                      <ul class="popover-castom" style="list-style: none">
                                      <li><a class="dropdown-item" href="${window.location.origin}/sku/${rowdata.id}">Перегляд товару</a></li>
                                      <li><a class="dropdown-item" href="${window.location.origin}/sku/${rowdata.id}/edit">Редагувати товар</a></li>
                                      <li><a class="dropdown-item delete-row" href="#">Видалити товар</a></li>
                                     </ul>
                                  </div>`;
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
        {label: "ID", value: "id", checked: true},
        {label: "Компанія", value: "company", checked: true},
        {label: "Категорія", value: "category", checked: true},
        {label: "Виробник", value: "manufacturer", checked: true},
        {label: "Країна", value: "country", checked: true},
        {label: "Дії", value: "action", checked: true},
    ];

    listbox(table, listSource);
    hover(table, isRowHovered);
});



