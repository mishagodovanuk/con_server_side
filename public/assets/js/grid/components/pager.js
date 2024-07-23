import {getLocalizedText} from  "../../entity/match/localization/getLocalizedText.js";

export function pagerRenderer(table, pageSizeOne = "", pageSizeTwo = "", pageSizeThree = "") {
    var isMobile = window.innerWidth < 991.98 || /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    var pageSize = localStorage.getItem('pageSize') || 10;
    var selectedCount = table.jqxGrid('getselectedrowindexes').length;

    var updateSelectedCount = function () {
        selectedCount = table.jqxGrid('getselectedrowindexes').length;
        $pager.find(".custom-pager-left").html(selectedCount + getLocalizedText('items_selected'));
    };

    table.on('rowselect rowunselect', function () {
        updateSelectedCount();
    });

    var $pager = $("<div class='custom-pager'></div>");
    var $pageSize = $(`<div class='custom-pager-select-size'> <div class='custom-pager-select-text col-auto'>${getLocalizedText('lines_per_page')}:</div> <div class='col-4' > <select class='custom-pager-page-size'> <option value='5'>5</option><option value='10'>10</option><option value='20'>20</option><option value='30'>30</option></select></div></div>`);

    $pageSize.find(".custom-pager-page-size").select2({
        minimumResultsForSearch: Infinity
    });

    $pageSize.find('select').on('change', function (event) {
        var value = event.target.value;
        localStorage.setItem('pageSize', value);
        table.jqxGrid('pagesize', parseInt(value));
    });

    var currentPageSize = table.jqxGrid('pagesize');
    $pageSize.find('select').val(currentPageSize);
    $pageSize.find('select').trigger('change');

    var storedPageSize = localStorage.getItem("pageSize");
    if (storedPageSize) {
        pageSize = parseInt(storedPageSize);
        $pageSize.find("select").val(storedPageSize);
    }

    var $select = $pageSize.find(".custom-pager-page-size");
    var selectedOptionText = $select.find('option:selected').text();
    $select.next().find('.select2-selection__rendered').attr('title', selectedOptionText).text(selectedOptionText);

    window.addEventListener('beforeunload', function () {
        localStorage.removeItem('pageSize');
    });

    var $pageInfo = $("<div class='custom-pager-page-info col-auto '></div>");

    var $firstPageBtn = $("<button style='width: 28px; height: 28px; background: rgba(75, 70, 92, 0.08); border-radius: 4px; padding: 0' class='btn custom-pager-first-page-btn'></button>");
    var $prevBtn = $("<button style='width: 28px; height: 28px; background: rgba(75, 70, 92, 0.08); border-radius: 4px; padding: 0' class='btn custom-pager-prev-btn'></button>");

    var $nextBtn = $("<button style='width: 28px; height: 28px; background: rgba(75, 70, 92, 0.08); border-radius: 4px; padding: 0' class='btn custom-pager-next-btn'></button>");
    var $lastPageBtn = $("<button style='width: 28px; height: 28px; background: rgba(75, 70, 92, 0.08); border-radius: 4px; padding: 0' class='btn custom-pager-last-page-btn'></button>");

    var updatePage = function (page) {
        table.jqxGrid("gotopage", page);
    };

    var updatePageSize = function (size) {
        pageSize = size;
        table.jqxGrid({pagesize: pageSize});
        updatePage(0);
        $pageInfo.html(getPageInfo());
    };

    var getPageInfo = function () {
        var dataInfo = table.jqxGrid("getdatainformation");
        var totalRows = dataInfo.rowscount;
        var currentPage = dataInfo.paginginformation.pagenum + 1;
        var startRow;
        if (dataInfo.rowscount === 0) {
            startRow = (currentPage - 1) * pageSize;
        } else {
            startRow = (currentPage - 1) * pageSize + 1;
        }
        var endRow = Math.min(startRow + pageSize - 1, totalRows);
        return startRow + " - " + endRow + getLocalizedText('from') + totalRows;
    };

    $pageSize.val(pageSize);
    $pageInfo.html(getPageInfo());

    $firstPageBtn.html('<img src="' + window.location.origin + '/assets/icons/chevron-left-w-line.svg" alt="First Page">');
    $prevBtn.html('<img src="' + window.location.origin + '/assets/icons/chevron-left-pager.svg" alt="Previous">');
    $nextBtn.html('<img src="' + window.location.origin + '/assets/icons/chevron-right-pager.svg" alt="Next">');
    $lastPageBtn.html('<img src="' + window.location.origin + '/assets/icons/chevron-right-w-line.svg" alt="Last Page">');

    $firstPageBtn.click(function () {
        updatePage(0);
    });

    $prevBtn.click(function () {
        var currentPage = table.jqxGrid("getpaginginformation").pagenum;
        if (currentPage > 0) {
            updatePage(currentPage - 1);
        }
    });

    $nextBtn.click(function () {
        var totalPages = Math.ceil(table.jqxGrid("getdatainformation").rowscount / pageSize);
        let currentPage = table.jqxGrid("getpaginginformation").pagenum;
        if (currentPage < totalPages - 1) {
            updatePage(currentPage + 1);
        }
    });

    var dataInfo = table.jqxGrid("getdatainformation");
    var totalRows = dataInfo.rowscount;
    var totalPages = Math.ceil(totalRows / pageSize);

    var maxPageButtons = isMobile ? 2 : Math.min(5, totalPages);

    if (totalPages > 1 && totalPages <= maxPageButtons) {
        maxPageButtons = totalPages;
    }

    var startPage = 1;
    if (totalPages > maxPageButtons) {
        var currentPage = dataInfo.paginginformation.pagenum + 1;
        var halfMaxPages = Math.floor(maxPageButtons / 2);
        if (currentPage > halfMaxPages) {
            startPage = currentPage - halfMaxPages;
            if (startPage + maxPageButtons > totalPages) {
                startPage = totalPages - maxPageButtons + 1;
            }
        }
    }

    var $pageNumbers = $("<div class='custom-pager-page-numbers' style='display: flex; column-gap: 2px'></div>");
    var hasHiddenPagesBefore = startPage > 1;
    var hasHiddenPagesAfter = totalPages > startPage + maxPageButtons - 1;

    var $ellipsisBefore = $("<button style='width: 28px; height: 28px; background: rgba(75, 70, 92, 0.08); border-radius: 4px; padding: 0; font-weight: normal' class='btn custom-pager-page-btn'>...</button>");
    var $ellipsisAfter = $("<button style='width: 28px; height: 28px; background: rgba(75, 70, 92, 0.08); border-radius: 4px; padding: 0; font-weight: normal' class='btn custom-pager-page-btn'>...</button>");

    $ellipsisBefore.click(function () {
        updatePage(startPage - 2);
    });

    $ellipsisAfter.click(function () {
        updatePage(startPage + maxPageButtons - 1);
    });

    if (!hasHiddenPagesBefore) {
        $firstPageBtn.addClass('d-none');
        $ellipsisBefore.addClass('d-none');
    }

    if (!hasHiddenPagesAfter) {
        $lastPageBtn.addClass('d-none');
        $ellipsisAfter.addClass('d-none');
    }

    for (var i = startPage; i <= Math.min(startPage + maxPageButtons - 1, totalPages); i++) {
        var $pageButton = $("<button style='width: 28px; height: 28px; background: rgba(75, 70, 92, 0.08); border-radius: 4px; padding: 0; font-weight: normal' class='btn custom-pager-page-btn'>" + i + "</button>");
        $pageButton.click(function () {
            var pageNum = $(this).text();
            updatePage(pageNum - 1);
        });
        $pageNumbers.append($pageButton);
    }

    $lastPageBtn.click(function () {
        var totalPages = Math.ceil(table.jqxGrid("getdatainformation").rowscount / pageSize);
        updatePage(totalPages - 1);
    });

    var currentPageActive = table.jqxGrid("getpaginginformation").pagenum;
    $pageNumbers.find('.custom-pager-page-btn').removeClass('custom-pager-page-btn-active');
    $pageNumbers.find('.custom-pager-page-btn').eq(currentPageActive).addClass('custom-pager-page-btn-active');

    var totalPagesPager = Math.ceil(table.jqxGrid("getdatainformation").rowscount / pageSize) - 1;

    table.on('bindingcomplete', function () {
        const rowsToHide = [];
        const $dataTable = table;
        const $rows = $dataTable.find('div[role="row"]');

        $rows.each(function () {
            const $cells = $(this).find('div[role="gridcell"]');
            const $emptyCells = $(this).find('div[role="gridcell"]:not(:has(*)):not(:has(>br))');

            if ($emptyCells.length === $cells.length) {
                const rowId = parseInt($(this).attr('row-id'));
                rowsToHide.push(rowId);
            }
        });

        function toggleRows() {
            rowsToHide.forEach(function (index) {
                const $row = $dataTable.find('#row' + index + 'usersDataTable');
                if (currentPageActive === totalPagesPager) {
                    $row.addClass('d-none');
                } else {
                    $row.removeClass('d-none');
                }
            });
        }

        if (pageSize == 10 || storedPageSize == 10 || pageSize == 20 || storedPageSize == 20 || pageSize == 30 || storedPageSize == 30) {
            toggleRows();
        }
    });

    $pager.append("<div class='custom-pager-left' style='overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>" + selectedCount + getLocalizedText('items_selected')+"</div>");
    $pager.append("<div class='custom-pager-center' style='display: flex; column-gap: 2px; align-items: center'></div>");
    $pager.find(".custom-pager-center").append($pageSize);
    $pager.find(".custom-pager-center").append($pageInfo);
    $pager.find(".custom-pager-center").append($firstPageBtn);
    $pager.find(".custom-pager-center").append($prevBtn);

    if (hasHiddenPagesBefore) {
        $pager.find(".custom-pager-center").append($ellipsisBefore);
    }

    $pager.find(".custom-pager-center").append($pageNumbers);

    if (hasHiddenPagesAfter) {
        $pager.find(".custom-pager-center").append($ellipsisAfter);
    }

    $pager.find(".custom-pager-center").append($nextBtn);
    $pager.find(".custom-pager-center").append($lastPageBtn);

    if (isMobile) {
        $pager.find(".custom-pager-page-info").addClass('d-none');
    }

    return $pager;
}

