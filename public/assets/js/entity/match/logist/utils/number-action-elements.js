// number action elements
export function numberActionElements() {
    var $actionWithTns = $(".action-with-tns");

    $actionWithTns.each(function (index) {
        var $numberAction = $(this).find(".number-action");
        $numberAction.text(index + 1);
    });
}