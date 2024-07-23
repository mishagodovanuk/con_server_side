export function listbox(table, listSource, idListBox = '') {
    if (window.location.search.includes("bookmark")) {
        return
    }
    // Функція-рендерер для елементів списку
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

        // Обробник події при зміні стану чекбоксів
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

        // Обробник події при натисканні на кнопку "Pin"
        pinButton.addEventListener('click', function (event) {
            listSource[index].pinned = !listSource[index].pinned;
            this.classList.toggle('pinned', listSource[index].pinned);
            pinIcon.src = listSource[index].pinned ? '/assets/icons/pined.svg' : '/assets/icons/unpined.svg';

            // Змінюємо клас "pinned" тільки для поточного елемента
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
    });
}
