import { pagerRenderer } from "../components/pager.js";
import { toolbarRender } from "../components/toolbar-advanced.js";
import { listbox } from "../components/listbox.js";
import { hover } from "../components/hover.js";

const pagerRendererLeftovers = pagerRenderer.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});

$(document).ready(function () {
    let table = $("#payment-obligations-table");
    let isRowHovered = false;

    let dataFields = [
        { name: "obligations", type: "string" },
        { name: "type", type: "string" },
        { name: "performer", type: "number" },
        { name: "recipient", type: "string" },
        { name: "date", type: "string" },
        { name: "cost", type: "string" },
        { name: "id", type: "string" },
    ];

    var myDataSource = {
        datatype: "array",
        datafields: dataFields,
        localdata: customData,
    };
    let dataAdapter = new $.jqx.dataAdapter(myDataSource);
    var grid = table.jqxGrid({
        theme: "light-wms sel-payment-oblig-table-custom",
        width: "100%",
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
            checkUrl();
        },
        sortable: true,
        columnsResize: false,
        filterable: true,
        filtermode: "default",
        localization: getLocalization("uk"),
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
                dataField: "obligations",
                align: "left",
                cellsalign: "right",
                text: "№ зобов‘язання",
                editable: false,
                cellsrenderer: function (
                    row,
                    columnfield,
                    value,
                    defaulthtml,
                    columnproperties,
                    rowdata
                ) {
                    return `<a style="" class=" ps-1 d-flex my-auto " href='#' >${value}</a>`;
                },
                width: 140,
            },
         
            {
                dataField: "type",
                align: "left",
                cellsalign: "right",
                text: "Вид послуги",
                minwidth: 200,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class=" text-secondary ps-1  my-auto" style="" >${value}</p>`;
                },
            },
            {
                width: 220,
                dataField: "performer",
                align: "left",
                cellsalign: "right",
                text: "Виконавець",
                editable: false,
                cellsrenderer: function (   row,
                    columnfield,
                    value,
                    defaulthtml,
                    columnproperties,
                    rowdata) {
                        return `<a class="text-secondary text-decoration-underline fw-medium-c  ps-1  my-auto" href='${
                            window.location.origin
                        }/company/${rowdata.id}'  >${value}</a>`;
                },
            },
            {
                minwidth: 100,
                dataField: "recipient",
                align: "left",
                cellsalign: "right",
                text: "Отримувач послуг",
                editable: false,
                cellsrenderer: function (   row,
                    columnfield,
                    value,
                    defaulthtml,
                    columnproperties,
                    rowdata) {
                    return `<a class="text-secondary text-decoration-underline fw-medium-c  ps-1  my-auto" href='${
                        window.location.origin
                    }/company/${rowdata.id}'  >${value}</a>`;
                },
            },
            {
                width: 140,
                dataField: "date",
                align: "left",
                cellsalign: "right",
                text: "Дата надання",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="text-secondary  ps-1  my-auto" style="" >${value}</p>`;
                },
            },
            {
                width: 170,
                dataField: "cost",
                align: "left",
                cellsalign: "right",
                text: "Вартість",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="text-secondary  ps-1  my-auto" style="" >${value} грн</p>`;
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
                                          <li><a class="dropdown-item" href="#">Перегляд ПЗ</a></li>
                                          <li><a class="dropdown-item" href="#">Редагувати ПЗ</a></li>
                                          <li><a class="dropdown-item delete-row" href="#">Видалити ПЗ</a></li>
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
        { label: "Зобов‘язання", value: "obligations", checked: true },
        { label: "Вид послуги", value: "type", checked: true },
        { label: "Виконавець", value: "performer", checked: true },
        { label: "Отримувач послуг", value: "recipient", checked: true },
        { label: "Дата надання", value: "date", checked: true },
        { label: "Вартість без ПДВ", value: "cost", checked: true },
        { label: "Дії", value: "action", checked: true },
    ];

    listbox(table, listSource);
    hover(table, isRowHovered);
});

var customData = [
    {
        obligations: "234234",
        correction: "3",
        type: "Транспортне перевезення",
        performer: "ТОВ Кондитерська Ярич ",
        recipient: "Навігор ТД ТОВ",
        date: "01.05.2023",
        cost: "12 000.00",
        id: '234234'
    },
    {
        obligations: "456456",
        correction: "2",
        type: "Будівельні роботи",
        performer: "ТОВ БудІнвест",
        recipient: "БудІнвест Група",
        date: "15.06.2023",
        cost: "35 000.00",
        id: '456456'
    },
    {
        obligations: "789789",
        correction: "1",
        type: "Інформаційні технології",
        performer: "ТОВ ТехноСервіс",
        recipient: "IT Solutions Inc.",
        date: "10.07.2023",
        cost: "8 500.00",
        id: '789789'
    },
    {
        obligations: "987987",
        correction: "4",
        type: "Консалтингові послуги",
        performer: "ТОВ Консалт",
        recipient: "Глобальні Консалтингові Рішення",
        date: "25.08.2023",
        cost: "20 000.00",
        id: '987987'
    }
];

