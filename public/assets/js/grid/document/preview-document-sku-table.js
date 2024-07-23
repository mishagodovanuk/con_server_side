import {pagerRenderer} from '../components/pager.js';
import {toolbarRender} from '../components/toolbar-advanced.js';
import {listbox} from '../components/listbox.js';
import {hover} from "../components/hover.js";

const pagerRendererSkuPreview = pagerRenderer.bind({});
const toolbarRendererSkuPreview = toolbarRender.bind({});

$(document).ready(function () {
    let table = $('#previewSkuDataTable')
    let isRowHovered = false;

    function getUrl() {
        let url = window.location.href;

        const documentId = url.split('/').pop();

        return window.location.origin + '/document/sku/table/filter?document_id=' + documentId;
    }


    var source = {
        datatype: 'json',
        datafields: [
            {name: 'id', type: 'number'},
            {name: "count", type: 'number'},
            {name: "name", type: 'string'},
            ...fieldData['fields']
        ],
        url: getUrl(),
        root: 'data',
        beforeprocessing: function (data) {
            source.totalrecords = data.total;
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
    let dataAdapter = new $.jqx.dataAdapter(source);

    var grid = table.jqxGrid(
        {
            theme: "light-wms",
            width: '100%',
            autoheight: true,
            pageable: true,
            pagerRenderer: function () {
                return pagerRendererSkuPreview(table);
            },
            ready() {
                checkUrl()
            },
            rendergridrows: function () {
                return dataAdapter.records;
            },
            virtualmode: true,
            autoBind: true,
            source: dataAdapter,
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
                var columns = table.jqxGrid("columns").records;
                var columnCount = columns.length;
                //console.log(columns)
                //console.log(columnCount)
                return toolbarRendererSkuPreview(
                    statusbar,
                    table,
                    true,
                    1,
                    columnCount - 1,
                ); // Subtract 1 to exclude the action column
            },

            columns: [
                {
                    width: "80px",
                    dataField: 'id',
                    align: 'left',
                    cellsalign: 'right',
                    text: "ID",
                    editable: false,
                },
                {
                    width: "250px",
                    dataField: 'name',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Назва",
                    editable: false,
                },
                {
                    width: "80px",
                    dataField: 'count',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Кількість",
                    editable: false,
                },
                ...fieldData['columns'],
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
        {label: 'ID', value: 'id', checked: true},
        {label: 'Назва', value: 'name', checked: true},
        ...fieldData['fields'],


    ];

    listbox(table, listSource);
    hover(table, isRowHovered);

});
