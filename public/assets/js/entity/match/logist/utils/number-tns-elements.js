
// number tns elements in action
export function numberTnsElements() {
    $(".action-with-tns").each(function () {
        var $actionWithTns = $(this);
        var items = $actionWithTns.find('.item-tn-in-action[data-idtn]');
        var seenIdtns = {};
        items.each(function () {
            var idtnValue = $(this).data('idtn');
            if (seenIdtns[idtnValue]) {
                $(this).remove();
            } else {
                seenIdtns[idtnValue] = true;
            }
        });

    
        $actionWithTns.find(".item-tn-in-action").each(function (i) {
            var $numberAction = $(this).find(".number-tn-in-action");
            $numberAction.text(i + 1);
        });
    });
}
