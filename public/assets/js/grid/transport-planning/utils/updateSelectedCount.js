export function updateSelectedCount(tableOneSel, tableTwoSel, selectorOne, selectorTwo) {

    var selectedCount = tableOneSel.jqxGrid('getselectedrowindexes').length;
    var selectedCount2 = tableTwoSel.jqxGrid('getselectedrowindexes').length;

    selectorTwo.text("Додати " + selectedCount2);

    //console.log(selectedCount)
    if (selectedCount > 0) {
        if (selectedCount2 > 0) {
            tableTwoSel.jqxGrid('clearselection');
        }
        selectorOne.removeAttr("disabled")
        selectorOne.text("Додати " + selectedCount);
        selectorTwo.text("Додати");
    } else if (selectedCount <= 0) {
        selectorOne.attr("disabled", "")
    } else if (selectedCount2 > 0) {
        if (selectedCount > 0) {
            tableOneSel.jqxGrid('clearselection');
        }
        selectorTwo.removeAttr("disabled")
        selectorOne.text("Додати");
        selectorTwo.text("Додати" + selectedCount2);
    } else if (selectedCount2 <= 0) {
        selectorTwo.attr("disabled", "")
    }
}

