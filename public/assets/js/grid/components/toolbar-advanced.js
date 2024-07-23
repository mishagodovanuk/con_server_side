export function toolbarRender(statusbar, table, simple, searchColumnStart, searchColumnEnd, idSettingEl = "",) {

    // appends buttons to the status bar.
    var container = $("<div style='overflow: hidden; position: relative; display:flex; column-gap: 20px; justify-content: space-between; height: 100%; background-color:#fff; padding: 2.5px 15px 2.5px 20px'></div>");
    var deleteButton = $("<div style='padding:0; background-color: #fff; border: unset; display:flex; align-items:center; justify-content:center'><img src='" + window.location.origin + "/assets/icons/delete-row.svg'/></div>");
    var settingButton = $(`<div style='padding:0; background-color: #fff; border: unset; display:flex; align-items:center; justify-content:center' data-bs-toggle='offcanvas' data-bs-target='#settingTable${idSettingEl}' aria-controls='settingTable'><img class='icon-setting' src='${window.location.origin}/assets/icons/setting.svg'/></div>`);
    var search = $('<div class="input-group input-group-merge"> <button class="input-group-text search-btn"><i data-feather="search"></i></button> <input type="text" class="form-control ps-1" id="search" placeholder="Пошук"/>  </div>');

    var searchTimeout;

    container.append(deleteButton);
    container.append(search);
    container.append(settingButton);

    statusbar.append(container);
    deleteButton.jqxButton();
    settingButton.jqxButton();

    // settingButton.on("click", function (event) {
    //     if (table.hasClass("d-flex")) {
    //         table.removeClass("d-flex");
    //     } else {
    //         table.toggleClass("d-flex");
    //     }
    //     table.jqxGrid('refreshdata');
    //
    // });

    // сховати один з інпутів
    deleteButton.hide();

    // додати обробник події rowselect
    table.on("rowselect", function () {
        // якщо хоча б один рядок вибрано, показати поле input2 і сховати input1
        if (table.jqxGrid("getselectedrowindexes").length > 0) {
            if (simple === true) {
                search.hide();
                deleteButton.show();
            } else {
                search.show();
                deleteButton.hide();
            }

        } else {
            if (simple === false) {
                search.show();
                deleteButton.hide();
            } else {
                search.show();
                deleteButton.hide();
            }
        }
    });

    // додати обробник події rowselect
    table.on("rowunselect", function () {
        // якщо хоча б один рядок вибрано, показати поле input2 і сховати input1
        if (table.jqxGrid("getselectedrowindexes").length === 0) {
            search.show();
            deleteButton.hide();
        }
    });

    function performSearchWithDelay() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performSearch, 500); // Затримка 500 мс перед виконанням пошуку
    }

    function performSearch() {
        var searchValue = $("#search").val();
        if (searchValue.trim() === '' || null) {
            table.jqxGrid('refreshdata');
        }
        //var columns = table.jqxGrid('columns').records.slice(1, 14);
        var columns = table.jqxGrid('columns').records.slice(searchColumnStart, searchColumnEnd);

        $.each(columns, function (index, value) {
            var filtergroup = new $.jqx.filter();
            let filter1 = filtergroup.createfilter('stringfilter', searchValue, 'contains');
            filtergroup.addfilter(1, filter1);
            table.jqxGrid('addfilter', value.datafield, filtergroup, false);
        })
        table.jqxGrid('applyfilters');

        function removeFilterFields() {
            $.each(columns, function (index, value) {
                table.jqxGrid('removefilter', value.datafield, false);
            })
        }

        table.one("bindingcomplete", removeFilterFields)
    }

    // search.keydown(function (e) {
    //     if (e.keyCode == "13") {
    //         performSearch();
    //     }
    // });

    search.find('#search').on('input', function () {
        performSearchWithDelay();
    });

    search.find('.search-btn').click(function () {
        performSearch();
    });


    // delete selected row.
    deleteButton.click(function (event) {
        let selectedrowindexes = table.jqxGrid('getselectedrowindexes');
        let values = {...selectedrowindexes}
        for (let id in values) {
            selectedrowindexes.forEach(function (selectedrowindex) {
                table.jqxGrid('deleterow', values[id]);
            })
        }
    });

}
