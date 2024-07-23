$(function() {
    $(".checkbox:checked").each(function() {
      $("#" + $(this).val()).show();
    });
    $(".checkbox").click(function() {
      if ($(this).is(":checked")) {
        $("#checkbox-2-block").show();
        $(".modal-dialog").attr("style", "max-width: 930px!important;");
        $("#condition_submit").attr("disabled", "");
        $("#checkbox-1-block").hide();
      } else {
        $("#checkbox-1-block").show();
        $(".modal-dialog").attr("style", "max-width: 610px!important;");
        $("#condition_submit").removeAttr("disabled", "");

        $("#checkbox-2-block").hide();
      }
    });
  });

  $(".cancel-btn").on("click", function() {
    $(".modal").modal("hide");
  });