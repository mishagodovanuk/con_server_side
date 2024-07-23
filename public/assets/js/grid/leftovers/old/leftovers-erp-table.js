import {pagerRenderer} from '../../components/pager.js';
import {toolbarRender} from '../../components/toolbar-advanced.js';
import {listbox} from "../../components/listbox.js";

const pagerRendererLeftovers = pagerRenderer.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});

$(document).ready(function () {
    let table = $('#leftoversERPDataTable');

    let dataFields = [
        {dataField: 'sku', type: 'string'},
        {dataField: 'leftoversERP', type: 'number'},
        {dataField: 'leftoversWMS', type: 'number'},
        {dataField: 'animal', type: 'number'},
        {dataField: 'action', type: 'string'}
    ];


    const newRecords = [];
    for (let i = 0; i < 45; i++) {
        const record = {};
        newRecords.push(record);
    }

    var myDataSource = {
        datatype: 'array',
        datafields: dataFields,
        localdata: newRecords,
    };


    var grid = table.jqxGrid(
        {
            theme: "light-wms",
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
                //console.log(columns)
                //console.log(columnCount)
                return toolbarRendererLeftovers(statusbar, table, 1, columnCount - 1); // Subtract 1 to exclude the action column
            },
            columns: [
                {
                    dataField: 'sku',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Номенклатура",
                    editable: false,
                    cellsrenderer: function () {
                        return '<a style="padding-left: 5px" class="link-primary" href="#">Snowdrops Light Grey 42x42</a>';
                    },
                    minwidth: 300,
                },
                {
                    dataField: 'leftoversERP',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Залишки ERP",
                    minwidth: 100,
                    editable: false,
                    cellsrenderer: function () {
                        return '<p class="mb-0 d-flex w-100 justify-content-end text-secondary" style="padding-right: 5px" >13.0000</p>';
                    },
                },
                {
                    minwidth: 100,
                    dataField: 'leftoversWMS',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Залишки WMS",
                    editable: false,
                    cellsrenderer: function () {
                        return '<p class="mb-0 d-flex w-100 justify-content-end text-secondary" style="padding-right: 5px" >1.0000</p>';
                    },
                },
                {
                    minwidth: 100,
                    dataField: 'animal',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Звірка",
                    editable: false,
                    cellsrenderer: function () {
                        return '<p class="mb-0 d-flex w-100 justify-content-end text-danger " style="padding-right: 5px" >-12.0000</p>';
                    },
                },
                {
                    width: '70px',
                    dataField: 'action',
                    align: 'center',
                    cellsalign: 'center',
                    text: "Дія",
                    renderer: function () {
                        return '<div style="display: flex; align-items: center; justify-content: center; height: 100%;"><img src=' + window.location.origin + '"/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/setting-button-table.svg" alt="setting-button-table"></div>';
                    },
                    filterable: false,
                    sortable: false,
                    id: "action",
                    cellClassName: "action-table-drop ",
                    className: "action-table",
                    cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
                        let button = '<button style="padding:0" class="btn btn-table-cell" type="button" data-bs-toggle="popover"> <img src=' + window.location.origin + '"/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/menu_dots_vertical.svg" alt="menu_dots_vertical"> </button>';
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
        {label: 'Номенклатура', value: 'sku', checked: true},
        {label: 'Залишки ERP', value: 'leftoversERP', checked: true},
        {label: 'Залишки WMS', value: 'leftoversWMS', checked: true},
        {label: 'Звірка', value: 'animal', checked: true},
        {label: 'Дії', value: 'action', checked: true},
    ];

    listbox(table, listSource);

});
