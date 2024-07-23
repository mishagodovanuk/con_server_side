let csrf = document.querySelector('meta[name="csrf-token"]').content;
let url = window.location.origin
let days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
let graphic = {}

updateConditionsUI();
async function sendRequest(uri, formData, selector, callback) {
    fetch(url + uri, {
        method: 'POST',
        body: formData
    }).then(async response => {
        if (response.status === 200) {
            callback && callback()
        } else {
            let data = await response.json()
            appendAlert(selector, 'danger', Object.values(data.errors)[0][0])
        }
    })

}

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

$('#create_user').on('click', function () {
    schedule()
})

$('#graphic_save').on('click', function () {
    schedule()

    if (!$('#pattern').val() && document.getElementById('schedule_pattern').checked) {
        alert('Введіть назву шаблону')
        return
    } else if (document.getElementById('schedule_pattern').checked) {
        let formData = new FormData()
        formData.append('_token', csrf)
        formData.append('name', $('#pattern').val())
        formData.append('schedule', JSON.stringify(graphic))
        sendRequest('/user/create-schedule-pattern', formData)
    }
    let pathArray = window.location.pathname.split('/');
    let formData2 = new FormData()
    formData2.append('_token', csrf)
    formData2.append('graphic', JSON.stringify(graphic))
    formData2.append('conditions', JSON.stringify(conditions))

    function redirect() {
        window.location.replace(url+'/user/show/'+pathArray[pathArray.length - 1]);
    }

    sendRequest('/user/schedule/update/'+pathArray[pathArray.length - 1], formData2, null,redirect)
})

$('#select_pattern').on('change', function () {
    var selectedPattern = $(this).find('option:selected');

    if (selectedPattern.hasClass('graphic-pattern')) {
        var schedule = JSON.parse(selectedPattern.attr('data-pattern'));

        for (var i = 0; i < 7; i++) {
            if (schedule[days[i]] === 'holiday') {
                $('#' + days[i] + '-check')[0].checked = true;
                for (var j = 1; j < 5; j++) {
                    $('#' + days[i] + '-' + j).val('');
                    $('#' + days[i] + '-' + j).prop("disabled", true);
                }
            } else {
                for (var j = 0; j < 4; j++) {
                    $('#' + days[i] + '-' + (j + 1)).val(schedule[days[i]][j]);
                }
            }
        }
    }
});

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
    recordBlock.className =  'record border-bottom pb-1 row mx-0 mt-1'
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
$('#condition_submit').on('click', function () {
    if( checkHoursInSchedule('.two-input-for-schedule-inmodal')) {
        return
    }
    let conditionsEntity = {}
    conditionsEntity['id'] =conditions.length> 0 ?  Math.max(...conditions.map(el => +el.id)) + 1 : 1;
    conditionsEntity['type_id'] = $('#condition_name').find("option:selected").data('id')
    conditionsEntity['name'] = $('#condition_name').val()
    conditionsEntity['period'] = $('input[name=select_period]:checked').val()

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
    if(type_id !==3){
        const { work_from, work_to, break_from, break_to, ...rest } = conditionsEntity;
        conditionsEntity = rest;
    }
    insertDOM(recordBlock, conditionsEntity, condition_id)
    clearUpdatePopUp()
    conditions[foundIndex] = conditionsEntity
  
})

$('.cancel-btn').on('click', function () {
    $('.modal').modal('hide')
    clearPopUp()
    clearUpdatePopUp()
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
        $('.edit_one_day').val(conditionsEntity.date_from)
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
   




function deleteCondition() {
    let condition_id = $(this).attr('data-condition')
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



$('#edit-modal')[0].addEventListener('hidden.bs.modal', function () {
    clearUpdatePopUp()
});

function updateConditionsUI() {
    var conditionsLength = conditions.length;
    var headerElement = $('#card-header-conditions');
    var paragraphElement = headerElement.find('p');
    var blockWithBtn =headerElement.find('div')

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