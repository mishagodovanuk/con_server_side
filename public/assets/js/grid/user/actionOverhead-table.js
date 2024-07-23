import { pagerRenderer } from "../components/pager.js";
import { toolbarRender } from "../components/toolbar-advanced.js";
import { listbox } from "../components/listbox.js";

const listBoxSetting = listbox.bind({});
const toolbarRendererLeftovers = toolbarRender.bind({});

$(document).ready(function () {
    let table = $("#actionOverhead-table");


    let dataFields = [
        { name: "number", type: "number" },
        { name: "order", type: "string" },
        { name: "idPosition", type: "number" },
        { name: "device", type: "number" },
        { name: "product", type: "string" },
        { name: "amount", type: "number" },
        { name: "weight", type: "number" },
        { name: "cell", type: "string" },
        // { name: "prevCell", type: "string" },
        {name: 'time', type: 'string'}
    ];

      
    var myDataSource = {
        datatype: "array",
        datafields: dataFields,
        localdata: customData,
    };
    let dataAdapter = new $.jqx.dataAdapter(myDataSource);
    var grid = table.jqxGrid({
        theme: "light-wms actionOverhead-table-custom",
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
                1,
                columnCount - 1,
                '-actionOverhead'
            ); // Subtract 1 to exclude the action column
        },
        columns: [

            {
                dataField: "number",
                align: "left",
                cellsalign: "right",
                text: "№",
                width: 100,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary   ps-1  " style="" >${value}</p>`;
                },
            },
            {
                dataField: "order",
                align: "left",
                cellsalign: "right",
                text: "Замовлення",
                minwidth: 110,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<a href="#" class="mb-0 d-flex   ps-1  " style="" >${value}</a>`;
                },
            },
            {
                dataField: "idPosition",
                align: "left",
                cellsalign: "right",
                text: "ID Позації",
                width: 100,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary   ps-1  " style="" >${value}</p>`;
                
                },
            },
            {
                dataField: "device",
                align: "left",
                cellsalign: "right",
                text: "Пристрій",
                width: 100,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary   ps-1  " style="" >${value}</p>`;
                },
            },

            {
                dataField: "product",
                align: "left",
                cellsalign: "right",
                text: "Товар",
                minwidth: 120,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<a href="#" class="mb-0 d-flex   ps-1  " style="" >${value}</a>`;
                },
            },
            {
                dataField: "amount",
                align: "left",
                cellsalign: "right",
                text: "Кількість",
                width: 100,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary   ps-1  " style="" >${value}</p>`;
                },
            },

            {
                dataField: "weight",
                align: "left",
                cellsalign: "right",
                text: "Вага",
                width: 100,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary   ps-1  " style="" >${value}</p>`;
                },
            },

            {
                dataField: "cell",
                align: "left",
                cellsalign: "right",
                text: "Комірка",
                width: 120,
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0 d-flex  text-secondary   ps-1  " style="" >${value}</p>`;
                },
            },

            {
                width: 120,
                dataField: "time",
                align: "left",
                cellsalign: "right",
                text: "Дата і час",
                editable: false,
                cellsrenderer: function (row, column, value, rowData) {
                    return `<p class="mb-0  text-secondary  ps-1  " style="" ><span class="fw-medium-c"> ${value.slice(0,5)}</span> ${value.slice(5)}</p>`;
                },
            },
          
      
       
        ],
    });

    let listSource = [
        { label: "№", value: "number", checked: true },
        { label: "Замовлення", value: "order", checked: true },
        { label: "ID Позації", value: "idPosition", checked: true },
        { label: "Пристрій", value: "device", checked: true },
        { label:  "Товар", value: "product", checked: true },
        { label: "Кількість", value: "amount", checked: true },
        { label: "Вага", value: "weight", checked: true },
        { label: "Комірка", value: "cell", checked: true },
        // { label: "Попередня комірка", value: "prevCell", checked: true },
        { label: "Дата і час", value: "time", checked: true },
    ];

    listBoxSetting(table, listSource,'-actionOverhead');
});




  var customData = [
    {
      number: 228364,
      order: "Прихід ЦБ-000",
      idPosition: 129289,
      device: 228,
      product: 'Chesterwood Cream',
      amount: 48.000,
      weight: 840.000,
      cell: "S00-00-00-00",
    //   prevCell: "S00-00-00-00",
      time: '12:35 13/09/21'
    },
    {
      number: 228365,
      order: "Прихід ЦБ-001",
      idPosition: 129290,
      device: 229,
      product: 'Chesterwood Cream',
      amount: 48.000,
      weight: 840.000,
      cell: "S00-00-00-01",
    //   prevCell: "S00-00-00-01",
      time: '12:40 13/09/21'
    },
    {
      number: 228366,
      order: "Прихід ЦБ-002",
      idPosition: 129291,
      device: 230,
      product: 'Chesterwood Cream',
      amount: 48.000,
      weight: 840.000,
      cell: "S00-00-00-02",
    //   prevCell: "S00-00-00-02",
      time: '12:45 13/09/21'
    },
    {
      number: 228364,
      order: "Прихід ЦБ-000",
      idPosition: 129289,
      device: 228,
      product: 'Chesterwood Cream',
      amount: 48.000,
      weight: 840.000,
      cell: "S00-00-00-00",
    //   prevCell: "S00-00-00-00",
      time: '12:35 13/09/21'
    },
    {
      number: 228365,
      order: "Прихід ЦБ-001",
      idPosition: 129290,
      device: 229,
      product: 'Chesterwood Cream',
      amount: 48.000,
      weight: 840.000,
      cell: "S00-00-00-01",
    //   prevCell: "S00-00-00-01",
      time: '12:40 13/09/21'
    },
    {
      number: 228366,
      order: "Прихід ЦБ-002",
      idPosition: 129291,
      device: 230,
      product: 'Chesterwood Cream',
      amount: 48.000,
      weight: 840.000,
      cell: "S00-00-00-02",
    //   prevCell: "S00-00-00-02",
      time: '12:45 13/09/21'
    },
    {
      number: 228367,
      order: "Прихід ЦБ-003",
      idPosition: 129292,
      device: 231,
      product: 'Chesterwood Cream',
      amount: 48.000,
      weight: 840.000,
      cell: "S00-00-00-03",
    //   prevCell: "S00-00-00-03",
      time: '12:50 13/09/21'
    },
    {
      number: 228368,
      order: "Прихід ЦБ-004",
      idPosition: 129293,
      device: 232,
      product: 'Chesterwood Cream',
      amount: 48.000,
      weight: 840.000,
      cell: "S00-00-00-04",
    //   prevCell: "S00-00-00-04",
      time: '12:55 13/09/21'
    },
    {
      number: 228369,
      order: "Прихід ЦБ-005",
      idPosition: 129294,
      device: 233,
      product: 'Chesterwood Cream',
      amount: 48.000,
      weight: 840.000,
      cell: "S00-00-00-05",
    //   prevCell: "S00-00-00-05",
      time: '13:00 13/09/21'
    },
    {
      number: 228370,
      order: "Прихід ЦБ-006",
      idPosition: 129295,
      device: 234,
      product: 'Chesterwood Cream',
      amount: 48.000,
      weight: 840.000,
      cell: "S00-00-00-06",
    //   prevCell: "S00-00-00-06",
      time: '13:00 13/09/21'
     
    }
,
    {
        number: 228367,
        order: "Прихід ЦБ-003",
        idPosition: 129292,
        device: 231,
        product: 'Chesterwood Cream',
        amount: 48.000,
        weight: 840.000,
        cell: "S00-00-00-03",
      //   prevCell: "S00-00-00-03",
        time: '12:50 13/09/21'
      },
      {
        number: 228368,
        order: "Прихід ЦБ-004",
        idPosition: 129293,
        device: 232,
        product: 'Chesterwood Cream',
        amount: 48.000,
        weight: 840.000,
        cell: "S00-00-00-04",
      //   prevCell: "S00-00-00-04",
        time: '12:55 13/09/21'
      },
    {
      number: 228367,
      order: "Прихід ЦБ-003",
      idPosition: 129292,
      device: 231,
      product: 'Chesterwood Cream',
      amount: 48.000,
      weight: 840.000,
      cell: "S00-00-00-03",
    //   prevCell: "S00-00-00-03",
      time: '12:50 13/09/21'
    },
    {
      number: 228368,
      order: "Прихід ЦБ-004",
      idPosition: 129293,
      device: 232,
      product: 'Chesterwood Cream',
      amount: 48.000,
      weight: 840.000,
      cell: "S00-00-00-04",
    //   prevCell: "S00-00-00-04",
      time: '12:55 13/09/21'
    },
    {
      number: 228369,
      order: "Прихід ЦБ-005",
      idPosition: 129294,
      device: 233,
      product: 'Chesterwood Cream',
      amount: 48.000,
      weight: 840.000,
      cell: "S00-00-00-05",
    //   prevCell: "S00-00-00-05",
      time: '13:00 13/09/21'
    },
    {
      number: 228370,
      order: "Прихід ЦБ-006",
      idPosition: 129295,
      device: 234,
      product: 'Chesterwood Cream',
      amount: 48.000,
      weight: 840.000,
      cell: "S00-00-00-06",
    //   prevCell: "S00-00-00-06",
      time: '13:00 13/09/21'
     
    }
,
    {
        number: 228367,
        order: "Прихід ЦБ-003",
        idPosition: 129292,
        device: 231,
        product: 'Chesterwood Cream',
        amount: 48.000,
        weight: 840.000,
        cell: "S00-00-00-03",
      //   prevCell: "S00-00-00-03",
        time: '12:50 13/09/21'
      },
      {
        number: 228368,
        order: "Прихід ЦБ-004",
        idPosition: 129293,
        device: 232,
        product: 'Chesterwood Cream',
        amount: 48.000,
        weight: 840.000,
        cell: "S00-00-00-04",
      //   prevCell: "S00-00-00-04",
        time: '12:55 13/09/21'
      },
      {
        number: 228369,
        order: "Прихід ЦБ-005",
        idPosition: 129294,
        device: 233,
        product: 'Chesterwood Cream',
        amount: 48.000,
        weight: 840.000,
        cell: "S00-00-00-05",
      //   prevCell: "S00-00-00-05",
        time: '13:00 13/09/21'
      },]