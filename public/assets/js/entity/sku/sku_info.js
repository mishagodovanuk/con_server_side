(function () {

    $("#tabs #schedule-tab").on("click", function () {
        $("#change-button-for-tabs #button_paking").css("display", "block");
        $("#change-button-for-tabs #button_bar_code").css("display", "none");
    });

    $("#tabs #code-tab").on("click", function () {
        $("#change-button-for-tabs #button_paking").css("display", "none");
        $("#change-button-for-tabs #button_bar_code").css("display", "block");
    });

    $('.edit_package_button').on('click', function () {
        let package_id = $(this).attr('data-id');
        $('#update-package').attr('action',window.location.origin+'/sku/package/'+package_id)
        let number = $('#package-number-' + package_id)[0].innerHTML;
        $('#edit_number_packing').val(number);
        $('#edit_packing_type > option[value="'+package_id+'"]').attr('selected', 'selected').trigger('change')
    })

    $('.edit_barcode_button').on('click',function () {
        let barcode_id = $(this).attr('data-id');
        $('#update-barcode').attr('action',window.location.origin+'/sku/barcode/'+barcode_id)
        $('#edit_barcode').val($('#barcode-'+barcode_id)[0].innerHTML)
    })

    $('#package_submit').on('click',function () {
        $('.modal').modal('hide')
    })

    $('#create_barcode').on('click',function () {
        $('.modal').modal('hide')
    })

    $('.cancel-btn').on('click', function () {
        $('.modal').modal('hide')
    });

    $('#edit_condition_submit').on('click',function () {
        $('.modal').modal('hide')
    })
    
    $('#edit_condition_barcode_submit').on('click',function () {
        $('.modal').modal('hide')
    })

})();



$(document).ready(function() {
    $('input[name="add_number_packing"], input[name="add_weight_packing"]').on('input', function() {
  
      var numberPacking = parseFloat($('input[name="add_number_packing"]').val());
      var weightPacking = parseFloat($('input[name="add_weight_packing"]').val());
  
      if (!isNaN(numberPacking) && !isNaN(weightPacking)) {
        var grossWeight = numberPacking * weightPacking;
        var netWeight = grossWeight - weightPacking;
  
        $('input[name="add_gross_weight"]').val(grossWeight);
        $('input[name="add_net_weight"]').val(netWeight);
      }
    });
  });
  