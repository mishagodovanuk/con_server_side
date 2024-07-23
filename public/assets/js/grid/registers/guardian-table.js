import {pagerRenderer} from '../components/pager.js';
import {toolbarRender} from '../components/toolbar-advanced.js';
import {listbox} from '../components/listbox.js';

const pagerRendererGuard = pagerRenderer.bind({});
const toolbarRendererGuard = toolbarRender.bind({});
$(document).ready(function () {
    $(document).on('focus', '#textboxeditorguardRegisterDataTablelicence_plate', function () {
        $(this).attr('oninput', 'validateUkrainianDNZ(this, 8)');
    });

    var editableRows = [];
    var isEditing = false;
    let table = $('#guardRegisterDataTable');
    let isRowHovered = false;

    window.Echo.channel('registers').listen("RegistersChangedStatus", (event) => {
        var register = event.register
        console.log(register)
        $('.loader')[0].style.display = 'none'
        if (register.status_id == 1) {
            var audio = new Audio('https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/success.mp3');
            audio.play();
            refreshTable(table)
        } else if (register.status_id === 3) {
            showApproveMessage(register.id, register.auto_name, register.licence_plate)
            refreshTable(table)
        } else {
            refreshTable(table)
        }
    });

    $('#warehouse-select').change(function (e) {
        let warehouses = $('#warehouse-select').val();

        let warehousesArr = '';

        if (warehouses.length) {
            warehousesArr += '?';
        }

        warehouses.forEach((item, index) => {
            if (index + 1 === warehouses.length) {
                warehousesArr += `warehouses_ids[]=${item}`;
            } else {
                warehousesArr += `warehouses_ids[]=${item}&`;
            }
        });

        //change url in data source
        let newSource = table.jqxGrid('source');
        newSource._source.url = window.location.origin + `/register/filter${warehousesArr}`;
        table.jqxGrid('source', newSource);
    });

    function refreshTable(table) {
        if (isEditing) {
            table.one("cellendedit", $.proxy(table.jqxGrid(), this, "updatebounddata"))
        } else {
            table.jqxGrid("updatebounddata");
        }
    }

    function paletRender(row, column, value, defaultHtml, columnSettings, rowData) {
        return '<div style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '"><div class="palletCellStorekeeper">' + rowData.mono_pallet + '/' + rowData.collect_pallet + '</div></div>';
    }

    function showApproveMessage(id, name, number) {
        $('#row-id').text(id); // Clear and set new content
        $('#car-name').text(name);
        $('#car-number').text(number ?? 'Не вказано');
        $('.toast').removeClass('hide').addClass('show');
        $('#goto').attr('onclick', 'goToClick(' + id + ')');
    }


    function setColor(row, columnfield, value, data) {
        switch (data.status_key) {
            case 'register':
                return 'registered-status mt-0 d-flex align-items-center';
            case 'apply':
                return 'applied-status mt-0 d-flex align-items-center';
            case 'launch':
                return 'launched-status mt-0 d-flex align-items-center';
            default:
                return 'mt-0 d-flex align-items-center';
        }
    }

    var registrationRender = function (row, column, value, defaultHtml, columnSettings, rowData) {
        if (rowData.register == null) {
            let html = defaultHtml.split('><')
            editableRows.push(row)
            return html[0] + ">" + "<button class='btn btn-outline-primary register-btn p-0' style='padding: 7px 10px!important;' onclick='registerClick(" + rowData.id + ")'>Зареєструвати</button>" + '<' + html[1]
        }
        // Розділити час на години і хвилини
        const timeParts = value.split(' ');
        const time = timeParts[0]; // Отримати час частини

        // Отримати дату частини
        const date = timeParts[1];

        // Зробити час жирним
        const boldTime = '<div class="fw-bold">' + time + '</div>';

        // Повернути оновлене відображення
        return '<div class=" gap-1 h-100" style="flex:1;padding-left:5px;overflow:hidden; text-overflow:ellipsis;vert-align: middle; display: flex; align-items: center;" id="cell_' + row + '_' + column + '">' + boldTime + date + '</div>';
    }

    function guardianEntranceRender(row, column, value, defaultHtml, columnSettings, rowData) {
        if (rowData.status_key == 'apply') {
            editableRows.push(row);
            let innerHTML = "<button class='btn btn-primary start-btn p-0' style='padding: 7px 10px!important;' onclick='guardianEntranceClick(" + rowData.id + ")'>Запустити</button>";
            return '<div class=" h-100" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between\" >' + innerHTML + '</div>';

        } else if (rowData.entrance == null) {
            defaultHtml = 'Невизначено';
            return '<div class=" h-100" style="flex:1;padding-left:5px;overflow:hidden; text-overflow:ellipsis;vert-align: middle; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + defaultHtml + '</div>';
        }

        // Розділити час на години і хвилини
        const timeParts = value.split(' ');
        const time = timeParts[0]; // Отримати час частини

        // Отримати дату частини
        const date = timeParts[1];

        // Зробити час жирним
        const boldTime = '<div class="fw-bold">' + time + '</div>';

        return '<div class="gap-1 h-100" style="flex:1;padding-left:5px;overflow:hidden; text-overflow:ellipsis;vert-align: middle; display: flex; align-items: center;" id="cell_' + row + '_' + column + '">' + boldTime + date + '</div>';
    }


    function guardianDepartureRender(row, column, value, defaultHtml, columnSettings, rowData) {
        if (rowData.entrance != null && rowData.departure == null) {
            let html = defaultHtml.split('><')
            editableRows.push(row)
            let innerHTML = "<button class='btn btn-primary start-btn p-0'  style='padding: 7px 10px!important;'  onclick='releaseClick(" + rowData.id + ")'>Випустити</button>"
            return html[0] + '><div style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between\" >' + innerHTML + '</div><' + html[1]
        } else if (rowData.departure == null) {
            defaultHtml = 'Невизначено'
            return '<div class=" h-100" style="flex:1;padding-left:5px;overflow:hidden; text-overflow:ellipsis;vert-align: middle; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + defaultHtml + '</div>';

        }

        // Розділити час на години і хвилини
        const timeParts = value.split(' ');
        const time = timeParts[0]; // Отримати час частини

        // Отримати дату частини
        const date = timeParts[1];

        // Зробити час жирним
        const boldTime = '<div class="fw-bold">' + time + '</div>';
        defaultHtml = boldTime + date;
        return '<div class="gap-1 h-100" style="flex:1;padding-left:5px;overflow:hidden; text-overflow:ellipsis;vert-align: middle; display: flex; align-items: center;" id="cell_' + row + '_' + column + '">' + defaultHtml + '</div>';
    }

    var cellbeginedit = function (row, datafield, columntype, value) {
        if (!editableRows.includes(row)) {
            return false;
        }
        isEditing = true
    }

    function isUndefinedRender(row, column, value) {
        if (value == null || value == "") {
            return 'Невизначено'
        }
    }

    var cellendedit = function (event) {
        isEditing = false
    }

    var source =
        {
            dataType: "json",
            dataFields: [
                {name: 'id', type: 'number'},
                {name: "time_arrival", type: 'string'},
                {name: "auto_name", type: 'string'},
                {name: 'licence_plate', type: 'string'},
                {name: 'mono_pallet', type: 'number'},
                {name: 'collect_pallet', type: 'number'},
                {name: 'download_method', type: 'string'},
                {name: 'download_zone', type: 'string'},
                {name: 'storekeeper', type: 'string'},
                {name: 'status', type: 'string'},
                {name: 'status_key', type: 'string'},
                {name: 'register', type: 'string'},
                {name: 'entrance', type: 'string'},
                {name: 'departure', type: 'string'},
            ],
            url: window.location.origin + '/register/filter',
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
            beforeLoadComplete: function () {
                editableRows = []
            },
            updaterow: function (rowid, newdata, commit) {
                let formData = new FormData()
                formData.append('_method', 'PUT')
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content)
                for (var key in newdata) {
                    formData.append(key, newdata[key]);
                }
                fetch(window.location.origin + '/register/' + newdata.id, {
                    method: 'POST',
                    body: formData
                }).then((res) => {
                    if (res.status === 200) {
                        commit(true)
                    } else {
                        alert('Something wrong, please reload page')
                    }
                })
            }
        };


    let dataAdapter = new $.jqx.dataAdapter(source);

    var grid = table.jqxGrid(
        {
            theme: "light-wms",
            width: '100%',
            autoheight: true,
            pageable: true,
            pagerRenderer: function () {
                return new pagerRendererGuard(table);
            },
            virtualmode: true,
            autoBind: true,
            rendergridrows: function () {
                return dataAdapter.records;
            },
            ready() {
                table.jqxGrid('sortby', 'id', 'desk');
                table.jqxGrid('updatebounddata');
                checkUrl()
            },
            source: dataAdapter,
            sortable: true,
            columnsResize: false,
            editable: true,
            filterable: true,
            filtermode: 'default',
            editmode: 'selectedrow',
            localization: getLocalization('uk'),
            selectionMode: 'multiplerowsextended',
            enablehover: false,
            columnsreorder: true,
            autoshowfiltericon: true,
            pagermode: 'advanced',
            rowsheight: 35,
            filterbarmode: 'simple',
            toolbarHeight: 45,
            showToolbar: true,
            rendertoolbar: function (statusbar) {
                var columns = table.jqxGrid("columns").records;
                var columnCount = columns.length;
                //console.log(columns)
                //console.log(columnCount)
                return toolbarRendererGuard(statusbar, table, false, 1, columnCount - 1,); // Subtract 1 to exclude the action column
            },
            columns: [
                {
                    dataField: 'id',
                    align: 'left',
                    cellsalign: 'right',
                    text: "ID",
                    editable: false,
                    cellclassname: setColor,
                    width: 70,
                    cellsrenderer: function (row, column, rowData) {
                        return '<div style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: flex-end; padding-right: 5px" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                    }
                },
                {
                    dataField: "time_arrival",
                    align: 'left',
                    cellsalign: 'left',
                    text: "Прибуття",
                    editable: false,
                    width: 100,
                    cellclassname: setColor,
                    cellsrenderer: function (row, column, rowData) {
                        return '<div style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                    },
                },
                {
                    dataField: 'auto_name',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Назва авто",
                    width: 150,
                    editable: false,

                    cellclassname: setColor,
                    cellsrenderer: function (row, column, rowData) {
                        return '<div class="fw-bolder" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + ' <img class="align-self-end" src="' + window.location.origin + '/assets/icons/triangle.svg" alt="triangle"></div>';
                    },


                },
                {
                    dataField: 'licence_plate',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Дані про авто",
                    width: 140,
                    cellbeginedit: cellbeginedit,
                    cellendedit: cellendedit,
                    cellclassname: setColor,
                    cellsrenderer: function (row, column, rowData) {
                        if (rowData == '') {
                            rowData = 'Невизначено'
                            return '<div class="text-secondary" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                        } else {
                            return '<div class="fw-bolder" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                        }

                    },
                },
                {
                    dataField: 'palet',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Палети",
                    width: 65,
                    cellclassname: setColor,
                    editable: false,
                    cellsrenderer: paletRender
                },
                {
                    dataField: 'download_method',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Тип зав.",
                    width: 110,
                    cellclassname: setColor,
                    editable: false,
                    cellsrenderer: function (row, column, rowData) {
                        if (rowData == '') {
                            rowData = 'Невизначено'
                            return '<div class="text-secondary" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                        } else {
                            return '<div style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                        }
                    },
                },
                {
                    dataField: 'download_zone',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Зона зав.",
                    width: 110,
                    cellclassname: setColor,
                    editable: false,
                    cellsrenderer: function (row, column, rowData) {
                        if (rowData == '') {
                            rowData = 'Невизначено'
                            return '<div class="text-secondary" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                        } else {
                            return '<div style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                        }
                    },
                },
                {
                    dataField: 'storekeeper',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Комірник",
                    minwidth: 150,
                    cellclassname: setColor,
                    editable: false,
                    cellsrenderer: function (row, column, rowData) {
                        if (rowData == '') {
                            rowData = 'Невизначено'
                            return '<div class="text-secondary" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                        } else {
                            return '<div style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                        }
                    },
                },
                {
                    dataField: 'status',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Статус",
                    editable: false,
                    cellclassname: setColor,
                    minwidth: 130,
                    cellsrenderer: function (row, column, rowData) {
                        if (rowData == '') {
                            rowData = 'Невизначено'
                            return '<div class="text-secondary h-100" style="flex:1;padding-left:5px; vertical-align: middle; display: flex; align-items: center; justify-content: flex-start; padding-right: 5px; text-overflow: ellipsis; overflow: hidden" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                        } else {
                            return '<div class="fw-bold h-100" style="flex:1;padding-left:5px; vertical-align: middle; display: flex; align-items: center; justify-content: flex-start; padding-right: 5px; text-overflow: ellipsis; overflow: hidden" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                        }
                    },

                },
                {
                    dataField: 'register',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Реєстрація",
                    cellsrenderer: registrationRender,
                    cellclassname: setColor,
                    editable: false,
                    width: 150,
                },
                {
                    dataField: 'entrance',
                    align: 'left',
                    cellsalign: 'left',
                    text: "В'їзд",
                    editable: false,
                    cellsrenderer: guardianEntranceRender,
                    cellclassname: setColor,
                    width: 130,
                },
                {
                    dataField: 'departure',
                    align: 'left',
                    cellsalign: 'left',
                    text: "Виїзд",
                    editable: false,
                    cellsrenderer: guardianDepartureRender,
                    cellclassname: setColor,
                    minwidth: 120,
                },

                {
                    width: '70px',
                    dataField: 'action',
                    align: 'center',
                    cellsalign: 'center',
                    text: "Дія",
                    renderer: function () {
                        return '<div class="h-100" style="display: flex; align-items: center; justify-content: center; height: 100%;"><img src="' + window.location.origin + '/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/setting-button-table.svg" alt="setting-button-table"></div>';
                    },
                    filterable: false,
                    sortable: false,
                    editable: false,
                    id: "action",
                    cellClassName: function (row, columnfield, value, data) {
                        var class_name = setColor(row, columnfield, value, data);
                        return "action-table-drop " + class_name;
                    },
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
                                return '<div id="' + popoverId + '"><ul class="popover-castom" style="list-style: none">     <li><a class="dropdown-item" href="' + window.location.origin + "/register/storekeeper/" + '">Перегляд в комірнику</a></li> </ul></div>'; // Replace with your popover content
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
        {label: 'ID', value: 'id', checked: true},
        {label: "Прибуття", value: 'time_arrival', checked: true},
        {label: 'Назва авто', value: 'auto_name', checked: true},
        {label: 'Дані про авто', value: 'licence_plate', checked: true},
        {label: 'Палети', value: 'palet', checked: true},
        {label: 'Тип зав.', value: 'download_method', checked: true},
        {label: 'Зона зав.', value: 'download_zone', checked: true},
        {label: 'Комірник', value: 'storekeeper', checked: true},
        {label: 'Статус', value: 'status', checked: true},
        {label: 'Реєстрація', value: 'register', checked: true},
        {label: "В'їзд", value: 'entrance', checked: true},
        {label: 'Виїзд', value: 'departure', checked: true},
        {label: 'Дії', value: 'action', checked: true},

    ];

    listbox(table, listSource);

    table.on('mouseenter', '[role="row"]', function (event) {
        var cell = $(event.currentTarget).find('[role="gridcell"]');
        var cells_with_data = [
            {
                name: '_auto_name',
                content: '<div class="bg-white m-0"><h3 class="text-start fw-bolder">Клієнти</h3> <ol style="padding-left: inherit" class="text-start m-0 ps-2"><li>Сафроняк М.В (Чернівці)</li> <li>Сафроняк М,В (Культ Чернівці)</li> <li>Сафроняк М,В (Кременці)</li></ol></div>'
            },
            {name: '_status'},
            {name: '_id'},
            {name: '_time_arrival'},
            {name: '_licence_plate'},
            {name: '_download_method'},
            {name: '_download_zone'},
            {name: '_storekeeper'},
            {name: '_palet'},
            {name: '_manager'},
            {name: '_entrance'},
            {name: '_departure'},
            {name: '_register'}
        ];

        cells_with_data.forEach(function (cell_data) {
            var cells_with_name = cell.find('[id*="' + cell_data.name + '"]');
            cells_with_name.each(function () {
                var cell_text = $(this).text();
                //console.log(cell_text)
                if (cell_text === "") {
                    $(this).jqxTooltip("close");
                } else {
                    var tooltipContent = '<div style="padding: 16px 18px;" class="bg-white m-0">' + cell_text + '</div>';

                    if (cell_data.name === '_entrance' || cell_data.name === '_departure' || cell_data.name === '_register') {
                        if (cell_text !== 'Невизначено') {
                            // Використовуємо регулярний вираз для розбиття дати та часу
                            var dateTimePattern = /(\d{2}:\d{2})(\d{2}\.\d{2}\.\d{4})/;
                            var matches = cell_text.match(dateTimePattern);

                            if (matches && matches.length === 3) {
                                var time = matches[1]; // Отримати час
                                var date = matches[2]; // Отримати дату

                                // Форматування часу та дати
                                var formattedTime = '<strong>' + time + '</strong>';
                                var formattedDate = date.substring(0, 2) + date.substring(2, 4) + date.substring(4);

                                tooltipContent = '<div style="padding: 16px 18px;" class="bg-white m-0">' + formattedTime + ' ' + formattedDate + '</div>';
                            }
                        }
                    } else if (cell_data.name === '_auto_name') {
                        tooltipContent = '<div style="padding: 16px 18px;" class="bg-white m-0">' + cell_data.content + '</div>';
                    } else {
                        tooltipContent = '<div style="padding: 16px 18px;" class="bg-white m-0">' + cell_text + '</div>';
                    }

                    $(this).jqxTooltip({
                        content: tooltipContent, position: 'bottom', name: 'movieTooltip', opacity: 1
                    });
                }
            });
        });

    });

    table.on('mouseenter', '[role="row"]', function (event) {
        if (!$(event.currentTarget).find('[role="checkbox"]').is(':checked')) {
            var cellHover = $(event.currentTarget).find('[role="gridcell"]').addClass('jqx-grid-row-hover');
            if ($(event.currentTarget).find('[role="gridcell"]').hasClass('blink')) {
                $(event.currentTarget).find('[role="gridcell"]').removeClass('jqx-grid-row-hover');
                cellHover.find('input').removeClass('jqx-grid-row-hover');
            } else {
                $(event.currentTarget).find('[role="gridcell"]').addClass('jqx-grid-row-hover');
                cellHover.find('input').addClass('jqx-grid-row-hover');
            }
            isRowHovered = true;
        }
    });

    table.on('mouseleave', '[role="row"]', function (event) {
        if (!$(event.currentTarget).find('[role="checkbox"]').is(':checked')) {
            var cellHover = $(event.currentTarget).find('[role="gridcell"]').removeClass('jqx-grid-row-hover');
            cellHover.find('input').removeClass('jqx-grid-row-hover');
            if ($(event.currentTarget).find('[role="gridcell"]').hasClass('blink')) {
                $(event.currentTarget).find('[role="gridcell"]').removeClass('jqx-grid-row-hover');
                cellHover.find('input').removeClass('jqx-grid-row-hover');
            } else {
                $(event.currentTarget).find('[role="gridcell"]').removeClass('jqx-grid-row-hover');
                cellHover.find('input').removeClass('jqx-grid-row-hover');
            }
            isRowHovered = false;
        }
    });

    table.on('click', '[role="gridcell"]', function (event) {
        if ($(this).is(':checked')) {
            $(this).closest('[role="row"]').find('[role="gridcell"]').removeClass('jqx-grid-row-hover');
            isRowHovered = false;
        } else {
            if (!isRowHovered) {
                $(this).closest('[role="row"]').find('[role="gridcell"]').addClass('jqx-grid-row-hover');
                isRowHovered = true;
            }
        }
    });

    table.on('cellclick', function (event) {
        var args = event.args;
        var columnDataField = args.datafield;
        // console.log(args)
        // console.log(event)
        // Перевірте, чи це клітина 'entrance'
        if (columnDataField === 'register' || columnDataField === 'entrance' || columnDataField === 'departure' || columnDataField === 'action') {
            // Отримайте ID рядка та стовпця, які були натиснуті
            var rowId = args.rowindex;
            var colId = args.columnindex;

            // Отримайте кнопку всередині клітинки 'entrance'
            var btnEntrance = table.find('[id=' + columnDataField + '-' + rowId + ']');

            // Перевірте, чи натиснута кнопка
            if ($(event.originalEvent.target).is(btnEntrance)) {
                // Відключіть редагування для всієї таблиці, окрім клітинки 'entrance'
                for (var i = 0; i < table.jqxGrid('columns').records.length; i++) {
                    if (i !== colId) {
                        table.jqxGrid('endcelledit', rowId, i, false);
                    }
                }
            }
        }
    });

    //End script
    // Додаємо обробник кліку на всі рядки таблиці
    $('#guardRegisterDataTable').on('click', '[role="row"]', function (event) {

        $('.blink').removeClass('blink');
    });


    $('#guardRegisterDataTable').on('click', '[role="gridcell"]', function (event) {

        $('.blink').removeClass('blink');
    });


});
