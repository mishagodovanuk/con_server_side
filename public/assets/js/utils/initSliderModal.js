$(function () {
    $(".checkbox:checked").each(function () {
        $("#" + $(this).val()).show();
    });
    $(".checkbox").click(function () {
        if ($(this).is(":checked")) {
            $("#" + $(this).val()).show();
        } else {
            $("#" + $(this).val()).hide();
        }
    });
});

var slider1 = document.getElementById("slider-1");

var colorOptions1 = {
    start: [6, 25],
    connect: true,
    behaviour: "drag",

    step: 1,
    tooltips: wNumb({
        decimals: 0,
        suffix: "℃",
    }),
    range: {
        min: 0,
        max: 30,
    },
    pips: {
        mode: "positions",
        values: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
        density: 9,
    },
};

noUiSlider.create(slider1, colorOptions1);

var slider2 = document.getElementById("slider-2");

var colorOptions2 = {
    start: [6, 25],
    connect: true,
    behaviour: "drag",

    step: 1,
    tooltips: wNumb({
        decimals: 0,
        suffix: "%",
    }),
    range: {
        min: 0,
        max: 30,
    },
    pips: {
        mode: "positions",
        values: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
        density: 9,
    },
};

noUiSlider.create(slider2, colorOptions2);
