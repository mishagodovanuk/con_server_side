let csrf = document.querySelector('meta[name="csrf-token"]').content;
let url = window.location.origin
let days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
let graphic = {}, conditions = []

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
    let pathArray = window.location.pathname.split('/');
    let formData2 = new FormData()
    formData2.append('_token', csrf)
    formData2.append('graphic', JSON.stringify(graphic))
    formData2.append('conditions', JSON.stringify(conditions))

    function redirect() {
        window.location.replace(url + '/warehouse/' + pathArray[pathArray.length - 1]);
    }

    sendRequest('/warehouse/schedule/update/' + pathArray[pathArray.length - 1], formData2, null, redirect)
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
    dateBlockWrapper.className = "d-flex flex-wrap gap-1";
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
        dateTo.innerHTML = conditionsEntity.date_from
        dateBlockWrapperDate.append("(", dateFrom, ' - ', dateTo, ")")
    }
    dateBlock.append(dateBlockWrapper)

    let conditionNameBlock = document.createElement('div');
    let conditionName = document.createElement('span')
    conditionName.className = 'float-end f-15 fw-bold'
    conditionName.id = 'condition_' + id
    conditionName.innerHTML = conditionsEntity.name
    conditionNameBlock.append(conditionName)
    //recordBlock.append(conditionNameBlock)
    dateBlockWrapper.append(conditionNameBlock)


    dateBlockWrapper.append(dateBlockWrapperDate)
    timeBlock.append(dateBlockWrapper)

    if (conditionsEntity.hasOwnProperty('work_from') && conditionsEntity.hasOwnProperty('work_to')) {
        let outerBlock = document.createElement('div')
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
    btnBlock.className = 'col-2 row mx-0 align-self-center'
    let btnEdit = document.createElement('button');
    let btnDelete = document.createElement('button');
    btnDelete.className = 'btn p-0 delete-condition w-50'
    btnDelete.id = 'delete-condition-' + id
    btnDelete.onclick = deleteCondition
    btnDelete.setAttribute('data-condition', id)
    let deleteImage = document.createElement('img');
    deleteImage.src = url + '/assets/icons/delete.svg'
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
    let id = conditions.length - 1
    let recordBlock = document.createElement('div')
    recordBlock.className = 'record row mx-0 mt-1'
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
    let conditionsEntity = {}
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

    // console.log('conditionsEntity', conditionsEntity)
    conditions.push(conditionsEntity)
    createRecord(conditionsEntity)
    clearPopUp()
    // console.log("conditions",conditions)
})

$('#edit_condition_submit').on('click', function () {
    let condition_id = $('#edit-modal').attr('data-condition')

    let conditionsEntity = {}
    conditionsEntity['name'] = $('#edit_condition_name').val()
    conditionsEntity['period'] = $('input[name=edit_select_period]:checked').val()
    conditionsEntity['type_id'] = $('#edit_condition_name').find("option:selected").data('id')
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
    insertDOM(recordBlock, conditionsEntity, condition_id)
    clearUpdatePopUp()
    conditions[condition_id] = conditionsEntity
})

$('.cancel-btn').on('click', function () {
    $('.modal').modal('hide')
    clearPopUp()
    clearUpdatePopUp()
});

function editCondition(condition_id) {
    $('#edit-modal').attr('data-condition', condition_id)
    let conditionsEntity = conditions[condition_id]
    let period = conditionsEntity.date_to ? 'period' : 'one_day'
    $('#edit_condition_name').val(exceptionsArray[conditionsEntity.type_id]).trigger('change')
    $("input[name='edit_select_period'][value='" + period + "']").prop("checked", true).trigger('change')
    if (period === 'period') {
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

    if (conditionsEntity.work_from && conditionsEntity.work_to) {
        $('#edit_work_from').val(conditionsEntity.work_from)
        $('#edit_work_to').val(conditionsEntity.work_to)
    }
    if (conditionsEntity.break_from && conditionsEntity.break_to) {
        $('#edit_break_from').val(conditionsEntity.break_from)
        $('#edit_break_to').val(conditionsEntity.break_to)
    }

    $('#edit-modal').modal('toggle');

}

function deleteCondition(condition_id) {
    conditions.splice(condition_id, 1)
    $('#record_' + condition_id).remove()
}

$('#condition_name').on('change', function () {
    if ($(this).find(':selected').val() != null) {
        $('#condition_submit').prop('disabled', false)
    }
})

$('#edit-modal')[0].addEventListener('hidden.bs.modal', function () {
    clearUpdatePopUp()
});
