export   function setActiveTab() {
    var $pressedElements = $(".jqx-fill-state-pressed");
    $(".alert").removeClass("alert-active-tab");

    $pressedElements.each(function () {
        var $this = $(this);
        var $alertElement = $this.find(".alert");
        $alertElement.addClass("alert-active-tab");
    });
}