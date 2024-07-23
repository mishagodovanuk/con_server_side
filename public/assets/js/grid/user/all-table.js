import {pagerRenderer} from '../components/pager.js';
import {toolbarRender} from '../components/toolbar-advanced.js';
import {listbox} from '../components/listbox.js';
import {hover} from "../components/hover.js";

const pagerRendererUser = pagerRenderer.bind({});
const toolbarRendererUser = toolbarRender.bind({});
$(document).ready(function () {

    let table = $("#usersDataTable");
    let isRowHovered = false;

    function fullnameRender(row, column, value, defaultHtml, columnSettings, rowData) {
        let html = defaultHtml.split('><');
        //console.log(rowData.patronymic)
        let wrappedContent = html[0] + " id='full_name-" + row + "'>" + rowData.surname + ' ' + rowData.name + ' ' + rowData.patronymic + '<' + html[1];
        return "<a class='fw-bold' href='" + window.location.origin + "/user/show/" + rowData.id + "'>" + wrappedContent + "</a>";
    }


    function isOnlineRender(row, column, value, defaulthtml, columnproperties) {
        let data = table.jqxGrid('getrowdatabyid', row);

        function calculateStatus() {
            if (data && data.is_online === true) {
                return "<p class='badge badge-light-success' style='margin-left:4px; margin-top: 8px'> В мережі</p>";
            } else {
                return "<p class='badge badge-light-danger' style='margin-left:4px; margin-top: 8px'> Офлайн</p>";
            }
        }

        table.on('pagechanged', function () {
            // Calculate the status when the page is changed
            value = calculateStatus();
            table.jqxGrid('refresh');
        });

        return calculateStatus();
    }


    var source =
        {
            dataType: "json",
            dataFields: [
                {name: 'id', type: 'number'},
                {name: "name", type: 'string'},
                {name: "surname", type: 'string'},
                {name: "patronymic", type: 'string'},
                {name: 'company', type: 'string'},
                {name: 'position', type: 'string'},
                {name: 'role', type: 'string'},
                {name: 'birthday', type: 'date'},
                {name: 'phone', type: 'string'},
                {name: 'email', type: 'string'},
                {name: 'created_at', type: 'date'},
                {name: 'updated_at', type: 'date'},
                {name: 'last_seen', type: 'date'},
                {name: 'is_online', type: 'string'},

            ],
            url: window.location.origin + '/user/filter',
            root: 'data',
            beforeprocessing: function (data) {
                source.totalrecords = data.total;
            },
            filter: function () {
                // update the grid and send a request to the server.
                table.jqxGrid('updatebounddata', 'filter');
            },
            sort: function () {
                $('.search-btn')[0].click()
            },
            delete: function (data) {
                $.ajax({
                    url: '/user/delete/' + data.id,
                    type: 'POST',
                    data: {
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        _method: 'DELETE',
                    },
                    success: function () {
                        $('#usersDataTable').jqxGrid('updatebounddata')
                    }
                })
            }
        };

    let dataAdapter = new $.jqx.dataAdapter(source);

    table.jqxGrid(
        {

            theme: "light-wms",
            width: '100%',
            autoheight: true,
            pageable: true,
            // використання pagerRenderer для створення кастомної пагінації
            pagerRenderer: function () {
                return pagerRendererUser(table);
            },
            virtualmode: true,
            rendergridrows: function () {
                return dataAdapter.records;
            },
            ready() {
                checkUrl()
            },
            source: dataAdapter,
            sortable: true,
            columnsResize: false,
            editable: false,
            filterable: true,
            filtermode: 'default',
            localization: getLocalization('uk'),
            selectionMode: 'checkbox',
            columnsreorder: true,
            autoshowfiltericon: true,
            pagermode: 'simple',
            rowsheight: 35,
            filterbarmode: 'simple',
            showToolbar: true,
            toolbarHeight: 45,
            rendertoolbar: function (statusbar) {
                var columns = table.jqxGrid("columns").records;
                var columnCount = columns.length;
                //console.log(columns)
                //console.log(columnCount)
                return toolbarRendererUser(
                    statusbar,
                    table,
                    true,
                    1,
                    columnCount - 1,
                ); // Subtract 1 to exclude the action column
            },
            columns: [
                {
                    minwidth: 250,
                    dataField: "full_name",
                    align: 'left',
                    cellsalign: 'left',
                    text: "Ініціали",
                    cellsrenderer: fullnameRender,

                },
                {
                    dataField: 'position',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Посада",
                    width: 200

                },
                {
                    dataField: 'role',
                    align: 'center',
                    cellsAlign: 'center',
                    text: "Роль",
                    hidden: true,
                    minwidth: 300,
                },
                {
                    dataField: 'phone',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Номер телефону",
                    minwidth: 200

                },
                {
                    dataField: 'company',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Компанія",
                    minwidth: 200

                },
                {
                    dataField: 'email',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Емейл",
                    width: 300
                },
                {
                    dataField: 'is_online',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Статус",
                    cellsrenderer: isOnlineRender,
                    filterable: false,
                    width: 200
                },
                {
                    dataField: 'birthday',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Дата народження",
                    hidden: true,
                    minwidth: 100,
                },
                {
                    dataField: 'last_seen',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Останній вхід",
                    cellsformat: 'yyyy-M-d',
                    hidden: true,
                    minwidth: 100,
                },
                {
                    dataField: 'updated_at',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Відредаговано",
                    cellsformat: 'yyyy-M-d',
                    hidden: true,
                    minwidth: 100,
                },
                {
                    dataField: 'created_at',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Створено",
                    cellsformat: 'yyyy-M-d',
                    hidden: true,
                    minwidth: 100,
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
                        let id = rowdata.id


                        let button = '<button id="' + buttonId + '" style="padding:0" class="btn btn-table-cell" type="button" data-bs-toggle="popover"> <img src="' + window.location.origin + '/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/menu_dots_vertical.svg" alt="menu_dots_vertical"> </button>';

                        var popoverOptions = {
                            html: true,
                            sanitize: false,
                            placement: 'left',
                            trigger: 'focus',
                            container: 'body',
                            content: function () {
                                return '<div id="' + popoverId + '"><ul class="popover-castom" style="list-style: none">     ' +
                                    '<li><a class="dropdown-item" href="' + window.location.origin + '/user/show/' + rowdata.id + '">Перегляд користувача</a></li>    ' +
                                    ' <li><a class="dropdown-item" href="' + window.location.origin + '/user/update/' + rowdata.id + '">Редагувати профіль <br> користувача</a></li>    ' +
                                    '<li><button class="dropdown-item ps-1 text-danger user-delete" onclick="deleteUser(' + id + ')">Деактивувати користувача</button></li></ul></div>'; // Replace with your popover content
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

    var listSource = [
        {label: "Ініціали", value: 'full_name', checked: true},
        {label: 'Посада', value: 'position', checked: true},
        {label: 'Компанія', value: 'company', checked: true},
        {label: 'Пошта', value: 'email', checked: true},
        {label: 'Телефон', value: 'phone', checked: true},
        {label: 'Онлайн', value: 'is_online', checked: true},
        {label: 'Дата народження', value: 'birthday', checked: false},
        {label: 'Роль', value: 'role', checked: false},
        {label: 'Створено', value: 'created_at', checked: false},
        {label: 'Відредаговано', value: 'updated_at', checked: false},
        {label: 'Останній вхід', value: 'last_seen', checked: false},
        {label: 'Дії', value: 'action', checked: true},
    ];

    listbox(table, listSource);

    hover(table, isRowHovered);

//End script
})
