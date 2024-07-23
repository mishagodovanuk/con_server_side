import {pagerRenderer} from '../components/pager.js';
import {toolbarRender} from '../components/toolbar-advanced.js';
import {listbox} from "../components/listbox.js";
import {hover} from "../components/hover.js";

const pagerRendererDocument = pagerRenderer.bind({});

const toolbarRendererDocument = toolbarRender.bind({});



let documentID
let documentArray = []
$('.jqx-tabs-title').on('click', function () {
    $('.modal-btn:visible').css('display', 'none')
    $('#' + $(this).data('modal')).css('display', 'block')
})

for(let i = 0;i<relatedDocuments.length;i++) {
    let table = $('#update-document-'+relatedDocuments[i]['id'])

    let el = JSON.parse(relatedDocuments[i].settings)
    let fieldsData = JSON.parse(JSON.stringify(el['fields']['header']))
    let customBlocks = el['custom_blocks']

    let fields = []
    let columns = []
    let listSourceArray = []

    //generate fields from header block
    for (let key in fieldsData) {
        if (fieldsData.hasOwnProperty(key)) {
            let item = fieldsData[key];
            fields.push({name: 'data->header->'+key, type: 'string'})
            columns.push({
                dataField: 'data->header->'+key,
                align: 'left',
                cellsalign: 'left',
                text: item.name,
            })

            listSourceArray.push({label: item.name, value: 'data->header->'+key, checked: false})
        }
    }

    //generate fields from custom blocks
    for (let i = 0; i < Object.keys(customBlocks).length; i++) {
        for (let key in customBlocks[i]) {
            let item = customBlocks[i][key];
            fields.push({name: 'data->custom_blocks->'+i+'->'+key, type: 'string'})
            columns.push({
                dataField: 'data->custom_blocks->'+i+'->'+key,
                align: 'left',
                cellsalign: 'left',
                text: item.name,
            })
            listSourceArray.push({label: item.name, value: 'data->custom_blocks->'+i+'->'+key, checked: false})
        }
    }

    $(document).ready(function () {

        function getUrl() {
            let url = window.location.href;
            let regex = /\/(\d+)\/edit$/;
            let match = url.match(regex);
            documentID =match[1];

            return window.location.origin + '/document/related/filter?type_id='+relatedDocuments[i]['id']+'&document_id=' + documentID
        }

        var source = {
            datatype: 'json',
            datafields: [
                {name: 'id', type: 'number'},
                {name: "count", type: 'number'},
                ...fields,
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
                fetch(window.location.origin + '/document/related/' + documentID +'/'+rowData.id, {
                    method: 'POST',
                    body: formData
                }).then(() => {
                    commit(true)
                })

                table.jqxGrid('clearselection');
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
                    return pagerRendererDocument(table);
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
                    return toolbarRendererDocument(
                        statusbar,
                        table,
                        true,
                        1,
                        columnCount - 1,
                        `-${relatedDocuments[i]['id']}`
                    );
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
                        width: '100px',
                        dataField: 'count',
                        align: 'left',
                        cellsalign: 'right',
                        text: "Кількість",
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
            ...listSourceArray

        ];
        listbox(table, listSource, `-${relatedDocuments[i]['id']}`);
        hover(table, isRowHovered);
    });

    $(document).ready(function () {
        const pagerRendererDocument1 = pagerRenderer.bind({});

        const toolbarRendererDocument1 = toolbarRender.bind({});

        let table = $('#pop-up-document-' + relatedDocuments[i]['id'])
        let mainTable = $('#update-document-'+relatedDocuments[i]['id'])
        let isRowHovered = false;
        let addNewGoodsInvoicesItem = $("#add-document-row-"+ relatedDocuments[i]['id'])
        addNewGoodsInvoicesItem.on('click',function () {
            let selectedRowIndexes = table.jqxGrid('getselectedrowindexes')

            selectedRowIndexes.sort(function(a, b) {
                return a - b;
            });

            for (let k = 0; k < selectedRowIndexes.length; k++) {
                var rowData = table.jqxGrid('getrowdata',selectedRowIndexes[k]);

                if(!documentArray.includes(rowData.id)) {
                    documentArray.push(rowData.id)
                }
            }

            $('#modal-document-'+i).modal('hide')

            let relatedDocumentFormData = new FormData()
            relatedDocumentFormData.append('_token', document.querySelector('meta[name="csrf-token"]').content)
            relatedDocumentFormData.append('related_documents', JSON.stringify(documentArray))
            relatedDocumentFormData.append('document_id', documentID)
            fetch(window.location.origin + '/document/related', {
                method: 'POST',
                body: relatedDocumentFormData
            }).then(async function (res) {
                table.jqxGrid('clearselection')
                mainTable.jqxGrid('updatebounddata')
            })
        })

        let dataSource = {
            dataType: "json",
            datafields: [
                {name: 'id', type: 'number'},
                {name: "count", type: 'number'},
                ...fields,
            ],
            url: window.location.origin + '/document-type/table/filter?type_id=' + relatedDocuments[i]['id'],
            beforeprocessing: function (data) {
                dataSource.totalrecords = data.total;
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

        let grid = table.jqxGrid(
            {
                theme: "light-wms",
                width: '100%',
                autoheight: true,
                pageable: true,
                source: new $.jqx.dataAdapter(dataSource),
                pagerRenderer: function () {
                    return pagerRendererDocument1(table);
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
                    var columns = table.jqxGrid("columns").records;
                    var columnCount = columns.length;
                    //console.log(columns)
                    //console.log(columnCount)
                    return toolbarRendererDocument1(
                        statusbar,
                        table,
                        false,
                        1,
                        columnCount - 1,
                    ); // Subtract 1 to exclude the action column
                },

                columns: [
                    {
                        width: '70px',
                        dataField: 'id',
                        align: 'left',
                        cellsalign: 'right',
                        text: "ID",
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
            ...listSourceArray

        ];

        hover(table, isRowHovered);

        // Лічильник записів для кнопки
        var selectedCount = table.jqxGrid('getselectedrowindexes').length;

        var updateSelectedCount = function () {
            var selectedCount = table.jqxGrid('getselectedrowindexes').length;
            addNewGoodsInvoicesItem.text("Додати " + selectedCount);
            //console.log(selectedCount)
            if (selectedCount > 0) {
                addNewGoodsInvoicesItem.removeAttr("disabled")
            } else {
                addNewGoodsInvoicesItem.attr("disabled", "")

            }
        }

        // додаємо обробник події на зміну вибраних рядків у таблиці jqxGrid
        table.on('rowselect rowunselect', function () {
            updateSelectedCount();
        });

        addNewGoodsInvoicesItem.on("click", function () {
        })
    });
}
