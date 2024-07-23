import {pagerRenderer} from '../components/pager.js';
import {toolbarRender} from '../components/toolbar-advanced.js';
import {listbox} from "../components/listbox.js";

const pagerRendererStorekeeper = pagerRenderer.bind({});
const toolbarRendererStorekeeper = toolbarRender.bind({});

$(document).ready(function () {
    let editableRows = []
    let isEditing = false;
    let table = $('#storekeeperRegisterTable')
    let isRowHovered = false;

    window.Echo.channel('registers').listen("RegistersChangedStatus", (event) => {
        var register = event.register
        //console.log(register)
        table.jqxGrid("updatebounddata");
        $('.loader')[0].style.display = 'none'
        if (register.status_id == 1) {
            refreshTable(table)
            var audio = new Audio('https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/success.mp3');
            audio.play();
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
        if (!isEditing) {
            table.jqxGrid("updatebounddata");
        }
    }

    function isUndefinedRender(row, column, value) {
        if (value == null || value == "") {
            return '<div class="text-secondary" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + 'Невизначено' + '</div>';
        }
        return '<div class="" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + value + '</div>';

    }

    function entranceRender(row, column, value, defaultHtml, columnSettings, rowData) {
        let html = defaultHtml.split('><');
        let innerHTML = rowData.entrance ?? '';

        if (rowData.register === null && rowData.entrance === null) {
            return html[0] + ">" + '<div class="text-secondary">Невизначено</div>' + '<' + html[1];
        } else if (rowData.status_key !== 'create' && rowData.status_key !== "release" && rowData.entrance === null) {
            editableRows.push(row);

            let cancelHide = true;

            if (rowData.status_key === 'apply') {
                cancelHide = false;
            }

            innerHTML = "<button class='btn btn-primary start-btn button-action-table' " + (cancelHide ? '' : "style='display: none'") + " id='entrance-" + rowData.id + "' onclick='storekeeperEntranceClick(" + rowData.id + ")'>Запустити</button>" + "<button class='btn btn-danger cancel-btn button-action-table' " + (cancelHide ? "style='display: none'" : '') + " id='cancel-" + rowData.id + "' onclick='cancelClick(" + rowData.id + ")'>Відмінити</button>";
            return html[0] + '><div style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between\" >' + innerHTML + '</div><' + html[1];
        }
        // Розділити час на години і хвилини
        const timeParts = value.split(' ');
        const time = timeParts[0]; // Отримати час частини

        // Отримати дату частини
        const date = timeParts[1];

        // Зробити час жирним
        const boldTime = '<div class="fw-bold">' + time + '</div>';
        // Повернути оновлене відображення
        return '<div class="gap-1" style="flex:1;padding-left:5px;overflow:hidden; text-overflow:ellipsis;vert-align: middle; display: flex; align-items: center;" id="cell_' + row + '_' + column + '">' + boldTime + date + '</div>';
    }


    function registerRender(row, column, value, defaultHtml, columnSettings, rowData) {
        if (rowData.register == null) {
            let html = defaultHtml.split('><');
            return html[0] + ">" + 'Невизначено' + '<' + html[1];
        }
        if (rowData == '') {
            rowData = "Невизначено";
            return '<div class="text-secondary h-100" style="flex:1;padding-left:5px;overflow:hidden; text-overflow:ellipsis; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
        }

        // Розділити час на години і хвилини
        const timeParts = value.split(' ');
        const time = timeParts[0]; // Отримати час частини

        // Отримати дату частини
        const date = timeParts[1];

        // Зробити час жирним
        const boldTime = '<div class="fw-bold">' + time + '</div>';

        // Повернути оновлене відображення
        return '<div class=" gap-1" style="flex:1;padding-left:5px;overflow:hidden; text-overflow:ellipsis;vert-align: middle; display: flex; align-items: center;" id="cell_' + row + '_' + column + '">' + boldTime + date + '</div>';

    }


    function departureRender(row, column, value, defaultHtml, columnSettings, rowData) {
        if (rowData.departure == null) {
            let html = defaultHtml.split('><')
            return html[0] + '><div class="text-secondary" style="flex:1;padding-left:5px;overflow:hidden; text-overflow:ellipsis;vert-align: middle; display: block; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + ' Невизначено' + '</div><' + html[1]
        }

        // Розділити час на години і хвилини
        const timeParts = value.split(' ');
        const time = timeParts[0]; // Отримати час частини

        // Отримати дату частини
        const date = timeParts[1];

        // Зробити час жирним
        const boldTime = '<div class="fw-bold">' + time + '</div>';
        defaultHtml = boldTime + date;
        return '<div class="gap-1" style="flex:1;padding-left:5px;overflow:hidden; text-overflow:ellipsis;vert-align: middle; display: flex; align-items: center;" id="cell_' + row + '_' + column + '">' + defaultHtml + '</div>';
    }

    function paletRender(row, column, value, defaultHtml, columnSettings, rowData) {
        return '<div style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '"><div class="palletCellStorekeeper">' + rowData.mono_pallet + '/' + rowData.collect_pallet + '</div></div>';
    }


    function setColor(row, columnfield, value, data) {
        switch (data.status_key) {
            case 'register':
                return 'registered-status mt-0 gap-1 d-flex align-items-center'
            case 'apply':
                return 'applied-status mt-0 gap-1 d-flex align-items-center';
            case 'launch':
                return 'launched-status mt-0 gap-1 d-flex align-items-center';
            default:
                return 'mt-0 d-flex gap-1 align-items-center';

        }
    }

    var cellbeginedit = function (row, datafield, columntype, value) {
        if (!editableRows.includes(row)) {
            return false;
        }
    }

    var source =
        {
            dataType: "json",
            dataFields: [
                {name: 'id', type: 'number'},
                {name: "time_arrival", type: 'string'},
                {name: "auto_name", type: 'string'},
                {name: 'licence_plate', type: 'string'},
                {name: 'mono_pallet', type: 'string'},
                {name: 'collect_pallet', type: 'string'},
                {name: 'download_method', type: 'string'},
                {name: 'download_zone', type: 'string'},
                {name: 'storekeeper', type: 'string'},
                {name: 'manager', type: 'string'},
                {name: 'register', type: 'string'},
                {name: 'entrance', type: 'string'},
                {name: 'departure', type: 'string'},
                {name: 'status', type: 'string'},
                {name: 'status_key', type: 'string'},
                {name: 'action', type: 'string'}

            ],
            url: window.location.origin + '/register/filter',
            root: 'data',
            beforeprocessing: function (data) {
                source.totalrecords = data.total;
            },

            filter: function () {
                // update the grid and send a request to the server.
                $("#storekeeperRegisterTable").jqxGrid('updatebounddata', 'filter');
            },
            sort: function () {
                // update the grid and send a request to the server.
                $("#storekeeperRegisterTable").jqxGrid('updatebounddata', 'sort');
            },
            updaterow: function (rowid, newdata, commit) {
                let formData = new FormData()
                formData.append('_method', 'PUT')
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content)
                for (var key in newdata) {
                    formData.append(key, newdata[key]);
                }
                fetch(window.location.origin + '/register/' + newdata.id, {
                    method: 'POST', body: formData
                }).then((res) => {
                    if (res.status === 200) {
                        commit(true)
                    } else {
                        alert('Something wrong, please reload page')
                    }
                })
            },
            beforeLoadComplete: function () {
                editableRows = []
            }
        };

    let dataAdapter = new $.jqx.dataAdapter(source);
    var cellendedit = function (event) {
        isEditing = false
    }


    $("#storekeeperRegisterTable").jqxGrid({
        theme: "light-wms",
        width: '100%',
        autoheight: true,
        pageable: true,
        pagerRenderer: function () {
            return pagerRendererStorekeeper(table);
        },
        virtualmode: true,
        autoBind: true,
        rendergridrows: function () {
            return dataAdapter.records;
        },
        ready() {
            table.jqxGrid('sortby', 'id', 'desk');
            table.jqxGrid('updatebounddata');
            checkUrl();
        },

        source: dataAdapter,
        sortable: true,
        columnsResize: false,
        editable: true,
        filterable: true,
        filtermode: 'default',
        localization: getLocalization('uk'),
        selectionMode: 'multiplerowsextended',
        columnsreorder: true,
        autoshowfiltericon: true,
        pagermode: 'advanced',
        rowsheight: 35,
        filterbarmode: 'simple',
        showToolbar: true,
        toolbarHeight: 45,
        enablehover: false,
        editmode: 'selectedrow',
        rendertoolbar: function (statusbar) {
            var columns = table.jqxGrid("columns").records;
            var columnCount = columns.length;
            //console.log(columns)
            //console.log(columnCount)
            return toolbarRendererStorekeeper(statusbar, table, false, 1, columnCount - 1,); // Subtract 1 to exclude the action column
        },
        columns: [{
            dataField: 'id',
            align: 'left',
            cellsalign: 'right',
            text: "ID",
            cellclassname: setColor,
            editable: false,
            width: 80,
            cellsrenderer: function (row, column, rowData) {
                return '<div style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: flex-end" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
            },
        }, {
            dataField: "time_arrival",
            align: 'left',
            cellsalign: 'left',
            text: "Прибуття",
            cellclassname: setColor,
            editable: false,
            width: 130,
            cellsrenderer: function (row, column, rowData) {
                return '<div style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
            },
        }, {
            dataField: 'auto_name',
            align: 'left',
            cellsalign: 'left',
            text: "Назва авто",
            cellclassname: setColor,
            editable: false,
            cellbeginedit: cellbeginedit,
            width: 130,
            cellsrenderer: function (row, column, rowData) {
                return '<div class="fw-bolder" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + ' <img class="align-self-end" src="' + window.location.origin + '/assets/icons/triangle.svg" alt="triangle"></div>';
            }

        }, {
            dataField: 'licence_plate',
            align: 'left',
            cellsalign: 'left',
            text: "Дані про авто",
            cellclassname: setColor,
            editable: false,
            cellbeginedit: cellbeginedit,
            width: 150,
            cellsrenderer: function (row, column, rowData) {
                if (rowData == '') {
                    rowData = "Невизначено"

                    return '<div class="text-secondary " style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + ' <img class="align-self-end" src="' + window.location.origin + '/assets/icons/triangle.svg" alt="triangle"></div>';
                } else {
                    return '<div class="fw-bolder" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + ' <img class="align-self-end" src="' + window.location.origin + '/assets/icons/triangle.svg" alt="triangle"></div>';
                }
            }

        }, {
            dataField: 'palet',
            align: 'left',
            cellsalign: 'left',
            text: "Палети",
            editable: true,
            cellclassname: setColor,
            cellbeginedit: cellbeginedit,
            width: 120,
            cellendedit: cellendedit,
            columntype: 'custom',
            cellsrenderer: paletRender,
            createeditor: function (row, cellvalue, editor, cellText, width, height) {
                let id = row % table.jqxGrid('getpaginginformation').pagesize
                let rowData = table.jqxGrid('getrowdatabyid', id)
                editor.addClass("jqxMaskedInput_row_" + row)
                editor.addClass("jqxMaskedInput")
                let mono_pallet = rowData.mono_pallet.toString().length > 1 ? rowData.mono_pallet : '0' + rowData.mono_pallet
                let collect_pallet = rowData.collect_pallet.toString().length > 1 ? rowData.collect_pallet : '0' + rowData.collect_pallet
                $(editor).jqxMaskedInput({
                    mask: '##/##', width: width, height: height + 1, placeHolder: '09/04'
                });
                $(editor).val(mono_pallet + '/' + collect_pallet);
            },
            geteditorvalue: function (row, cellvalue, editor) {
                let id = row % table.jqxGrid('getpaginginformation').pagesize
                let rowData = table.jqxGrid('getrowdatabyid', id)

                let str = editor.find('input').val();

                // Split the edited value into an array
                let arr = str.split('/');

                // Update the row data's palet1 and palet2 properties based on the edited value
                rowData.mono_pallet = parseInt(arr[0]);
                rowData.collect_pallet = parseInt(arr[1]);

                // Update the row data in the grid using the updaterow method
                table.jqxGrid('updaterow', id, rowData);

            }
        }, {
            dataField: 'download_method',
            align: 'left',
            cellsalign: 'left',
            text: "Тип зав.",
            cellclassname: setColor,
            cellbeginedit: cellbeginedit,
            width: 135,
            cellendedit: cellendedit,
            columntype: 'dropdownlist',
            createeditor: function (row, column, editor, width, height) {
                // assign a new data source to the dropdownlist.
                let sourceArray = transportDownload.map(item => item.name)
                //console.log(sourceArray)
                editor.addClass("dropdownlist_row_" + row)
                editor.jqxDropDownList({
                    autoDropDownHeight: true, source: sourceArray, width: width, height: height
                });
            }, // update the editor's value before saving it.
            cellvaluechanging: function (row, column, columntype, oldvalue, newvalue) {
                // return the old value, if the new value is empty.
                if (newvalue == "") return oldvalue;
            },
            cellsrenderer: function (row, column, rowData) {
                if (rowData == '') {
                    rowData = "Невизначено"

                    return '<div class="text-secondary" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                } else {
                    return '<div class="" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                }
            },
        }, {
            dataField: 'download_zone',
            align: 'left',
            cellsalign: 'left',
            text: "Зона зав.",
            cellclassname: setColor,
            cellbeginedit: cellbeginedit,
            width: 135,
            cellendedit: cellendedit,
            columntype: 'dropdownlist',

            createeditor: function (row, column, editor, width, height) {
                // assign a new data source to the dropdownlist.
                let sourceArray = downloadZone.map(item => item.name)
                //console.log(sourceArray)
                editor.addClass("dropdownlist_row_" + row)
                editor.jqxDropDownList({
                    autoDropDownHeight: true, source: sourceArray, width: width, height: height
                });
            }, // update the editor's value before saving it.
            cellvaluechanging: function (row, column, columntype, oldvalue, newvalue) {
                // return the old value, if the new value is empty.
                if (newvalue == "") return oldvalue;
            },
            cellsrenderer: function (row, column, rowData) {
                if (rowData == '') {
                    rowData = "Невизначено"

                    return '<div class="text-secondary" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                } else {
                    return '<div class="" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                }
            },
        }, {
            dataField: 'storekeeper',
            align: 'left',
            cellsalign: 'left',
            text: "Комірник",
            width: 135,
            cellclassname: setColor,
            cellbeginedit: cellbeginedit,
            cellendedit: cellendedit,
            columntype: 'dropdownlist',
            createeditor: function (row, column, editor, width, height) {
                const names = storekeepers.map(item => item.full_name)
                editor.addClass("dropdownlist_row_" + row)
                editor.jqxDropDownList({
                    autoDropDownHeight: true, source: names, width: width, height: height
                });
            }, // update the editor's value before saving it.
            cellvaluechanging: function (row, column, columntype, oldvalue, newvalue) {
                // return the old value, if the new value is empty.
                if (newvalue == "") return oldvalue;
            },
            cellsrenderer: function (row, column, rowData) {
                if (rowData == '') {
                    rowData = "Невизначено"

                    return '<div class="text-secondary " style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                } else {
                    return '<div class="" style="flex:1;padding-left:5px;height: 100%; display: flex; align-items: center; justify-content: space-between" id="cell_' + row + '_' + column + '">' + rowData + '</div>';
                }
            },
        }, {
            dataField: 'manager',
            align: 'left',
            cellsalign: 'left',
            text: "Менеджер",
            cellclassname: setColor,
            cellbeginedit: cellbeginedit,
            cellsrenderer: isUndefinedRender,
            width: 135,
            editable: false
        }, {
            dataField: 'register',
            align: 'left',
            cellsalign: 'left',
            text: "Реєстрація",
            cellsrenderer: registerRender,
            cellclassname: setColor,
            editable: false,
            width: 135,

        }, {
            dataField: 'entrance',
            align: 'left',
            cellsalign: 'left',
            text: "В'їзд",
            cellsrenderer: entranceRender,
            cellclassname: setColor,
            editable: false,
            width: 150,


        }, {
            dataField: 'departure',
            align: 'left',
            cellsalign: 'left',
            text: "Виїзд",
            cellsrenderer: departureRender,
            cellclassname: setColor,
            editable: false,
            minwidth: 135,

        }, {
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
                        return '<div id="' + popoverId + '"><ul class="popover-castom" style="list-style: none">     <li><a class="dropdown-item" href="' + window.location.origin + "/register/guard/" + '">Перегляд в охороні</a></li> </ul></div>'; // Replace with your popover content
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

        },],
    });

    var listSource = [{label: 'ID', value: 'id', checked: true}, {
        label: "Прибуття",
        value: 'time_arrival',
        checked: true
    }, {label: 'Назва авто', value: 'auto_name', checked: true}, {
        label: 'Дані про авто',
        value: 'licence_plate',
        checked: true
    }, {label: 'Палети', value: 'palet', checked: true}, {
        label: 'Тип зав.',
        value: 'download_method',
        checked: true
    }, {label: 'Зона зав.', value: 'download_zone', checked: true}, {
        label: 'Комірник',
        value: 'storekeeper',
        checked: true
    }, {label: 'Менеджер', value: 'manager', checked: true}, {
        label: 'Реєстрація',
        value: 'register',
        checked: true
    }, {label: "В'їзд", value: 'entrance', checked: true}, {
        label: 'Виїзд',
        value: 'departure',
        checked: true
    }, {label: 'Дії', value: 'action', checked: true},

    ];

    listbox(table, listSource);

    table.on('mouseenter', '[role="row"]', function (event) {
        var cell = $(event.currentTarget).find('[role="gridcell"]');
        var cells_with_data = [{
            name: '_auto_name',
            content: '<div class="bg-white m-0"><h3 class="text-start fw-bolder">Клієнти</h3> <ol  class="text-start m-0 ps-1 text-secondary"><li>Сафроняк М.В (Чернівці)</li> <li>Сафроняк М,В (Культ Чернівці)</li> <li>Сафроняк М,В (Кременці)</li></ol></div>'
        }, {
            name: '_licence_plate',
            content: '<div style="" class="bg-white m-0"><h3 class="text-start fw-bolder">Авто і водій</h3> <ul style="list-style-type:none; margin: 0; padding: 0; " class="text-start m-0 text-secondary"><li>Рено 250 R</li> <li>Симоненко І.В</li> <li>0686666666</li></ul></div>',
        }, {name: '_status'}, {name: '_id'}, {name: '_time_arrival'}, {name: '_download_method'}, {name: '_download_zone'}, {name: '_storekeeper'}, {name: '_palet'}, {name: '_manager'}, {name: '_entrance'}, {name: '_departure'}, {name: '_register'}];

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
                    } else if (cell_data.name === '_auto_name' || cell_data.name === '_licence_plate') {
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
            cellHover.find('input').addClass('jqx-grid-row-hover');
            isRowHovered = true;
        }
    });

    table.on('mouseleave', '[role="row"]', function (event) {
        if (!$(event.currentTarget).find('[role="checkbox"]').is(':checked')) {
            var cellHover = $(event.currentTarget).find('[role="gridcell"]').removeClass('jqx-grid-row-hover');
            cellHover.find('input').removeClass('jqx-grid-row-hover');
            isRowHovered = false;
        }
    });


    table.on('rowunselect', function (event) {
        const row = $(event.args.row);
        const rowId = row[0].uid;
        const dropdownlist = table.find('.dropdownlist_row_' + rowId);
        const jqxMaskedInput = table.find('.jqxMaskedInput_row_' + rowId)
        const jqxMaskedInputInInput = table.find('.jqxMaskedInput_row_' + rowId + ' input')

        const gridcell = $(event.currentTarget).find('[role="gridcell"]')
        if (gridcell.hasClass('registered-status')) {
            dropdownlist.addClass('registered-status-dropdawn');
            jqxMaskedInput.addClass('registered-status-dropdawn');
            jqxMaskedInputInInput.addClass('registered-status-dropdawn');

        }
        if (gridcell.hasClass('applied-status')) {
            dropdownlist.addClass('applied-status-dropdawn');
            jqxMaskedInput.addClass('applied-status-dropdawn');
            jqxMaskedInputInInput.addClass('applied-status-dropdawn');

        }
        if (gridcell.hasClass('launched-status')) {
            dropdownlist.addClass('launched-status-dropdawn');
            jqxMaskedInput.addClass('launched-status-dropdawn');
            jqxMaskedInputInInput.addClass('launched-status-dropdawn');

        }
    });

    table.on('rowselect', function (event) {
        const row = $(event.args.row);
        const rowId = row[0].uid;
        //console.log(rowId)
        const dropdownlist = table.find('.dropdownlist_row_' + rowId);
        const jqxMaskedInput = table.find('.jqxMaskedInput_row_' + rowId)
        const jqxMaskedInputInInput = table.find('.jqxMaskedInput_row_' + rowId + ' input')

        const gridcell = $(event.currentTarget).find('[role="gridcell"]')
        if (gridcell.hasClass('registered-status')) {
            dropdownlist.removeClass('registered-status-dropdawn');
            jqxMaskedInput.removeClass('registered-status-dropdawn');
            jqxMaskedInputInInput.removeClass('registered-status-dropdawn');

        } else if (gridcell.hasClass('applied-status')) {
            dropdownlist.removeClass('applied-status-dropdawn');
            jqxMaskedInput.removeClass('applied-status-dropdawn');
            jqxMaskedInputInInput.removeClass('applied-status-dropdawn');

        } else if (gridcell.hasClass('launched-status')) {
            dropdownlist.removeClass('launched-status-dropdawn');
            jqxMaskedInput.removeClass('launched-status-dropdawn');
            jqxMaskedInputInInput.removeClass('launched-status-dropdawn');

        }
    });

    table.on('cellclick', function (event) {
        var args = event.args;
        var columnDataField = args.datafield;
        //console.log(args)
        //console.log(event)
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

});
