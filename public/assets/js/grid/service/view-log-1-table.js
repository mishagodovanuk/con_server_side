import {pagerRenderer} from '../components/pager.js';
import {toolbarRender} from '../components/toolbar-advanced.js';
import {listbox} from "../components/listbox.js";
import {customData} from './dataLogs.js'

const pagerRendererLeftovers = pagerRenderer.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});

$(document).ready(function () {
    let table = $('#view-log-1-table');

    let dataFields = [
        {name: 'stock', type: 'string'},
        {name: 'type', type: 'string'},
        {name: 'sector', type: 'string'},
        {name: 'row', type: 'string'},
        {name: 'cell', type: 'string'},
        {name: 'codePallet', type: 'string'},
        {name: 'leftover', type: 'string'},
    ];



    var myDataSource = {
        datatype: 'array',
        datafields: dataFields,
        localdata: customData,
    };


    var grid = table.jqxGrid(
        {
            theme: "light-wms view-services-table-custom",
            width: '100%',
            autoheight: true,
            pageable: true,
            source: new $.jqx.dataAdapter(myDataSource),
            pagerRenderer: function () {
                return pagerRendererLeftovers(table);
            },
            ready() {
                checkUrl()
            },
            sortable: true,
            columnsResize: false,
            filterable: true,
            filtermode: 'default',
            localization: getLocalization('uk'),
            selectionMode: 'checkbox',
            enablehover: false,
            columnsreorder: true,
            autoshowfiltericon: true,
            pagermode: 'advanced',
            rowsheight: 35,
            filterbarmode: 'simple',
            toolbarHeight: 45,
            showToolbar: true,
            filter: function () {
                var columnindex = table.jqxGrid('getcolumnindex', 'Action');

                var filterinfo = table.jqxGrid('getfilterinformation')[columnindex];

                // Disable filtering for the "Name" column
                if (filterinfo != null && filterinfo.filter != null) {
                    filterinfo.filter.setlogic('and');
                    filterinfo.filter.setoperator(0);
                    filterinfo.filter.setvalue('');
                }
            },
            rendertoolbar: function (statusbar) {
                var columns = table.jqxGrid('columns').records;
                var columnCount = columns.length;

                return toolbarRendererLeftovers(statusbar, table, true, 1, columnCount - 1); // Subtract 1 to exclude the action column
            },
            columns: [
                {
                    dataField: 'stock',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Склад",
                    editable: false,
                    cellsrenderer: function (row, column, value, rowData) {
                        return `<a href="#" class="mb-0 d-flex   ps-1  " style="" >${value}</a>`;
                    },
                    width: '15%',
                },
                {
                    dataField: 'type',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Тип",
                    width: '12%',
                    editable: false,
                    cellsrenderer: function (row, column, value, rowData) {
                        return `<p class=" text-secondary ps-1  my-auto" style="" >${value}</p>`;
                    },
                },
                {
                    width: "9%",
                    dataField: 'sector',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Сектор",
                    editable: false,
                    cellsrenderer: function (row, column, value, rowData) {
                        return `<a href="#" class="mb-0 d-flex   ps-1  " style="" >${value}</a>`;
                    },
                },
                {
                    width: '9%',
                    dataField: 'row',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Ряд",
                    editable: false,
                    cellsrenderer: function (row, column, value, rowData) {
                        return `<p class="text-secondary  ps-1  my-auto" style="" >${value}</p>`;
                    },
                },
                {
                    width: "17%",
                    dataField: 'cell',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Комірка",
                    editable: false,
                    cellsrenderer: function (row, column, value, rowData) {
                        return `<p class="text-secondary  ps-1  my-auto" style="" >${value}</p>`;
                    },
                },
                {
                    width: "17%",
                    dataField: 'codePallet',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Код палети",
                    editable: false,
                    cellsrenderer: function (row, column, value, rowData) {
                        return `<p class="text-secondary  ps-1  my-auto" style="" >${value}</p>`;
                    },
                },
                {
                    width: "14%",
                    dataField: 'leftover',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Залишки",
                    editable: false,
                    cellsrenderer: function (row, column, value, rowData) {
                        return `<p class="text-secondary  ps-1  my-auto" style="" >${value}</p>`;
                    },
                },
                {
                    width: '4%',
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
                        let button = '<button style="padding:0" class="btn btn-table-cell" type="button" data-bs-toggle="popover"> <img src="' + window.location.origin + '/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/menu_dots_vertical.svg" alt="menu_dots_vertical"> </button>';
                        $(document).on('click', '[data-bs-toggle="popover"]', function () {
                            $(this).popover({
                                html: true,
                                sanitize: false,
                                content: function () {
                                    return '<div><ul class="popover-castom" style="list-style: none">     <li><a class="dropdown-item delete-row" href="#">Видалити документ</a></li></ul></div>'; // Replace with your popover content
                                },
                                placement: 'left',
                                trigger: 'focus',

                            }).popover('show');
                        });
                        $(document).on('click', '.delete-row', function () {
                            var rowId = rowdata.uid;
                            grid.jqxGrid('deleterow', rowId);
                        });
                        return '<div class="jqx-popover-wrapper">' + button + '</div>';
                    }


                },
            ],
        });

    let listSource = [
        {label: 'Склад', value: 'stock', checked: true},
        {label: 'Тип', value: 'type', checked: true},
        {label: 'Сектор', value: 'sector', checked: true},
        {label: 'Ряд', value: 'row', checked: true},
        {label: 'Комірка', value: 'cell', checked: true},
        {label: 'Код палети', value: 'codePallet', checked: true},
        {label: 'Залишки', value: 'leftover', checked: true},
    ];

    listbox(table, listSource);

});


