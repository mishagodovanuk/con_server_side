import {pagerRenderer} from "../../components/pager.js";
import {toolbarRender} from "../../components/toolbar-advanced.js";
import {listbox} from "../../components/listbox.js";
import {hover} from "../../components/hover.js";


const pagerRendererLeftovers = pagerRenderer.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});

$(document).ready(function () {
    let table = $("#created-consolidation-table");
    let isRowHovered = false;
    let tabTypes = ['uploading', 'common_ftl', 'lg_transport', 'reverse_loading']
    let tabType = tabTypes[0]

    let dataFields = [
        {name: "id", type: "string"},
        {name: "created", type: "string"},
        {name: "members", type: "string"},
        {name: "shippingPoint", type: "string"},
        {name: "deliveryPoint", type: "string"},
        {name: "pallets", type: "string"},
        {name: "status", type: "string"},
    ];

    $('#tabs').bind('selected', function (event) {
        var item = event.args.item;
        tabType = tabTypes[item]
        createdConsolidationDataSource.url = baseUrl + tabType
        table.jqxGrid("updatebounddata")
    });


   let createdConsolidationDataSource = {
        datatype: "json",
        datafields: dataFields,
        root: 'data',
        beforeprocessing: function (data) {
            createdConsolidationDataSource.totalrecords = data.total;
        },
        filter: function () {
            // update the grid and send a request to the server.
            table.jqxGrid('updatebounddata', 'filter');
        },
        sort: function () {
            $('.search-btn')[0].click()
        },
        url: url
    };
    let dataAdapter = new $.jqx.dataAdapter(createdConsolidationDataSource);
    var grid = table.jqxGrid({
        theme: "light-wms contract-table-custom",
        width: "100%",
        autoheight: true,
        pageable: true,
        source: dataAdapter,
        pagerRenderer: function () {
            return pagerRendererLeftovers(table);
        }, virtualmode: true,
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
        localization: getLocalization("en"),
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
                dataField: "id",
                align: "left",
                cellsalign: "right",
                text: "Consolidation №",
                editable: false,
                cellsrenderer: function (
                    row,
                    columnfield,
                    value,
                    defaulthtml,
                    columnproperties,
                    rowdata
                ) {
                    return (
                        `<div class="ps-1"><button data-id="${rowdata.id}" class="btn open-view-consolidation-page underline-on-hover" style="color: #D9B414; border: none; padding: 0;">${value}</button></div>`
                    );
                },
                width: 150,
            },
            {
                dataField: "created_at",
                align: "left",
                cellsalign: "right",
                text: "Creation date",
                editable: false,
                cellsrenderer: function (row,
                                         columnfield,
                                         value,
                                         defaulthtml,
                                         columnproperties,
                                         rowdata) {
                    return `<div class="ps-1"><span class="text-secondary">${rowdata.created}</span></div>`;
                },
                width: 200,
            },
            {
                dataField: "members",
                align: "left",
                cellsalign: "right",
                text: "Part.",
                width: 90,
                editable: false,
                cellsrenderer: function (
                    row,
                    columnfield,
                    value,
                    defaulthtml,
                    columnproperties,
                    rowdata
                ) {
                    return `<p class="ps-1 text-secondary my-auto">${rowdata.members}</p>`;
                },
            },
            {
                minwidth: 170,
                dataField: "startPoint",
                align: "left",
                cellsalign: "right",
                text: "Shipping point",
                editable: false,
                cellsrenderer: function (
                    row,
                    columnfield,
                    value,
                    defaulthtml,
                    columnproperties,
                    rowdata
                ) {
                    return `<p class="ps-1 text-secondary  my-auto">${rowdata.shippingPoint}</p>`;
                },
            },
            {
                minwidth: 170,
                dataField: "endPoint",
                align: "left",
                cellsalign: "right",
                text: "Delivery point",
                editable: false,
                cellsrenderer: function (   row,
                                            columnfield,
                                            value,
                                            defaulthtml,
                                            columnproperties,
                                            rowdata) {
                    return `<p class="text-secondary  ps-1  my-auto"  >${rowdata.deliveryPoint}</p>`;
                },
            },
            {
                width: 120,
                dataField: "pallets",
                align: "left",
                cellsalign: "right",
                text: "Pallet places",
                editable: false,
                cellsrenderer: function (row,
                                         columnfield,
                                         value,
                                         defaulthtml,
                                         columnproperties,
                                         rowdata) {
                    return `<p class="text-secondary  ps-1  my-auto"  >${rowdata.pallets}</p>`;
                },
            },
            {
                width: 170,
                dataField: "status",
                align: "left",
                cellsalign: "right",
                text: "Status",
                editable: false,
                cellsrenderer: function (row,
                                         columnfield,
                                         value,
                                         defaulthtml,
                                         columnproperties,
                                         rowdata) {
                    let statusName;
                    let color;
                    switch (rowdata.status) {
                        case 'approved':
                            statusName = 'Підтверджено'
                            color = "success"
                            break;
                        case 'unapproved':
                            statusName = 'Відхилено'
                            color = "danger"
                            break;
                        case 'sent':
                            statusName = 'Відправлено'
                            color ="primary"
                            break;
                        case 'review':
                            statusName = 'На розгляді'
                            color ="info"
                            break;
                        case 'draft':
                            statusName = 'Чернетка'
                            color = 'secondary'
                            break;
                    }

                    return `<div class="ps-1"> <div class="alert alert-${color}" style="padding : 2px 10px !important;"
                    > ${statusName} </div> </div>`;
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
                cellsrenderer: function (
                    row,
                    columnfield,
                    value,
                    defaulthtml,
                    columnproperties,
                    rowdata
                ) {
                    var buttonId = "button-" + rowdata.uid;
                    var popoverId = "popover-" + rowdata.uid;

                    let button =
                        '<button id="' +
                        buttonId +
                        '" style="padding:0" class="btn btn-table-cell" type="button" data-bs-toggle="popover"> <img src="' +
                        window.location.origin +
                        '/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/menu_dots_vertical.svg" alt="menu_dots_vertical"> </button>';

                    var popoverOptions = {
                        html: true,
                        sanitize: false,
                        placement: "left",
                        trigger: "focus",
                        container: "body",
                        content: function () {
                            return `<div id=${popoverId}>
                                          <ul class="popover-castom" style="list-style: none">
                                          <li><a class="dropdown-item" href="${window.location.origin}//${rowdata.id}">View</a></li>
                                          <li><a class="dropdown-item" href="${window.location.origin}//${rowdata.id}/edit">Edit</a></li>
                                          <li><a class="dropdown-item delete-row" href="#">Delete</a></li>
                                         </ul>
                                      </div>`;
                        },
                    };

                    $(document)
                        .off("click", "#" + buttonId)
                        .on("click", "#" + buttonId, function () {
                            $(this).popover(popoverOptions).popover("show");
                        });

                    $(document)
                        .off("click", "#" + popoverId + " .delete-row")
                        .on(
                            "click",
                            "#" + popoverId + " .delete-row",
                            function () {
                                var rowId = rowdata.uid;
                                grid.jqxGrid("deleterow", rowId);
                                $("#" + buttonId).popover("hide");
                            }
                        );

                    return (
                        '<div class="jqx-popover-wrapper">' + button + "</div>"
                    );
                },
            },
        ],
    });

    let listSource = [
        {label: "Consolidation №", value: "number", checked: true},
        {label: "Creation date", value: "created", checked: true},
        {label: "Part.", value: "participants", checked: true},
        {label: "Shipping point", value: "startPoint", checked: true},
        {label: "Delivery point", value: "endPoint", checked: true},
        {label: "Pallet places", value: "pallets", checked: true},
        {label: "Status", value: "status", checked: true},
        {label: "Actions", value: "action", checked: true},
    ];

    listbox(table, listSource);
    hover(table, isRowHovered);
});
