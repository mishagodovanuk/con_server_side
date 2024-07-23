import {pagerRenderer} from "../components/pager.js";
import {toolbarRender} from "../components/toolbar-advanced.js";
import {listbox} from "../components/listbox.js";
import {hover} from "../components/hover.js";

const pagerRendererLeftovers = pagerRenderer.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});

$(document).ready(function () {
    let table = $("#additional-equipment-table");
    let isRowHovered = false;

    let dataFields = [
        {name: "id", type: "number"},
        {name: "model", type: "string"},
        {name: "dnz", type: "string"},
        {name: "typeLoad", type: "string"},
        {name: "company", type: "string"},
        {name: "car", type: "string"},
        // { dataField: "action", type: "string" },
    ];


    var myDataSource = {
        datatype: "json",
        datafields: dataFields,
        url: window.location.origin + '/transport-equipment/table/filter',
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
        theme: "light-wms additional-equipment-custom",
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
                dataField: "model",
                align: "left",
                cellsalign: "right",
                text: "Модель та марка",
                width: 250,
                editable: false,
                cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {

                    return `<a  class="text-primary ps-1 my-auto" href='${window.location.origin}/transport-equipment/${rowdata.id}'>${value}</a>`;
                },
            },
            {
                dataField: "dnz",
                align: "left",
                cellsalign: "right",
                text: "ДНЗ",
                width: 180,
                editable: false,
                cellsrenderer: function (row, column, value, rowdata) {
                    return `<p class=" text-secondary ps-1 my-auto">${value}</p>`;
                },
            },
            {
                minwidth: 90,
                dataField: "typeLoad",
                align: "left",
                cellsalign: "right",
                text: "Спосіб завантаження",
                editable: false,
                cellsrenderer: function (row, column, value, rowdata) {
                    return `<p class=" text-secondary ps-1 my-auto">${value}</p>`;
                },
            },
            {
                minwidth: 90,
                dataField: "company",
                align: "left",
                cellsalign: "right",
                text: "Компанія",
                editable: false,
                cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {

                    return `<a class="ps-1 text-secondary  my-auto fw-medium-c underline-on-hover" href='${window.location.origin}/company/${rowdata.id}' >${value}</a>`;
                },
            },
            {
                width: 220,
                dataField: "car",
                align: "left",
                cellsalign: "right",
                text: "Авто",
                editable: false,
                cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {

                    return `<a class="ps-1 text-secondary  my-auto underline-on-hover" href='${window.location.origin}/transport/${1}' >${value}</a>`;
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
                                      <li><a class="dropdown-item" href="${window.location.origin}/transport-equipment/${rowdata.id}">Перегляд обладнання</a></li>
                                      <li><a class="dropdown-item" href="${window.location.origin}/transport-equipment/${rowdata.id}/edit">Редагувати обладнання</a></li>
                                      <li><a class="dropdown-item delete-row" href="#">Видалити обладнання</a></li>
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
        {label: "Модель та марка", value: "model", checked: true},
        {label: "ДНЗ", value: "dnz", checked: true},
        {label: "Спосіб завантаження", value: "typeLoad", checked: true},
        {label: "Компанія", value: "company", checked: true},
        {label: "Авто", value: "car", checked: true},
        {label: "Дії", value: "action", checked: true},
    ];

    listbox(table, listSource);
    hover(table, isRowHovered);
});
