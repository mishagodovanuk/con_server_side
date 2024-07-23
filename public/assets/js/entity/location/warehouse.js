$((function () {
    // console.log('conditions :', conditions)
    updateConditionsUI();
    let currentPage = 0
    let csrf = document.querySelector('meta[name="csrf-token"]').content;
    let url = window.location.origin
    let days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']

    let name = '', country = '', settlement = '',
        building_number = '', street = '',
        user = '', company = '', type = '',
        graphic = {}, warehouse_erp = '', addition_to_address


    for (let i = 0; i < 7; i++) {
        $('#' + days[i] + '-check').on('click', function () {
            if ($('#' + days[i] + '-check')[0].checked) {
                for (let j = 1; j < 5; j++) {
                    $('#' + days[i] + '-' + j).val('')
                    $('#' + days[i] + '-' + j).prop("disabled", true)
                }
            } else {
                for (let j = 1; j < 5; j++) {
                    $('#' + days[i] + '-' + j).prop("disabled", false)
                }
            }
        })
    }


    async function sendRequest(uri, formData, selector, callback) {
        fetch(url + uri, {
            method: 'POST',
            body: formData
        }).then(async response => {
            if (response.status === 200) {
                callback && callback()
            } else {
                let data = await response.json()
                appendAlert(selector, 'danger', Object.values(data.errors)[0])

            }
        })

    }

    function appendAlert(selector, type, message) {
        $(selector)[0].innerHTML = null
        let block = document.createElement('div')
        block.className = 'alert alert-' + type + ' alert-dismissible fade show'
        block.setAttribute('role', 'alert')
        block.innerHTML = message
        let innerBtn = document.createElement('div')
        innerBtn.setAttribute('type', 'button')
        innerBtn.setAttribute('data-bs-dismiss', 'alert')
        innerBtn.setAttribute('aria-label', 'Close')
        innerBtn.className = 'close'
        block.append(innerBtn)
        let span = document.createElement('span')
        span.setAttribute('aria-hidden', 'true')
        span.innerHTML = "&times;"
        innerBtn.append(span)
        $(selector).append(block)
    }

    $(".previous-step").on("click", (function () {
        if (currentPage === 1) {
            $(".previous-step-title").css("display", "none");
            stepBack();
        } else if (currentPage === 2) {
            stepBack();
            $("#create").css("display", "none");
            $("#next_step").css("display", "block");
            window.dispatchEvent(new Event('resize'));
        }
    }))

    $("#next_step").on("click", async function () {
        if (currentPage === 0) {
            let callback = function () {
                $(".previous-step-title").css("display", "none");
                // $("#next_step").attr('disabled', true)
                nextStep();
                window.dispatchEvent(new Event('resize'));
            }
            $('#main-data-message').css("display", "block").delay(5000).slideUp(300);

            validateMainData(callback)
            setTimeout(function() {
                $("#map-input").blur();
            }, 500);
        } else if (currentPage === 1) {
            nextStep();
            $("#create").css("display", "block");
            $("#next_step").css("display", "none");
        }
    });

    function validateMainData(callback) {
        name = $('#name').val()
        country = $('#country').val()
        settlement = $('#settlement').val()
        building_number = $('#building_number').val()
        street = $('#street').val()
        user = $('#user').val()
        company = $('#company').val()
        type = $('#type').val()
        warehouse_erp = $('#erp-warehouse').val()
        addition_to_address = $('#address_hint').val()


        let formData = new FormData()
        formData.append('_token', csrf)
        formData.append('name', name)
        formData.append('country', country)
        formData.append('settlement', settlement)
        formData.append('street', street)
        formData.append('building_number', building_number)
        formData.append('user', user)
        formData.append('company', company)
        formData.append('type', type)
        formData.append('warehouse_erp', warehouse_erp)
        formData.append('addition_to_address', addition_to_address)
        sendRequest('/validate/warehouse/main-data', formData, '#main-data-message', callback)

    }

    function stepBack() {
        $('.create-user-step')[currentPage].classList.add('user-step-disabled')
        $('#block_' + parseInt(currentPage + 1)).css('display', 'none')
        currentPage--
        $('.create-user-step')[currentPage].classList.remove('user-step-confirmed')
        $('#block_' + parseInt(currentPage + 1)).css('display', 'flex')
    }

    function nextStep() {
        $('.previous-step-title').css('display', 'flex')
        $('.create-user-step')[currentPage].classList.add('user-step-confirmed')
        $('#block_' + parseInt(currentPage + 1)).css('display', 'none')
        currentPage++
        $('.create-user-step')[currentPage].classList.remove('user-step-disabled')
        $('#block_' + parseInt(currentPage + 1)).css('display', 'flex')
    }

    $("input[name='select_period']").change(function () {
        if ($(this).val() === 'one_day') {
            $('#one_day').css('display', 'flex')
            $('#period').css('display', 'none')
            $('.date-1').val('')
            $('.date-2').val('')
        } else {
            $('#period').css('display', 'flex')
            $('#one_day').css('display', 'none')
            $('.one_day').val('')
        }

    });

    function schedule() {
        for (let i = 0; i < 7; i++) {
            if ($('#' + days[i] + '-check')[0].checked) {
                graphic[days[i]] = 'holiday'
            } else {
                let graphicArray = []
                for (let j = 0; j < 4; j++) {
                    graphicArray[j] = $('#' + days[i] + '-' + (j + 1)).val()

                }
                graphic[days[i]] = graphicArray
            }

        }
    }

    function insertDOM(recordBlock, conditionsEntity, id) {
        let timeBlock = document.createElement('div');
        timeBlock.className = 'col-10'
        let dateBlock = document.createElement('div');
        let dateBlockWrapper = document.createElement('div')
        dateBlockWrapper.className = "d-flex flex-wrap";
        let beforeDateBlockWrapperDate = document.createElement('div');
        beforeDateBlockWrapperDate.className = "d-flex align-items-center mb-1";
        let imgCalendar = document.createElement('img');
        imgCalendar.src = url + '/assets/icons/calendar-chosen.svg';
        imgCalendar.style.marginRight = "5px";
        beforeDateBlockWrapperDate.append(imgCalendar)
        let dateBlockWrapperDate = document.createElement('div')
        if (conditionsEntity.period === 'one_day') {
            let span = document.createElement('span')
            span.className = 'f-15'
            span.id = 'date_' + id
            span.innerHTML = conditionsEntity.date_from
            dateBlockWrapperDate.append(span)
        } else {
            let dateFrom = document.createElement('span')
            dateFrom.className = 'f-15'
            dateFrom.id = 'date_from_' + id
            dateFrom.innerHTML = conditionsEntity.date_from
            let dateTo = document.createElement('span')
            dateTo.className = 'f-15'
            dateTo.id = 'date_from_' + id
            dateTo.innerHTML = conditionsEntity.date_to
            dateBlockWrapperDate.append(dateFrom, ' - ', dateTo)
        }
        dateBlock.append(dateBlockWrapper)

        let conditionNameBlock = document.createElement('div');
        conditionNameBlock.className = 'w-100';
        conditionNameBlock.style.marginBottom = '5px';
        let conditionName = document.createElement('span')
        conditionName.className = 'f-15 fw-bold'
        conditionName.id = 'condition_' + id
        conditionName.innerHTML = conditionsEntity.name
        conditionNameBlock.append(conditionName)
        //recordBlock.append(conditionNameBlock)
        dateBlockWrapper.append(conditionNameBlock)

        beforeDateBlockWrapperDate.append(dateBlockWrapperDate)
        dateBlockWrapper.append(beforeDateBlockWrapperDate)
        timeBlock.append(dateBlockWrapper)

        if (conditionsEntity.hasOwnProperty('work_from') && conditionsEntity.hasOwnProperty('work_to')) {
            let outerBlock = document.createElement('div')
            outerBlock.style.marginBottom="4px"
            let workFrom = document.createElement('span')
            workFrom.className = 'hours f-15'
            workFrom.id = 'work_from_' + id
            workFrom.innerHTML = conditionsEntity.work_from
            let workTo = document.createElement('span')
            workTo.className = 'hours f-15 '
            workTo.id = 'work_to_' + id
            workTo.innerHTML = conditionsEntity.work_to
            outerBlock.innerHTML = 'Робочий день: '
            outerBlock.append(workFrom, '-', workTo)
            timeBlock.append(outerBlock)
        }
        if (conditionsEntity.hasOwnProperty('break_from') && conditionsEntity.hasOwnProperty('break_to')) {
            let outerBreakBlock = document.createElement('div')
            let breakFrom = document.createElement('span')
            breakFrom.className = 'hours f-15'
            breakFrom.id = 'break_from_' + id
            breakFrom.innerHTML = conditionsEntity.break_from
            let breakTo = document.createElement('span')
            breakTo.className = 'hours f-15'
            breakTo.id = 'break_to_' + id
            breakTo.innerHTML = conditionsEntity.break_to
            outerBreakBlock.innerHTML = 'Обід: '
            outerBreakBlock.append(breakFrom, '-', breakTo)
            timeBlock.append(outerBreakBlock)
        }
        recordBlock.append(timeBlock)


        let btnBlock = document.createElement('div');
        btnBlock.className = 'col-2 row mx-0 align-self-start ps-0'
        let btnEdit = document.createElement('button');
        let btnDelete = document.createElement('button');
        btnDelete.className = 'btn p-0 delete-condition w-50'
        btnDelete.id = 'delete-condition-' + id
        btnDelete.onclick = deleteCondition
        btnDelete.setAttribute('data-condition', id)
        let deleteImage = document.createElement('img');
        deleteImage.src = url + '/assets/icons/deleteGrey.svg'
        btnDelete.append(deleteImage)
        btnEdit.className = 'btn p-0 edit-condition w-50'
        btnEdit.id = 'edit-condition-' + id
        btnEdit.onclick = editCondition
        btnEdit.setAttribute('data-condition', id)
        let editImage = document.createElement('img');
        editImage.src = url + '/assets/icons/edit.svg'
        btnEdit.append(editImage)
        btnBlock.append(btnEdit, btnDelete)
        recordBlock.append(btnBlock)
        $('#condition-list').append(recordBlock)

    }

    function createRecord(conditionsEntity) {
        let id = conditionsEntity.id;
        let recordBlock = document.createElement('div')
        recordBlock.className = 'record border-bottom pb-1  row mx-0 mt-1'
        recordBlock.id = 'record_' + id
        insertDOM(recordBlock, conditionsEntity, id)
    }

    function clearPopUp() {
        $('#condition_name').val('Не вказано')
        $("#work_from").val('')
        $("#work_to").val('')
        $("#break_from").val('')
        $("#break_to").val('')
        $('input[name="one_day"]').val('')
        $('#date-1').val('')
        $('#date-2').val('')
        $('.modal').modal('hide')
        $('#condition_submit').prop('disabled', true)
        $('#condition_name').val(null).trigger('change')
    }

    $('#condition_submit').on('click', function () {
        if( checkHoursInSchedule('.two-input-for-schedule-inmodal')) {
            return
        }
        let conditionsEntity = {}
        conditionsEntity['id'] =conditions.length> 0 ?  Math.max(...conditions.map(el => +el.id)) + 1 : 1;
        conditionsEntity['name'] = $('#condition_name').val()
        conditionsEntity['period'] = $('input[name=select_period]:checked').val()
        conditionsEntity['type_id'] = $('#condition_name').find("option:selected").data('id')
        if ($("#work_from").val() && $("#work_to").val()) {
            conditionsEntity['work_from'] = $("#work_from").val()
            conditionsEntity['work_to'] = $("#work_to").val()
        }

        if ($("#break_from").val() && $("#break_to").val()) {
            conditionsEntity['break_from'] = $("#break_from").val()
            conditionsEntity['break_to'] = $("#break_to").val()
        }

        if (conditionsEntity['period'] === 'one_day') {
            conditionsEntity['date_from'] = $('input[name="one_day"]').val()
        } else {
            conditionsEntity['date_from'] = $('#date-1').val()
            conditionsEntity['date_to'] = $('#date-2').val()
        }

        conditions.push(conditionsEntity)

        createRecord(conditionsEntity)
        clearPopUp()
        updateConditionsUI();
    })

    $('#edit_condition_submit').on('click', function () {
        if( checkHoursInSchedule('.two-input-for-schedule-inmodal')) {
            return
        }
        let condition_id = $('#edit-modal').attr('data-condition')
        const foundIndex = conditions.findIndex(el => el.id == condition_id)

        let conditionsEntity = conditions[foundIndex]

        conditionsEntity['id'] = +condition_id;
        let name = $('#edit_condition_name').val()
        conditionsEntity['name'] = name
        conditionsEntity['period'] = $('input[name=edit_select_period]:checked').val()
        let type_id= $('#edit_condition_name').find("option:selected").data('id')
        conditionsEntity['type_id'] = type_id
        conditionsEntity['type'] ={id:type_id, name }
        if ($("#edit_work_from").val() && $("#edit_work_to").val()) {
            conditionsEntity['work_from'] = $("#edit_work_from").val()
            conditionsEntity['work_to'] = $("#edit_work_to").val()
        }

        if ($("#edit_break_from").val() && $("#edit_break_to").val()) {
            conditionsEntity['break_from'] = $("#edit_break_from").val()
            conditionsEntity['break_to'] = $("#edit_break_to").val()
        }

        if (conditionsEntity['period'] === 'one_day') {
            conditionsEntity['date_from'] = $('input[name="edit_one_day"]').val()
        } else {
            conditionsEntity['date_from'] = $('#edit_date-1').val()
            conditionsEntity['date_to'] = $('#edit_date-2').val()
        }
        let recordBlock = $('#record_' + condition_id)
        recordBlock.empty()
        clearUpdatePopUp()
        if(type_id !==3){
            const { work_from, work_to, break_from, break_to, ...rest } = conditionsEntity;
            conditionsEntity = rest;
        }
        insertDOM(recordBlock, conditionsEntity, condition_id)
        $('.modal').modal('hide')

        conditions[foundIndex] = conditionsEntity

    })

    function clearUpdatePopUp() {
        $("#edit_work_from").val('')
        $("#edit_work_to").val('')
        $("#edit_break_from").val('')
        $("#edit_break_to").val('')
        $('input[name="edit_one_day"]').val('')
        $('#edit_date-1').val('')
        $('#edit_date-2').val('')
        $('.modal').modal('hide')
    }

    $('.cancel-btn').on('click', function () {
        $('.modal').modal('hide')
        clearPopUp()
        clearUpdatePopUp()
    });

    $("input[name='edit_select_period']").change(function () {
        if ($(this).val() === 'one_day') {
            $('#edit_one_day').css('display', 'flex')
            $('#edit_period').css('display', 'none')
            $('.edit_date-1').val('')
            $('.edit_date-2').val('')
        } else {
            $('#edit_period').css('display', 'flex')
            $('#edit_one_day').css('display', 'none')
            $('.edit_one_day').val('')
        }

    });

    function editCondition() {
        let condition_id = $(this).attr('data-condition')
        $('#edit-modal').attr('data-condition', condition_id)
        let conditionsEntity = conditions.find(el=> el.id==condition_id)

        $('#edit_condition_name').val(conditionsEntity.name).trigger('change')
        $("input[name='edit_select_period'][value='" + conditionsEntity.period + "']").prop("checked", true)

        if (conditionsEntity.period === 'period') {
            $('#edit_period').css('display', 'flex')
            $('#edit_one_day').css('display', 'none')
            $('.edit_one_day').val('')
            $("#edit_date-1").val(conditionsEntity.date_from)
            $("#edit_date-2").val(conditionsEntity.date_to)
        } else {
            $('#edit_one_day').css('display', 'flex')
            $('#edit_period').css('display', 'none')
            $('#edit_date-1').val('')
            $('#edit_date-2').val('')
            $(".edit_one_day").val(conditionsEntity.date_from)
        }

        if (conditionsEntity.hasOwnProperty('work_from') && conditionsEntity.hasOwnProperty('work_to')) {
            $('#edit_work_from').val(conditionsEntity.work_from)
            $('#edit_work_to').val(conditionsEntity.work_to)
        }
        if (conditionsEntity.hasOwnProperty('break_from') && conditionsEntity.hasOwnProperty('break_to')) {
            $('#edit_break_from').val(conditionsEntity.break_from)
            $('#edit_break_to').val(conditionsEntity.break_to)
        }

        $('#edit-modal').modal('toggle');
    }

    function editConditionBack() {
              let condition_id = $(this).attr('data-condition')

              $('#edit-modal').attr('data-condition', condition_id)
              let conditionsEntity = conditions.find(el=> el.id==condition_id)

              $('#edit_condition_name').val(conditionsEntity.type.name);
      $('#edit_condition_name').trigger('change');

              const {date_from,date_to}= conditionsEntity
              if ( date_from && date_to) {
                $("input[name='edit_select_period'][value='" +'period'+ "']").prop("checked", true)
                  $('#edit_period').css('display', 'flex')
                  $('#edit_one_day').css('display', 'none')
                  $('.edit_one_day').val('')
                  $("#edit_date-1").val(date_from)
                  $("#edit_date-2").val(date_to)
              } else {
                $("input[name='edit_select_period'][value='" +'one_day'+ "']").prop("checked", true)
                  $('#edit_one_day').css('display', 'flex')
                  $('#edit_period').css('display', 'none')
                  $('#edit_date-1').val('')
                  $('#edit_date-2').val('')
                  $(".edit_one_day").val(date_from)
              }

              if (conditionsEntity.hasOwnProperty('work_from') && conditionsEntity.hasOwnProperty('work_to')) {
                  $('#edit_work_from').val(conditionsEntity.work_from)
                  $('#edit_work_to').val(conditionsEntity.work_to)
              }
              if (conditionsEntity.hasOwnProperty('break_from') && conditionsEntity.hasOwnProperty('break_to')) {
                  $('#edit_break_from').val(conditionsEntity.break_from)
                  $('#edit_break_to').val(conditionsEntity.break_to)
              }

              $('#edit-modal').modal('toggle');
          }
    $('.edit-condition-back').on('click', (event) => {
        editConditionBack.call(event.currentTarget);
    });

    $('.edit-condition').on('click', function () {
        editCondition()
    })

    function deleteCondition() {
        let condition_id = $(this).attr('data-condition')
        const foundIndex = conditions.findIndex(el => el.id == condition_id)
        conditions.splice(foundIndex, 1)
        $('#record_' + condition_id).remove()
        updateConditionsUI();

    }
    $('.delete-condition-back').on('click', function (e) {
        deleteConditionBack.bind(this)();


    })

    function deleteConditionBack() {
        const btn= $(this)[0];
        let condition_id = $(btn).attr('data-condition')
        const foundIndex = conditions.findIndex(el => el.id == condition_id)

        conditions.splice(foundIndex, 1)
        $('#record_' + condition_id).remove()
        updateConditionsUI();

    }

    $('.delete-condition').on('click', function () {
        deleteCondition()


    })

    $('#condition_name').on('change', function() {
        var oneDayInput = $('#one_day input');
        var periodInputs = $('#period input');

        if (oneDayInput.val() !== '' || (periodInputs.eq(0).val() !== '' && periodInputs.eq(1).val() !== '')) {
            $('#condition_submit').prop('disabled', false);
        } else {
            $('#condition_submit').prop('disabled', true)
        }

      });

      $('#one_day input, #period input').on('change', function() {
        var conditionName = $('#condition_name');
        var oneDayInput = $('#one_day input');
        var periodInputs = $('#period input');

        if (conditionName.val() !== '' && (oneDayInput.val() !== '' || (periodInputs.eq(0).val() !== '' && periodInputs.eq(1).val() !== ''))) {
            $('#condition_submit').prop('disabled', false)
        }
        else {
            $('#condition_submit').prop('disabled', true)
        }

      });


    $('#create').on('click', function () {
        if( checkHoursInSchedule('.two-input-for-schedule')) {
            return
        }
        schedule()
        if (!graphic) {
            alert("Графік обов'язковий до заповнення")
        }

        if (!$('#pattern').val() && document.getElementById('schedule_pattern').checked) {
            alert('Введіть назву шаблону')
        } else if (document.getElementById('schedule_pattern').checked) {
            let formData = new FormData()
            formData.append('_token', csrf)
            formData.append('name', $('#pattern').val())
            formData.append('schedule', JSON.stringify(graphic))
            formData.append('type','warehouse')
            sendRequest('/user/create-schedule-pattern', formData)
        }

        let formData = new FormData()
        formData.append('_token', csrf)
        formData.append('conditions', JSON.stringify(conditions))
        formData.append('graphic', JSON.stringify(graphic))
        formData.append('name', name)
        formData.append('warehouse_erp', warehouse_erp)
        formData.append('country', country)
        formData.append('settlement', settlement)
        formData.append('street', street)
        formData.append('building_number', building_number)
        formData.append('user', user)
        formData.append('company', company)
        formData.append('type', type)
        formData.append('coordinates', JSON.stringify(coordinates))
        formData.append('addition_to_address', addition_to_address)
        function redirect() {
            window.location.replace(url + '/warehouse');
        }

        sendRequest('/warehouse', formData, null, redirect)
    })

    $('#update').on('click', function () {
        if( checkHoursInSchedule('.two-input-for-schedule')) {
            return
        }
        let warehouseID = $('#edit-card').attr('data-id')

        schedule()
        if (!graphic) {
            alert("Графік обов'язковий до заповнення")
        }

        if (!$('#pattern').val() && document.getElementById('schedule_pattern').checked) {
            alert('Введіть назву шаблону')
        } else if (document.getElementById('schedule_pattern').checked) {
            let formData = new FormData()
            formData.append('_token', csrf)
            formData.append('name', $('#pattern').val())
            formData.append('schedule', JSON.stringify(graphic))
            formData.append('type','warehouse')
            sendRequest('/user/create-schedule-pattern', formData)
        }

        let formData = new FormData()
        formData.append('_method', 'PUT')
        formData.append('_token', csrf)
        formData.append('conditions', JSON.stringify(conditions))
        formData.append('graphic', JSON.stringify(graphic))
        formData.append('name', $('#name').val())
        formData.append('warehouse_erp',$('#erp-warehouse').val())
        formData.append('country', $('#country').val())
        formData.append('settlement', $('#settlement').val())
        formData.append('street',  $('#street').val())
        formData.append('building_number',$('#building_number').val())
        formData.append('user', $('#user').val())
        formData.append('company', $('#company').val())
        formData.append('type', $('#type').val())
        formData.append('coordinates', JSON.stringify(coordinates))
        formData.append('addition_to_address', addition_to_address)

        function redirect() {
            window.location.replace(url + '/warehouse/' + warehouseID);
        }

        sendRequest('/warehouse/' + warehouseID, formData, '#main-data-message', redirect)
    })


    $('#edit-modal')[0].addEventListener('hidden.bs.modal', function () {
        clearUpdatePopUp()
    });


    function updateConditionsUI() {
        var conditionsLength = conditions.length;
        var headerElement = $('#card-header-conditions');
        var paragraphElement = headerElement.find('p');
        var blockWithBtn =  headerElement.find('div')


        if (conditionsLength > 0) {
            headerElement.removeClass('d-flex flex-column align-items-center my-auto gap-2');
            headerElement.addClass('card-header row');
            paragraphElement.addClass('d-none');
            blockWithBtn.addClass("col-2");
        } else {
            headerElement.removeClass('card-header row');
            headerElement.addClass('d-flex flex-column align-items-center my-auto gap-2');
            paragraphElement.removeClass('d-none');
            blockWithBtn.removeClass("col-2");
        }
        // console.log('conditions: ', conditions);
    }


    function checkHoursInSchedule (blockClass){
        let errorMessageShown = false;
        let hasErrors = false;
        $(blockClass).each(function() {
            const block = $(this);
            const inputs = block.find('input');

                if (parseInt(inputs.eq(0).val()) >= parseInt(inputs.eq(1).val()) && inputs.eq(0).val()!=="" && inputs.eq(1).val()!=="") {
                        inputs.eq(0).addClass('border-error');
                        inputs.eq(1).addClass('border-error');
                        if (!errorMessageShown) {
                            alert("Введені години в графіку не можуть бути однакові, або від‘ємні! ");
                            errorMessageShown = true;
                        }
                    hasErrors = true;}
            });
            return hasErrors;
    }

    $('.two-input-for-schedule-inmodal').each(function() {
        const inputs = $(this).find('input');


        inputs.eq(0).on('input', function() {
            if (parseInt(inputs.eq(0).val()) < parseInt(inputs.eq(1).val())) {
                inputs.eq(0).removeClass('border-error');
                        inputs.eq(1).removeClass('border-error');
            }
        });

        inputs.eq(1).on('input', function() {
            if (parseInt(inputs.eq(0).val()) < parseInt(inputs.eq(1).val())) {
                inputs.eq(0).removeClass('border-error');
                inputs.eq(1).removeClass('border-error');
            }
        });
    });
    $('.two-input-for-schedule').each(function() {
        const inputs = $(this).find('input');


        inputs.eq(0).on('input', function() {
            if (parseInt(inputs.eq(0).val()) < parseInt(inputs.eq(1).val())) {
                inputs.eq(0).removeClass('border-error');
                        inputs.eq(1).removeClass('border-error');
            }
        });

        inputs.eq(1).on('input', function() {
            if (parseInt(inputs.eq(0).val()) < parseInt(inputs.eq(1).val())) {
                inputs.eq(0).removeClass('border-error');
                inputs.eq(1).removeClass('border-error');
            }
        });
    });



}))(coordinates)


