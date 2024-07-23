// заповнення селектів діями
export function fillSelect(selectId, data) {
    const select = $(selectId);
    select.empty();
    select.append($("<option>", { value: "", text: "" }));
    data.forEach((item) => {
        select.append($("<option>", { value: item.id, text: item.address }));
    });
}