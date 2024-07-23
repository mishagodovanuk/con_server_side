// custom popover
export function setCustomPopover() {
    $(".pop-parent").hover(
        function () {
            // Показати .pop-child при наведенні курсору
            $(".overflow-cont-tns").css("overflow-y", "visible");
            $(this)
                .find(".pop-child")
                .css({ opacity: 1, pointerEvents: "auto" });
        },
        function () {
            // Приховати .pop-child при знятті курсору
            $(this)
                .find(".pop-child")
                .css({ opacity: 0, pointerEvents: "none" });
            $(".overflow-cont-tns").css("overflow-y", "auto");
        }
    );
}