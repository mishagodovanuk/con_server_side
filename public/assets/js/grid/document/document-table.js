import {pagerRenderer} from '../components/pager.js';
import {toolbarRender} from '../components/toolbar-advanced.js';
import {listbox} from "../components/listbox.js";
import {hover} from "../components/hover.js";

const pagerRendererDocument = pagerRenderer.bind({});
const toolbarRendererDocument = toolbarRender.bind({});

$(document).ready(function () {
    let table = $('#documentDataTable')
    let isRowHovered = false;

    function getUrl() {
        let url = window.location.href;
        const documentId = url.split('/').pop();
        return window.location.origin + '/document/table/filter?document_id=' + documentId;
    }

    var source =
        {
            dataType: "json",
            dataFields: [
                {name: 'id', type: 'number'},
                {name: "status", type: 'string'},
                {name: "type", type: 'string'},
                ...fields,
                {name: 'created_at', type: 'string'},
                {name: 'updated_at', type: 'string'},
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
            deleteRow: async function (rowID, commit) {
                var rowData = table.jqxGrid('getrowdata', rowID);

                let formData = new FormData()
                formData.append('_method', 'DELETE')
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content)
                fetch(window.location.origin + '/table/document/' + rowData.id, {
                    method: 'POST',
                    body: formData
                }).then(() => {
                    commit(true)
                })

            },

        };

    let dataAdapter = new $.jqx.dataAdapter(source);
    //console.log(columns)
    var grid = table.jqxGrid(
        {
            theme: "light-wms",
            width: '100%',
            autoheight: true,
            pageable: true,
            pagerRenderer: function () {
                return pagerRendererDocument(table);
            },
            virtualmode: true,
            autoBind: true,
            rendergridrows: function () {
                return dataAdapter.records;
            },
            ready() {
                checkUrl()
            },
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
                var columns = table.jqxGrid('columns').records;
                var columnCount = columns.length;
                //console.log(columns)
                //console.log(columnCount)
                return toolbarRendererDocument(statusbar, table, true, 1, columnCount - 1); // Subtract 1 to exclude the action column
            },
            columns: [
                {
                    width: "50px",
                    dataField: 'id',
                    align: 'left',
                    cellsalign: 'right',
                    text: "№",
                    editable: false,
                    cellsrenderer: function (row, column, value, defaultHtml, columnSettings, rowData) {

                        let html = defaultHtml.split('>')

                        return html[0] + "><a class='link-primary fw-bold' href='" + window.location.origin + '/document/' + value + "'>" + value + "</a></div>"
                    },
                },
                {
                    width: "100px",
                    dataField: 'status',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Статус",
                    editable: false,
                },
                ...columns,
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
                                return '<div id="' + popoverId + '"><ul class="popover-castom" style="list-style: none">     <li><a class="dropdown-item" href="' + window.location.origin + "/document/" + rowdata.id + '">Перегляд документу</a></li>     <li><a class="dropdown-item" href="' + window.location.origin + "/document/" + rowdata.id + "/edit" + '">Редагувати документ</a></li> <li><a class="dropdown-item delete-row" href="#">Видалити документ</a></li></ul></div>'; // Replace with your popover content
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
        {label: '№', value: 'id', checked: true},
        {label: 'Статус', value: 'status', checked: true},
        ...listSourceArray

    ];

    listbox(table, listSource);
    hover(table, isRowHovered);
});
