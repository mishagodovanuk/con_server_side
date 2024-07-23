export function selectDictionaries(dictionary) {
    let selectElements;

    if (dictionary) {
        selectElements = document.querySelectorAll(
            "select[id='" + dictionary + "']"
        );
    } else {
        selectElements = document.querySelectorAll("[data-dictionary]");
    }

    if (selectElements.length === 0) {
        return;
    }

    try {
        const promises = Array.from(selectElements).map(async (selectElement) => {
            const dictionaryUrl = selectElement.getAttribute("data-dictionary");
            const parameterUrl =
                dictionaryUrl === "street" || dictionaryUrl === "settlement"
                    ? "/address/"
                    : "/dictionary/";

            const selectedId = selectElement.getAttribute("data-id");

            if (!dictionaryUrl) {
                return;
            }

            const emptyOption = selectElement.querySelector('option[value=""]');
            const url = window.location.origin + parameterUrl + dictionaryUrl;

            const dropdownParentElement = selectElement.closest(
                ".js-modal-form"
            )
                ? $(".js-modal-form")
                : selectElement.closest(".js-modal-form2")
                ? $(".js-modal-form2")
                : undefined;

            const select2Settings = {
                dropdownParent: dropdownParentElement,
                placeholder: "Пошук...",
            };

            select2Settings.ajax = {
                url,
                dataType: "json",
                delay: 0,
                data: (params) => ({ query: params.term }),
                processResults: (data, params) => {
                    params.page = 1;
                    return {
                        results: data.data.map((item) => ({
                            id: item.id,
                            text: item.name,
                        })),
                    };
                },
                cache: true,
            };

            const fetchData = async () => {
                const response = await fetch(url);
                const data = await response.json();
                return data;
            };

            const data = await fetchData();

            $(selectElement).empty();
            if (emptyOption) {
                selectElement.appendChild(emptyOption);
            }

            data.data.forEach((item) => {
                const option = document.createElement("option");
                option.value = item.id;
                option.text = item.name;
                selectElement.appendChild(option);
            });

            $(selectElement).select2(select2Settings);

            if (selectedId) {
                if (!isNumeric(selectedId)) {
                    const parsedIds = JSON.parse(selectedId);
                    if (typeof parsedIds === "string") {
                        const idsArray = JSON.parse(parsedIds);
                        $(selectElement).val(idsArray).trigger("change");
                    } else {
                        $(selectElement).val(parsedIds).trigger("change");
                    }
                } else {
                    const name = await fetchNameOption(url, selectedId);
                    $(selectElement).html(
                        `<option value="${selectedId}" selected>${name}</option>`
                    );
                    $(selectElement).trigger("change");
                }
            }
        });

        return Promise.all(promises);
    } catch (error) {
        console.error("Помилка при отриманні даних: ", error);
    }
}

function isNumeric(str) {
    return !isNaN(str) && !isNaN(parseFloat(str));
}

async function fetchNameOption(url, id) {
    try {
        const response = await fetch(`${url}?id=${id}`);
        const { data } = await response.json();
        return data.name;
    } catch (error) {
        console.error("Помилка при отриманні даних: ", error);
    }
}
