import { pagerRenderer } from "../components/pager.js";
import { toolbarRender } from "../components/toolbar-advanced.js";
import { listbox } from "../components/listbox.js";

const listBoxSetting = listbox.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});

$(document).ready(function () {
    let table = $("#sessions-table");


    let dataFields = [
        { name: "status", type: "string" },
        { name: "start", type: "string" },
        { name: "end", type: "string" },
        { name: "device", type: "number" },
        { name: "actionOverheads", type: "number" },
        { name: "actionCells", type: "string" },

    ];


    var myDataSource = {
        datatype: "array",
        datafields: dataFields,
        localdata: customData,
    };
    let dataAdapter = new $.jqx.dataAdapter(myDataSource);
    var grid = table.jqxGrid({
        theme: "light-wms sessions-table-custom",
        width: "100%",
        autoheight: true,
        // pageable: true,
        source: dataAdapter,
        // pagerRenderer: function () {
        //     return pagerRendererLeftovers(table);
        // },
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
        // selectionMode: "checkbox",
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
            //console.log(columns)
            //console.log(columnCount)
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
                dataField: "status",
                align: "left",
                cellsalign: "right",
                text: "Статус",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p style="" class=" my-auto ps-1 ${value === "Активно"? 'text-success' : 'text-danger'}" >${value}</p>`;
                },
                minwidth: 160,
            },
            {
                dataField: "start",
                align: "left",
                cellsalign: "right",
                text: "Старт",
                minwidth: 160,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0  text-secondary  ps-1  " style="" ><span class="fw-medium-c"> ${value.slice(0,5)}</span> ${value.slice(5)}</p>`;
                },
            },
            {
                width: 180,
                dataField: "end",
                align: "left",
                cellsalign: "right",
                text: "Завершення",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0  text-secondary  ps-1  " style="" ><span class="fw-medium-c"> ${value.slice(0,5)}</span> ${value.slice(5)}</p>`;
                },
            },
            {
                width: 180,
                dataField: "device",
                align: "left",
                cellsalign: "right",
                text: "Пристрій",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary   ps-1  " style="" >${value}</p>`;
                },
            },
            {
                width: 180,
                dataField: "actionOverheads",
                align: "left",
                cellsalign: "right",
                text: "Дії з накладними",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary   ps-1 " style="" >${value}</p>`;
                },
            },
            {
                width: 180,
                dataField: "actionCells",
                align: "left",
                cellsalign: "right",
                text: "Дії з комірками",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary  ps-1   " style="" >${value}</p>`;
                },
            },


        ],
    });

    let listSource = [
        { label: "Статус", value: "status", checked: true },
        { label: "Старт", value: "start", checked: true },
        { label: "Завершення", value: "end", checked: true },
        { label: "Пристрій", value: "device", checked: true },
        { label: "Дії з накладними", value: "actionOverheads", checked: true },
        { label: "Дії з комірками", value: "actionCells", checked: true },
    ];

    listBoxSetting(table, listSource);
});



var customData = [
    {
      status: "Активно",
      start: "9:06 21.11.22.",
      end: "-",
      device: 110,
      actionOverheads: 9,
      actionCells: "12 (60 kg)"
    },
    {
        status: "Завершено",
        start: "9:06 21.11.22.",
        end: "9:06 21.11.22.",
        device: 105,
        actionOverheads: 3,
        actionCells: "5 (30 kg)"
      },
      {
        status: "Завершено",
        start: "9:06 21.11.22.",
        end: "9:06 21.11.22.",
        device: 105,
        actionOverheads: 3,
        actionCells: "5 (30 kg)"
      },
      {
        status: "Завершено",
        start: "9:06 21.11.22.",
        end: "9:06 21.11.22.",
        device: 105,
        actionOverheads: 3,
        actionCells: "5 (30 kg)"
      },
      {
        status: "Активно",
        start: "9:06 21.11.22.",
        end: "-",
        device: 110,
        actionOverheads: 9,
        actionCells: "12 (60 kg)"
      },
      {
        status: "Завершено",
        start: "9:06 21.11.22.",
        end: "9:06 21.11.22.",
        device: 105,
        actionOverheads: 3,
        actionCells: "5 (30 kg)"
      },
      {
        status: "Завершено",
        start: "9:06 21.11.22.",
        end: "9:06 21.11.22.",
        device: 105,
        actionOverheads: 3,
        actionCells: "5 (30 kg)"
      },
      {
        status: "Завершено",
        start: "9:06 21.11.22.",
        end: "9:06 21.11.22.",
        device: 105,
        actionOverheads: 3,
        actionCells: "5 (30 kg)"
      },
      {
        status: "Завершено",
        start: "9:06 21.11.22.",
        end: "9:06 21.11.22.",
        device: 105,
        actionOverheads: 3,
        actionCells: "5 (30 kg)"
      },
      {
        status: "Завершено",
        start: "9:06 21.11.22.",
        end: "9:06 21.11.22.",
        device: 105,
        actionOverheads: 3,
        actionCells: "5 (30 kg)"
      },
  ];


