import {pagerRenderer} from "../components/pager.js";
import {toolbarRender} from "../components/toolbar-advanced.js";

const pagerRendererSkuPreview = pagerRenderer.bind({});
const toolbarRendererSkuPreview = toolbarRender.bind({});
$("#document-preview-button2").click(function () {
    $(document).ready(function () {
        let table = $("#skuPreviewDataTable");
        let table2 = $("#skuPreview2DataTable");

        let isRowHovered = false;

        const mainObject = JSON.parse(localStorage.getItem("settings"));
        const nomenclature = mainObject.fields.nomenclature;
        // console.log(nomenclature);
        const datafields = Object.entries(nomenclature).map(([key, value]) => {
            return {
                name: key,
                type: "number",
                // other field properties...
            };
        });
        // console.log(datafields);

        const columns = Object.entries(nomenclature).map(([key, value]) => {
            return {
                dataField: key,
                text: value.name, // use the actual field display name
                align: "left",
                cellsalign: "left",
                editable: false,
                filterable: false,
                sortable: false,
                cellsrenderer: function () {
                    return (
                        `<div class="ps-25">${value.hint}</div>`
                    );
                }
            };
        });

        // console.log(columns);

        function getUrl() {
            let url = window.location.href;

            const documentId = url.split("/").pop();

            return (
                window.location.origin +
                "/document/sku/table/filter?document_id=" +
                documentId
            );
        }

        const newRecords = [];
        for (let i = 0; i < 50; i++) {
            const record = {};
            columns.forEach((column) => {
                record[column.dataField] = column.text; // replace '' with the default value for this column
            });
            newRecords.push(record);
        }

        var source = {
            datatype: "array",
            localData: newRecords,
            datafields: [...datafields],
        };
        let dataAdapter = new $.jqx.dataAdapter(source);

        var grid = table.jqxGrid({
            theme: "light-wms",
            width: "100%",
            autoheight: true,
            pageable: true,
            pagerRenderer: function () {
                return pagerRendererSkuPreview(table);
            },
            ready() {
                checkUrl();
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
            filtermode: "default",
            localization: getLocalization("uk"),
            selectionMode: "multiplerowsextended",
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

                var filterinfo = table.jqxGrid("getfilterinformation")[
                    columnindex
                    ];

                // Disable filtering for the "Name" column
                if (filterinfo != null && filterinfo.filter != null) {
                    filterinfo.filter.setlogic("and");
                    filterinfo.filter.setoperator(0);
                    filterinfo.filter.setvalue("");
                }
            },
            rendertoolbar: function (statusbar) {
                return toolbarRendererSkuPreview(statusbar, table, false, 1, 1);
            },
            columns: [
                {
                    width: "250px",
                    dataField: 'name',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Назва",
                    editable: false,
                    cellsrenderer: function () {
                        return (
                            '<div class="ps-25">Приклад тексту</div>'
                        );
                    }
                },
                {
                    minwidth: "250px",
                    dataField: 'count',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Кількість",
                    editable: false,
                    cellsrenderer: function () {
                        return (
                            '<div class="ps-25">Приклад тексту</div>'
                        );
                    }
                },
                ...columns,
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
                        let button =
                            '<button style="padding:0" class="btn btn-table-cell" type="button" data-bs-toggle="popover"> <img src="' +
                            window.location.origin +
                            '/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/menu_dots_vertical.svg" alt="menu_dots_vertical"> </button>';

                        return (
                            '<div class="jqx-popover-wrapper">' +
                            button +
                            "</div>"
                        );
                    },
                },
            ],
        });

        var grid2 = table2.jqxGrid({
            theme: "light-wms",
            width: "100%",
            autoheight: true,
            pageable: true,
            pagerRenderer: function () {
                return pagerRendererSkuPreview(table);
            },
            ready() {
                checkUrl();
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
            filtermode: "default",
            localization: getLocalization("uk"),
            selectionMode: "multiplerowsextended",
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

                var filterinfo = table.jqxGrid("getfilterinformation")[
                    columnindex
                    ];

                // Disable filtering for the "Name" column
                if (filterinfo != null && filterinfo.filter != null) {
                    filterinfo.filter.setlogic("and");
                    filterinfo.filter.setoperator(0);
                    filterinfo.filter.setvalue("");
                }
            },
            rendertoolbar: function (statusbar) {
                return toolbarRendererSkuPreview(statusbar, table, 1, 1);
            },
            columns: [
                {
                    width: "250px",
                    dataField: 'name',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Назва",
                    editable: false,
                    cellsrenderer: function () {
                        return (
                            '<div class="ps-25">Приклад тексту</div>'
                        );
                    }
                },
                {
                    minwidth: "250px",
                    dataField: 'count',
                    align: 'left',
                    cellsalign: 'right',
                    text: "Кількість",
                    editable: false,
                    cellsrenderer: function () {
                        return (
                            '<div class="ps-25">Приклад тексту</div>'
                        );
                    }
                },
                ...columns,
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
                        let button =
                            '<button style="padding:0" class="btn btn-table-cell" type="button" data-bs-toggle="popover"> <img src="' +
                            window.location.origin +
                            '/assets/libs/jqwidget/jqwidgets/styles/images/castom-light-wms/menu_dots_vertical.svg" alt="menu_dots_vertical"> </button>';

                        return (
                            '<div class="jqx-popover-wrapper">' +
                            button +
                            "</div>"
                        );
                    },
                },
            ],
        });

    });
});
