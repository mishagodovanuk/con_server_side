import {pagerRenderer} from '../components/pager.js';
import {toolbarRender} from '../components/toolbar-advanced.js';
import {listbox} from "../components/listbox.js";

const pagerRendererLeftovers = pagerRenderer.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});

$(document).ready(function () {
    let table = $('#leftoversDataTable2');

    let dataFields = [
        {name: 'sku', type: 'string'},
        {name: 'party', type: 'string'},
        {name: 'packaging', type: 'number'},
        {name: 'count', type: 'number'},

    ];

    var myDataSource = {
        datatype: 'array',
        datafields: dataFields,
        url: window.location.origin + '/leftovers/filter-by-package',
        root: 'data',
    };


    let dataAdapter = new $.jqx.dataAdapter(myDataSource);
    var grid = table.jqxGrid(
        {
            theme: "light-wms",
            width: '100%',
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
            rowsheight: 80,
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
                return toolbarRendererLeftovers(statusbar, table, true, 1, columnCount - 1, "-2"); // Subtract 1 to exclude the action column,

            },
            columns: [
                {
                    dataField: 'sku',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Номенклатура",
                    editable: false,
                    cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
                        return `<a style="padding-left: 5px" class="link-primary" href="#">${value}</a>`;
                    },
                    minwidth: 300,
                },
                {
                    dataField: 'party',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Партія",
                    minwidth: 100,
                    editable: false,
                    cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
                        return `<p class="mb-0 d-flex w-100 text-secondary" style="padding-left: 5px" >${value}</p>`;
                    },
                },
                {
                    minwidth: 100,
                    dataField: 'packaging',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Пакування",
                    editable: false,
                    cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
                        return `<p class="mb-0 d-flex w-100 justify-content-end text-secondary" style="padding-right: 5px" >${value}</p>`;
                    },
                },
                {
                    minwidth: 100,
                    dataField: 'count',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Кількість",
                    editable: false,
                    cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
                        return `<p class="mb-0 d-flex w-100 justify-content-start text-secondary" style="padding-right: 5px" >${value}</p>`;
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
                            trigger: "focus",
                            container: 'body',
                            content: function () {
                                return '<div id="' + popoverId + '"><ul class="popover-castom" style="list-style: none">     <li><a class="dropdown-item" href="' + window.location.origin + "/leftovers/" + rowdata.uid + '">Переглянути залишки</a></li>     <li><a class="dropdown-item" href="' + window.location.origin + "/leftovers/" + rowdata.uid + "/edit" + '">Редагувати залишки</a></li> <li><a class="dropdown-item delete-row" href="#">Видалити залишки</a></li></ul></div>'; // Replace with your popover content
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
        {label: 'Номенклатура', value: 'sku', checked: true},
        {label: 'Партія', value: 'party', checked: true},
        {label: 'Пакування', value: 'packaging', checked: true},
        {label: 'Кількість', value: 'count', checked: true},
        {label: 'Дії', value: 'action', checked: true},
    ];

    listbox(table, listSource, '-2');

});


var customData = [
    {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    },
    {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    }, {
        sku: "Snowdrops Light Grey 42x42",
        party: "С6",
        packaging: 1,
        count: 100.000,
    },]
