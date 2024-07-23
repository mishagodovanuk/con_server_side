$(function hideCreateBookmarkWindow() {
    $("#create-bookmark").hide();
});

$(function bookmarksCloseButton() {
    $(".bookmarks").on("click", function () {
        $("#create-bookmark").hide();
        $("#body-wrapper").show();
    });
});

$(function showCreateBookmarkWindow() {
    $("#create-btn").on("click", function () {
        $("#body-wrapper").hide();
        $("#create-bookmark").show();
    });
});

$(function showBookmarksListWindow() {
    $("#cancel-btn").on("click", function () {
        $("#create-bookmark").hide();
        $("#body-wrapper").show();
    });
});

$(function disabledAddButoon() {
    $("#add-bookmark").attr("disabled", true);
    $("#bookmarkInput").on("input", function () {
        if ($(this).val().trim() !== "") {
            $("#add-bookmark").attr("disabled", false);
        } else {
            $("#add-bookmark").attr("disabled", true);
        }
    });
});

$(function findListItem() {
    $("#searchBar").on("input", function () {
        const searchValue = $(this).val().toLowerCase();
        $("#list li").each(function () {
            const listItemText = $(this).find("a").text().toLowerCase();
            if (listItemText.includes(searchValue)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});

function checkUrl() {
    if (window.location.search.includes("bookmark")) {
        const urlParams = new URLSearchParams(window.location.search);
        let key = urlParams.get("bookmark");
        $.ajax({
            url: window.location.origin + "/bookmark/find-by-key/" + key,
            success: function (data, textStatus, xhr) {
                if (data[0].properties) {
                    let table = $("#" + data[0].html_id);
                    let key = "jqxGrid" + data[0].html_id;
                    let state = JSON.parse(data[0].properties);
                    table.jqxGrid("loadstate", state);
                    listbox(table, createListsource(state.columns), '', state.columns);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("Something wrong");
            },
        });
    }
}

$(function () {
    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    $("#add-bookmark").on("click", addBookmark);
    $("#list").on("click", "li button", deleteListItem);

    function addBookmark() {
        let bookmarkName = $("#bookmarkInput").val();
        // console.log(bookmarkName);
        let bookmarkKey = generate_url(bookmarkName);
        let bookmarkKeyArray = getBookmarkArray();
        if (bookmarkKeyArray && bookmarkKeyArray.includes(bookmarkKey)) {
            alert("Спробуйте ввести іншу назву");
        } else {
            let table = $(".table-block");
            let html_id = null;
            let properties = null;
            if (table.length) {
                html_id = table[0].id;
                properties = JSON.stringify(
                    $("#" + html_id).jqxGrid("getstate")
                );
            }

            $.post(window.location.origin + "/bookmark", {
                _token: csrf,
                name: bookmarkName,
                key: bookmarkKey,
                html_id: html_id,
                properties: properties,
                page_uri: window.location.pathname,
            })
                .done(function (msg) {
                    const newListItem = $("<li>")
                        .html('<a href="#">' + bookmarkName + "</a>").css('line-height', '32px')
                        .addClass("list-item w-100");
                    const deleteBtn = $("<button>")
                        .html("<img src=" + window.location.origin + "/assets/icons/delete-button.svg>"
                        )
                        .addClass("delete-btn");
                    newListItem.append(deleteBtn);
                    $("#list").append(newListItem);
                    $("#noItemsMsg").hide();
                    $("#bookmarkInput").val("");
                    $("#add-bookmark").attr("disabled", true);
                    $("#body-wrapper").show();
                    $("#create-bookmark").hide();
                    $(".list-item a").css('width', '100%');
                })
                .fail(function (xhr, status, error) {
                    alert("Спробуйте змінити назву");
                });
        }
    }

    function deleteListItem() {
        // console.log($(this).parent()[0].firstChild);
        let bookmarkKey = generate_url(
            $(this).parent()[0].firstElementChild.innerHTML
        );
        $.post(window.location.origin + "/bookmark/delete", {
            _token: csrf,
            key: bookmarkKey,
        });
        $(this).parent().remove();
        if ($("#list li").length === 0) {
            $("#noItemsMsg").show();
        }
    }

    function getBookmarkArray() {
        let list = document.getElementById("list").getElementsByTagName("li");
        let bookmarkArray = [];
        for (let key = 0; key < list.length; key++) {
            bookmarkArray.push(
                generate_url(list[key].firstElementChild.innerHTML)
            );
        }
        return bookmarkArray;
    }

    function generate_url(str) {
        // console.log(str);
        var url = str.replace(/[\s]+/gi, "-");
        url = translit(url);
        url = url.replace(/[^0-9a-z_\-]+/gi, "").toLowerCase();
        return url;
    }

    function translit(str) {
        var cyrillic =
            "А-а-Б-б-В-в-Ґ-ґ-Г-г-Д-д-Е-е-Ё-ё-Є-є-Ж-ж-З-з-И-и-І-і-Ї-ї-Й-й-К-к-Л-л-М-м-Н-н-О-о-П-п-Р-р-С-с-Т-т-У-у-Ф-ф-Х-х-Ц-ц-Ч-ч-Ш-ш-Щ-щ-Ъ-ъ-Ы-ы-Ь-ь-Э-э-Ю-ю-Я-я".split(
                "-"
            );
        var en =
            "A-a-B-b-V-v-G-g-G-g-D-d-E-e-E-e-E-e-ZH-zh-Z-z-I-i-I-i-I-i-J-j-K-k-L-l-M-m-N-n-O-o-P-p-R-r-S-s-T-t-U-u-F-f-H-h-TS-ts-CH-ch-SH-sh-SCH-sch-'-'-Y-y-'-'-E-e-YU-yu-YA-ya".split(
                "-"
            );
        var res = "";
        for (var i = 0, l = str.length; i < l; i++) {
            var s = str.charAt(i),
                n = cyrillic.indexOf(s);
            if (n >= 0) {
                res += en[n];
            } else {
                res += s;
            }
        }
        return res;
    }
});


document.addEventListener('DOMContentLoaded', function () {
    var offcanvasElement = document.getElementById('offcanvasEnd');
    var offcanvasToggleLink = document.getElementById('offCanvasToggleLink');

    offcanvasToggleLink.addEventListener('click', function () {
        this.classList.toggle('nav-img-bookmarks-active');
    });

    offcanvasElement.addEventListener('hidden.bs.offcanvas', function () {
        offcanvasToggleLink.classList.remove('nav-img-bookmarks-active');
    });
});

function createListsource(settingsObj) {
    const settingsArray = [];
    for (const key in settingsObj) {
        if (settingsObj.hasOwnProperty(key)) {
            const setting = settingsObj[key];
            if (setting.text) {
                settingsArray.push({
                    label: setting.text,
                    value: key,
                    checked: !setting.hidden
                });
            }
        }
    }
    return settingsArray;
}

function listbox(table, listSource, idListBox = '', objColumns) {
    const listBoxContainer = document.getElementById(`jqxlistbox${idListBox}`);
    listBoxContainer.style.width = '400px';
    listBoxContainer.style.height = '350px';
    listBoxContainer.style.overflow = 'auto';

    listSource.forEach((item, index) => {
        const listItem = document.createElement('div');
        listItem.classList.add('custom-list-item');
        listItem.style.height = '42px';
        listItem.style.display = 'flex';
        listItem.style.justifyContent = 'space-between';
        listItem.style.alignItems = 'center';
        listItem.style.padding = '0 20px';

        const checkboxContainer = document.createElement('div');
        checkboxContainer.style.display = 'flex';
        checkboxContainer.style.alignItems = 'center';

        const checkbox = document.createElement('input');
        checkbox.classList.add('checkbox-castom-listbox', 'form-check-input');
        checkbox.type = 'checkbox';
        checkbox.checked = item.checked;

        const label = document.createElement('span');
        label.textContent = listSource[index].label;
        label.style.marginLeft = '10px';
        label.classList.add("fw-bold")

        const pinButton = document.createElement('button');
        pinButton.classList.add('btn', 'pinButton');
        pinButton.style.padding = '0';

        const pinIcon = document.createElement('img');
        pinIcon.classList.add('pinIcon');
        pinIcon.src = item.pinned ? '/assets/icons/pined.svg' : '/assets/icons/unpined.svg';
        pinIcon.alt = 'pined';

        pinButton.appendChild(pinIcon);
        checkboxContainer.appendChild(checkbox);
        checkboxContainer.appendChild(label);
        listItem.appendChild(checkboxContainer);
        listItem.appendChild(pinButton);
        listBoxContainer.appendChild(listItem);

        checkbox.addEventListener('click', function (event) {
            listSource[index].checked = this.checked;
            table.jqxGrid('beginUpdate');
            if (this.checked) {
                table.jqxGrid('showColumn', listSource[index].value);
            } else {
                table.jqxGrid('hideColumn', listSource[index].value);
            }
            table.jqxGrid('endUpdate');
        });

        pinButton.addEventListener('click', function (event) {
            listSource[index].pinned = !listSource[index].pinned;
            this.classList.toggle('pinned', listSource[index].pinned);
            pinIcon.src = listSource[index].pinned ? '/assets/icons/pined.svg' : '/assets/icons/unpined.svg';
            listItem.classList.toggle('pinned', listSource[index].pinned);

            const column = table.jqxGrid('getcolumn', listSource[index].value);
            column.pinned = listSource[index].pinned ? 'left' : '';

            table.jqxGrid('beginUpdate');
            // if (listSource[index].checked) {
            //     if (listSource[index].pinned) {
            //         table.jqxGrid('showColumn', column.datafield);
            //     } else {
            //         table.jqxGrid('hideColumn', column.datafield);
            //     }
            // }
            table.jqxGrid('endUpdate');
        });

        for (const key in objColumns) {
            if (objColumns.hasOwnProperty(key) && objColumns[key].pinned === "left" && key === listSource[index].value) {
                listSource[index].pinned = true;
                listItem.classList.add('pinned');
                pinIcon.src = '/assets/icons/pined.svg';
                break;
            }
        }
    });
}

