@switch($field['type'])
    @case('date')
        <li class="group ui-draggable ui-draggable-handle" data-system="0"
            style="z-index: 1000; width: 163.949px; height: 61.641px;">
            <div class="accordion-header ui-accordion-header mb-0 bg-white"
                 data-type="date">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-start">
                        <img class="pe-1"
                             src="{{asset('/assets/icons/create-type/calendar-event.svg')}}">
                        <p class="system-title m-0"
                           data-key="date_field">{{$field['name']}}</p></div>
                    <div class="d-flex" id="header-badge">
                        <div>
                            @if($field['required'])
                                <span
                                    class="badge badge-light-secondary mx-2 d-none"
                                    id="field-badge-required">Обовʼязкове</span>
                            @endif
                        </div>
                        <div><img id="accordion-chevron" width="16px"
                                  src="{{asset('/assets/icons/chevron-right.svg')}}"
                                  alt="chevron"></div>
                    </div>
                    <div class="removeButtonBaseField" id="removeButton"><img
                            src="{{asset('/assets/icons/close-field-base.svg')}}"
                            alt="close-field-base"></div>
                </div>
            </div>
            <div class="document-field-accordion-body d-none"
                 id="field-accordion-body">
                <div class="document-field-accordion-body-form">
                    <div class="mb-1">
                        <div class="js-validate-titleInput text-danger mb-1 d-none">Заповніть назву поля</div>

                        <label class="form-label"
                               for="titleInput_0_date">Назва
                            поля</label>
                        <input id="titleInput_0_date"
                               class="form-control" type="text"
                               placeholder="Назва поля приклад"
                               value="{{$field['name']}}"></div>
                    <div class="mb-1"><label class="form-label"
                                             for="descInput_0_date">Підказка</label><input
                            id="descInput_0_date" class="form-control"
                            type="text"
                            placeholder="Поясніть як користувачі можуть використовувати це поле"
                            value="{{$field['hint']}}">
                    </div>
                </div>
                <hr>
                <div
                    class="document-field-accordion-body-footer d-flex align-items-center justify-content-end">
                    <div class="form-check form-check-warning pe-1"><input
                            type="checkbox" class="form-check-input"
                            id="requiredCheck_0_date"><label
                            class="form-check-label"
                            for="requiredCheck_0_date" {{$field['required'] ? 'checked' : ''}}>Обов'язкове</label>
                    </div>
                    <div class="">
                        <button type="button" id="removeButton_0_date"
                                class="btn btn-flat-danger d-flex align-items-center">
                            <img class="trash-red"
                                 src="{{asset('/assets/icons/trash-red2.svg')}}"><span>Видалити</span>
                        </button>
                    </div>
                </div>
            </div>
        </li>
        @break
    @case('text')
        <li class="group ui-draggable ui-draggable-handle" data-system="0"
            style="z-index: 1000; width: 192.923px; height: 61.641px;">
            <div class="accordion-header ui-accordion-header mb-0 bg-white"
                 data-type="text">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-start">
                        <img class="pe-1"
                             src="{{asset('/assets/icons/create-type/letter-case.svg')}}">
                        <p class="system-title m-0"
                           data-key="text_field">{{$field['name']}}</p></div>
                    <div class="d-flex" id="header-badge">

                        <div>
                            @if($field['required'])
                                <span
                                    class="badge badge-light-secondary mx-2 d-none"
                                    id="field-badge-required">Обовʼязкове</span>
                            @endif
                        </div>

                        <div><img id="accordion-chevron" width="16px"
                                  src="{{asset('/assets/icons/chevron-right.svg')}}"
                                  alt="chevron"></div>
                    </div>
                    <div class="removeButtonBaseField" id="removeButton"><img
                            src="{{asset('/assets/icons/close-field-base.svg')}}"
                            alt="close-field-base"></div>
                </div>
            </div>
            <div class="document-field-accordion-body d-none"
                 id="field-accordion-body">
                <div class="document-field-accordion-body-form">
                    <div class="mb-1">
                        <div class="js-validate-titleInput text-danger mb-1 d-none">Заповніть назву поля</div>
                        <label class="form-label"
                               for="titleInput_0_text">Назва
                            поля</label><input id="titleInput_0_text"
                                               class="form-control" type="text"
                                               placeholder="Назва поля приклад"
                                               value="{{$field['name']}}"></div>
                    <div class="mb-1"><label class="form-label"
                                             for="descInput_0_text">Підказка</label><input
                            id="descInput_0_text" class="form-control"
                            type="text"
                            placeholder="Поясніть як користувачі можуть використовувати це поле"
                            value="{{$field['hint']}}">
                    </div>
                </div>
                <hr>
                <div
                    class="document-field-accordion-body-footer d-flex align-items-center justify-content-end">
                    <div class="form-check form-check-warning pe-1"><input
                            type="checkbox" class="form-check-input"
                            id="requiredCheck_0_text" {{$field['required'] ? 'checked' : ''}}><label
                            class="form-check-label" for="requiredCheck_0_text">Обов'язкове</label>
                    </div>
                    <div class="">
                        <button type="button" id="removeButton_0_text"
                                class="btn btn-flat-danger d-flex align-items-center">
                            <img class="trash-red"
                                 src="{{asset('/assets/icons/trash-red2.svg')}}"><span>Видалити</span>
                        </button>
                    </div>
                </div>
            </div>
        </li>
        @break
    @case('select')
        <li class="group ui-draggable ui-draggable-handle" data-id="{{$field['id']}}" data-system="0"
            style="z-index: 1000; width: 184.167px; height: 61.641px;">
            <div class="accordion-header ui-accordion-header mb-0 bg-white"
                 data-type="select">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-start">
                        <img class="pe-1"
                             src="{{asset('/assets/icons/create-type/arrow-down-circle.svg')}}">
                        <p class="system-title m-0"
                           data-key="select_field">{{$field['name']}}</p></div>
                    <div class="d-flex" id="header-badge">
                        <div>
                            @if($field['required'])
                                <span
                                    class="badge badge-light-secondary mx-2 d-none"
                                    id="field-badge-required">Обовʼязкове</span>
                            @endif</div>
                        <div><img id="accordion-chevron" width="16px"
                                  src="{{asset('/assets/icons/chevron-right.svg')}}"
                                  alt="chevron" class=""></div>
                    </div>
                    <div class="removeButtonBaseField" id="removeButton"><img
                            src="{{asset('/assets/icons/close-field-base.svg')}}"
                            alt="close-field-base"></div>
                </div>
            </div>
            <div class="document-field-accordion-body d-none"
                 id="field-accordion-body">
                <div class="document-field-accordion-body-form">
                    <div class="mb-1">
                        <div class="js-validate-titleInput text-danger mb-1 d-none">Заповніть назву поля</div>

                        <label class="form-label"
                               for="titleInput_0_select">Назва
                            поля</label><input id="titleInput_0_select"
                                               class="form-control" type="text"
                                               placeholder="Назва поля приклад"
                                               value="{{$field['name']}}"></div>
                    <div class="mb-1"><label class="form-label"
                                             for="descInput_0_select">Підказка</label><input
                            id="descInput_0_select" class="form-control"
                            type="text"
                            placeholder="Поясніть як користувачі можуть використовувати це поле"
                            value="{{$field['hint']}}">
                    </div>

                    <div class="js-validate-directorySelect text-danger mb-1 d-none">Оберіть довідник в полі</div>


                    <div class="blockDataParam_{{$field['id']}}">
                        <div id="directoryBlock_{{$field['id']}}"
                             class="mb-1 {{$field['directory'] === null && isset($field['data']) !== null  ? 'd-none': ''}}">

                            <label class="form-label"
                                   for="directorySelect_{{$field['directory']}}_select_{{$field['id']}}">Довідник</label>
                            <select
                                class="select2 form-select"
                                id="directorySelect_{{$field['directory']}}_select_{{$field['id']}}"
                                data-placeholder="Виберіть довідник для цього селекту">
                                @foreach(\App\Helpers\DictionaryList::list() as $key=>$dictionary)
                                    <option
                                        value="{{$key}}" {{$field['directory'] == $key ? 'selected' : ''}}>
                                        {{$dictionary}}</option>
                                @endforeach

                            </select>
                            <button id="parameterBtnShow_{{$field['id']}}" class="btn text-primary mt-1">
                                Додати власні опції
                            </button>
                        </div>

                        <div id="parameterBlock_{{$field['id']}}"
                             class="mb-1 {{isset($field['data']) !== null && $field['directory'] === null ? '': 'd-none'}}">
                            <label class="form-label" for="inputParameter">Параметр</label>
                            <div class="d-flex row mx-0" style="gap: 16px">
                                <div class="col-9 px-0">
                                    <input id="inputParameter_{{$field['id']}}" class="form-control" type="text"
                                           placeholder="Вкажіть параметр"/>
                                </div>

                                <button id="addItemParameter_{{$field['id']}}"
                                        class="btn btn-outline-primary flex-grow-1 col-2 text-primary">
                                    Додати
                                </button>
                            </div>
                            <ul class="parameter-list_{{$field['id']}} p-0 col-9">
                                @if (isset($field['data']))
                                    @foreach($field['data'] as $li => $data)
                                        {{--                                    <script>--}}
                                        {{--                                        console.log(<?php echo json_encode($data); ?>); // Output the value of $data to the console--}}
                                        {{--                                    </script>--}}
                                        <li class="parameter-item" data-value="{{$data[0]['name']}}"
                                            data-checked="{{$data[0]['is_checked']}}">
                                            <div class="parameter-item-title">
                                                <img
                                                    src="{{asset('/assets/icons/grip-vertical.svg')}}"> {{$data[0]['name']}}
                                            </div>
                                            <div class='removeButtonBaseFieldParam align-items-center'>
                                                <div
                                                    class="js-input-parameter {{$data[0]['is_checked'] ? 'checked-js-input-parameter' : ''}}">
                                                    <div class="form-check form-check-warning pe-1">
                                                        <input type="radio" class="form-check-input"
                                                               id="{{$data[0]['name']}}"
                                                            {{$data[0]['is_checked'] ? 'checked' : ''}}>
                                                        <label class="form-check-label" for="{{$data[0]['name']}}">За
                                                            замовчуванням</label>
                                                    </div>
                                                </div>
                                                <div class="removeButtonParemeters_{{$li}}">
                                                    <img src="{{asset('/assets/icons/close-field-base.svg')}}"
                                                         alt='close-field-base'>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif

                            </ul>

                            <button id="addItemInDirectory_{{$field['id']}}" class="btn text-primary">Додати довідник
                            </button>

                        </div>
                    </div>
                </div>
                <hr>
                <div
                    class="document-field-accordion-body-footer d-flex align-items-center justify-content-end">
                    <div class="form-check form-check-warning pe-1"><input
                            type="checkbox" class="form-check-input"
                            id="requiredCheck_0_select"><label
                            class="form-check-label"
                            for="requiredCheck_0_select" {{$field['required'] ? 'checked' : ''}}>Обов'язкове</label>
                    </div>
                    <div class="">
                        <button type="button" id="removeButton_0_select"
                                class="btn btn-flat-danger d-flex align-items-center">
                            <img class="trash-red"
                                 src="{{asset('/assets/icons/trash-red2.svg')}}"><span>Видалити</span>
                        </button>
                    </div>
                </div>
            </div>
        </li>
        @break
    @case('label')
        <li class="group ui-draggable ui-draggable-handle" data-system="0"
            style="z-index: 1000; width: 194.526px; height: 61.641px;">
            <div class="accordion-header ui-accordion-header mb-0 bg-white"
                 data-type="label">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-start">
                        <img class="pe-1"
                             src="{{asset('/assets/icons/create-type/label.svg')}}">
                        <p class="system-title m-0"
                           data-key="label_field">{{$field['name']}}</p></div>
                    <div class="d-flex" id="header-badge">
                        <div>
                            @if($field['required'])
                                <span
                                    class="badge badge-light-secondary mx-2 d-none"
                                    id="field-badge-required">Обовʼязкове</span>
                            @endif</div>
                        <div><img id="accordion-chevron" width="16px"
                                  src="{{asset('/assets/icons/chevron-right.svg')}}"
                                  alt="chevron" class=""></div>
                    </div>
                    <div class="removeButtonBaseField" id="removeButton"><img
                            src="{{asset('/assets/icons/close-field-base.svg')}}"
                            alt="close-field-base"></div>
                </div>
            </div>
            <div class="document-field-accordion-body d-none"
                 id="field-accordion-body">
                <div class="document-field-accordion-body-form">
                    <div class="mb-1">
                        <div class="js-validate-titleInput text-danger mb-1 d-none">Заповніть назву поля</div>

                        <label class="form-label"
                               for="titleInput_0_label">Назва
                            поля</label><input id="titleInput_0_label"
                                               class="form-control" type="text"
                                               placeholder="Назва поля приклад"
                                               value="{{$field['name']}}"></div>
                    <div class="mb-1"><label class="form-label"
                                             for="descInput_0_label">Підказка</label><input
                            id="descInput_0_label" class="form-control"
                            type="text"
                            placeholder="Поясніть як користувачі можуть використовувати це поле"
                            value="{{$field['hint']}}">
                    </div>

                    <div class="js-validate-directorySelect text-danger mb-1 d-none">Оберіть довідник в полі</div>

                    <div class="mb-1"><label class="form-label"
                                             for="descInput_0_label">Довідник</label>
                    </div>
                    <select class="select2 form-select"
                            id="directorySelect_{{$field['directory']}}_label_{{$field['id']}}"
                            data-placeholder="Виберіть довідник для цього селекту">
                        @foreach(\App\Helpers\DictionaryList::list() as $key=>$dictionary)
                            <option
                                value="{{$key}}" {{$field['directory'] == $key ? 'selected' : ''}}>
                                {{$dictionary}}</option>
                        @endforeach
                    </select>

                </div>
                <hr>
                <div
                    class="document-field-accordion-body-footer d-flex align-items-center justify-content-end">
                    <div class="form-check form-check-warning pe-1"><input
                            type="checkbox" class="form-check-input"
                            id="requiredCheck_0_label"><label
                            class="form-check-label"
                            for="requiredCheck_0_label" {{$field['required'] ? 'checked' : ''}}>Обов'язкове</label>
                    </div>
                    <div class="">
                        <button type="button" id="removeButton_0_label"
                                class="btn btn-flat-danger d-flex align-items-center">
                            <img class="trash-red"
                                 src="{{asset('/assets/icons/trash-red2.svg')}}"><span>Видалити</span>
                        </button>
                    </div>
                </div>
            </div>
        </li>
        @break
    @case('range')
        <li class="group ui-draggable ui-draggable-handle" data-system="0"
            style="z-index: 1000; width: 155.077px; height: 61.641px;">
            <div class="accordion-header ui-accordion-header mb-0 bg-white"
                 data-type="range">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-start">
                        <img class="pe-1"
                             src="/assets/icons/create-type/letter-case.svg">
                        <p class="system-title m-0" data-key="range_field">
                            {{$field['name']}}</p></div>
                    <div class="d-flex" id="header-badge">
                        <div>
                            @if($field['required'])
                                <span
                                    class="badge badge-light-secondary mx-2 d-none"
                                    id="field-badge-required">Обовʼязкове</span>
                            @endif

                        </div>
                        <div><img id="accordion-chevron" width="16px"
                                  src="/assets/icons/chevron-right.svg"
                                  alt="chevron"></div>
                    </div>
                    <div class="removeButtonBaseField" id="removeButton"><img
                            src="/assets/icons/close-field-base.svg"
                            alt="close-field-base"></div>
                </div>
            </div>
            <div class="document-field-accordion-body d-none"
                 id="field-accordion-body">
                <div class="document-field-accordion-body-form">
                    <div class="mb-1">
                        <div class="js-validate-titleInput text-danger mb-1 d-none">Заповніть назву поля</div>

                        <label class="form-label"
                               for="titleInput_0_range">{{$field['name']}}</label>
                        <input id="titleInput_0_range"
                               class="form-control" type="text"
                               placeholder="Назва поля приклад"
                               value="{{$field['name']}}"></div>
                    <div class="d-none"></div>
                    <div class="d-none"></div>
                </div>
                <hr>
                <div
                    class="document-field-accordion-body-footer d-flex align-items-center justify-content-end">
                    <div class="form-check form-check-warning pe-1"><input
                            type="checkbox" class="form-check-input"
                            id="requiredCheck_{{$field['id']}}_{{$key}}"><label
                            class="form-check-label"
                            {{$field['required'] ? 'required' : ''}} for="requiredCheck_{{$field['id']}}_{{$key}}">Обов'язкове</label>
                    </div>
                    <div class="">
                        <button type="button" id="removeButton_0_range"
                                class="btn btn-flat-danger d-flex align-items-center">
                            <img class="trash-red"
                                 src="/assets/icons/trash-red2.svg"><span>Видалити</span>
                        </button>
                    </div>
                </div>
            </div>
        </li>
        @break
    @case('dateRange')
        <li class="group ui-draggable ui-draggable-handle" data-system="0"
            style="z-index: 1000; width: 155.077px; height: 61.641px;">
            <div class="accordion-header ui-accordion-header mb-0 bg-white"
                 data-type="dateRange">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-start">
                        <img class="pe-1"
                             src="/assets/icons/create-type/calendar-event.svg">
                        <p class="system-title m-0" data-key="dateRange_field">
                            {{$field['name']}}</p></div>
                    <div class="d-flex" id="header-badge">
                        <div>
                            @if($field['required'])
                                <span
                                    class="badge badge-light-secondary mx-2 d-none"
                                    id="field-badge-required">Обовʼязкове</span>
                            @endif

                        </div>
                        <div><img id="accordion-chevron" width="16px"
                                  src="/assets/icons/chevron-right.svg"
                                  alt="chevron"></div>
                    </div>
                    <div class="removeButtonBaseField" id="removeButton"><img
                            src="/assets/icons/close-field-base.svg"
                            alt="close-field-base"></div>
                </div>
            </div>
            <div class="document-field-accordion-body d-none"
                 id="field-accordion-body">
                <div class="document-field-accordion-body-form">
                    <div class="mb-1">
                        <div class="js-validate-titleInput text-danger mb-1 d-none">Заповніть назву поля</div>

                        <label class="form-label"
                               for="titleInput_0_dateRange">{{$field['name']}}</label>
                        <input id="titleInput_0_dateRange"
                               class="form-control" type="text"
                               placeholder="Назва поля приклад"
                               value="{{$field['name']}}"></div>
                    <div class="d-none"></div>
                    <div class="d-none"></div>
                </div>
                <hr>
                <div
                    class="document-field-accordion-body-footer d-flex align-items-center justify-content-end">
                    <div class="form-check form-check-warning pe-1"><input
                            type="checkbox" class="form-check-input"
                            id="requiredCheck_{{$field['id']}}_{{$key}}"><label
                            class="form-check-label"
                            {{$field['required'] ? 'required' : ''}} for="requiredCheck_{{$field['id']}}_{{$key}}">Обов'язкове</label>
                    </div>
                    <div class="">
                        <button type="button" id="removeButton_0_dateRange"
                                class="btn btn-flat-danger d-flex align-items-center">
                            <img class="trash-red"
                                 src="/assets/icons/trash-red2.svg"><span>Видалити</span>
                        </button>
                    </div>
                </div>
            </div>
        </li>
        @break
    @case('dateTime')
        <li class="group ui-draggable ui-draggable-handle" data-system="0"
            style="z-index: 1000; width: 155.077px; height: 61.641px;">
            <div class="accordion-header ui-accordion-header mb-0 bg-white"
                 data-type="dateTime">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-start">
                        <img class="pe-1"
                             src="/assets/icons/create-type/calendar-event.svg">
                        <p class="system-title m-0" data-key="dateTime_field">
                            {{$field['name']}}</p></div>
                    <div class="d-flex" id="header-badge">
                        <div>
                            @if($field['required'])
                                <span
                                    class="badge badge-light-secondary mx-2 d-none"
                                    id="field-badge-required">Обовʼязкове</span>
                            @endif

                        </div>
                        <div><img id="accordion-chevron" width="16px"
                                  src="/assets/icons/chevron-right.svg"
                                  alt="chevron"></div>
                    </div>
                    <div class="removeButtonBaseField" id="removeButton"><img
                            src="/assets/icons/close-field-base.svg"
                            alt="close-field-base"></div>
                </div>
            </div>
            <div class="document-field-accordion-body d-none"
                 id="field-accordion-body">
                <div class="document-field-accordion-body-form">
                    <div class="mb-1">
                        <div class="js-validate-titleInput text-danger mb-1 d-none">Заповніть назву поля</div>

                        <label class="form-label"
                               for="titleInput_0_dateTime">{{$field['name']}}</label>
                        <input id="titleInput_0_dateTime"
                               class="form-control" type="text"
                               placeholder="Назва поля приклад"
                               value="{{$field['name']}}"></div>
                    <div class="d-none"></div>
                    <div class="d-none"></div>
                </div>
                <hr>
                <div
                    class="document-field-accordion-body-footer d-flex align-items-center justify-content-end">
                    <div class="form-check form-check-warning pe-1"><input
                            type="checkbox" class="form-check-input"
                            id="requiredCheck_{{$field['id']}}_{{$key}}"><label
                            class="form-check-label"
                            {{$field['required'] ? 'required' : ''}} for="requiredCheck_{{$field['id']}}_{{$key}}">Обов'язкове</label>
                    </div>
                    <div class="">
                        <button type="button" id="removeButton_0_dateTime"
                                class="btn btn-flat-danger d-flex align-items-center">
                            <img class="trash-red"
                                 src="/assets/icons/trash-red2.svg"><span>Видалити</span>
                        </button>
                    </div>
                </div>
            </div>
        </li>
        @break
    @case('dateTimeRange')
        <li class="group ui-draggable ui-draggable-handle" data-system="0"
            style="z-index: 1000; width: 155.077px; height: 61.641px;">
            <div class="accordion-header ui-accordion-header mb-0 bg-white"
                 data-type="dateTimeRange">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-start">
                        <img class="pe-1"
                             src="/assets/icons/create-type/calendar-event.svg">
                        <p class="system-title m-0" data-key="dateTimeRange_field">
                            {{$field['name']}}</p></div>
                    <div class="d-flex" id="header-badge">
                        <div>
                            @if($field['required'])
                                <span
                                    class="badge badge-light-secondary mx-2 d-none"
                                    id="field-badge-required">Обовʼязкове</span>
                            @endif

                        </div>
                        <div><img id="accordion-chevron" width="16px"
                                  src="/assets/icons/chevron-right.svg"
                                  alt="chevron"></div>
                    </div>
                    <div class="removeButtonBaseField" id="removeButton"><img
                            src="/assets/icons/close-field-base.svg"
                            alt="close-field-base"></div>
                </div>
            </div>
            <div class="document-field-accordion-body d-none"
                 id="field-accordion-body">
                <div class="document-field-accordion-body-form">
                    <div class="mb-1">
                        <div class="js-validate-titleInput text-danger mb-1 d-none">Заповніть назву поля</div>

                        <label class="form-label"
                               for="titleInput_0_dateTimeRange">{{$field['name']}}</label>
                        <input id="titleInput_0_dateTimeRange"
                               class="form-control" type="text"
                               placeholder="Назва поля приклад"
                               value="{{$field['name']}}"></div>
                    <div class="d-none"></div>
                    <div class="d-none"></div>
                </div>
                <hr>
                <div
                    class="document-field-accordion-body-footer d-flex align-items-center justify-content-end">
                    <div class="form-check form-check-warning pe-1"><input
                            type="checkbox" class="form-check-input"
                            id="requiredCheck_{{$field['id']}}_{{$key}}"><label
                            class="form-check-label"
                            {{$field['required'] ? 'required' : ''}} for="requiredCheck_{{$field['id']}}_{{$key}}">Обов'язкове</label>
                    </div>
                    <div class="">
                        <button type="button" id="removeButton_0_dateTimeRange"
                                class="btn btn-flat-danger d-flex align-items-center">
                            <img class="trash-red"
                                 src="/assets/icons/trash-red2.svg"><span>Видалити</span>
                        </button>
                    </div>
                </div>
            </div>
        </li>
        @break
    @case('timeRange')
        <li class="group ui-draggable ui-draggable-handle" data-system="0"
            style="z-index: 1000; width: 155.077px; height: 61.641px;">
            <div class="accordion-header ui-accordion-header mb-0 bg-white"
                 data-type="range">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-start">
                        <img class="pe-1"
                             src="/assets/icons/create-type/clock.svg">
                        <p class="system-title m-0" data-key="range_field">
                            {{$field['name']}}</p></div>
                    <div class="d-flex" id="header-badge">
                        <div>
                            @if($field['required'])
                                <span
                                    class="badge badge-light-secondary mx-2 d-none"
                                    id="field-badge-required">Обовʼязкове</span>
                            @endif

                        </div>
                        <div><img id="accordion-chevron" width="16px"
                                  src="/assets/icons/chevron-right.svg"
                                  alt="chevron"></div>
                    </div>
                    <div class="removeButtonBaseField" id="removeButton"><img
                            src="/assets/icons/close-field-base.svg"
                            alt="close-field-base"></div>
                </div>
            </div>
            <div class="document-field-accordion-body d-none"
                 id="field-accordion-body">
                <div class="document-field-accordion-body-form">
                    <div class="mb-1">
                        <div class="js-validate-titleInput text-danger mb-1 d-none">Заповніть назву поля</div>
                        <label class="form-label"
                               for="titleInput_0_range">{{$field['name']}}</label>
                        <input id="titleInput_0_range"
                               class="form-control" type="text"
                               placeholder="Назва поля приклад"
                               value="{{$field['name']}}"></div>
                    <div class="d-none"></div>
                    <div class="d-none"></div>
                </div>
                <hr>
                <div
                    class="document-field-accordion-body-footer d-flex align-items-center justify-content-end">
                    <div class="form-check form-check-warning pe-1"><input
                            type="checkbox" class="form-check-input"
                            id="requiredCheck_{{$field['id']}}_{{$key}}"><label
                            class="form-check-label"
                            {{$field['required'] ? 'required' : ''}} for="requiredCheck_{{$field['id']}}_{{$key}}">Обов'язкове</label>
                    </div>
                    <div class="">
                        <button type="button" id="removeButton_0_range"
                                class="btn btn-flat-danger d-flex align-items-center">
                            <img class="trash-red"
                                 src="/assets/icons/trash-red2.svg"><span>Видалити</span>
                        </button>
                    </div>
                </div>
            </div>
        </li>
        @break
    @case('switch')
        <li class="group ui-draggable ui-draggable-handle" data-system="0"
            style="width: 295.256px; height: 61.641px; z-index: 1000;">
            <div class="accordion-header ui-accordion-header mb-0 bg-white" data-type="switch">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-start"><img class="pe-1"
                                                                                      src="/assets/icons/create-type/checkbox.svg">
                        <p class="system-title m-0" data-key="switch_field">{{$field['name']}}</p></div>
                    <div class="d-flex" id="header-badge">
                        <div>
                            @if($field['required'])
                                <span
                                    class="badge badge-light-secondary mx-2 d-none"
                                    id="field-badge-required">Обовʼязкове</span>
                            @endif
                        </div>
                        <div><img id="accordion-chevron" width="16px" src="/assets/icons/chevron-right.svg"
                                  alt="chevron" class=""></div>
                    </div>
                    <div class="removeButtonBaseField" id="removeButton"><img src="/assets/icons/close-field-base.svg"
                                                                              alt="close-field-base"></div>
                </div>
            </div>
            <div class="document-field-accordion-body d-none" id="field-accordion-body">
                <div class="document-field-accordion-body-form">
                    <div class="mb-1">
                        <div class="js-validate-titleInput text-danger mb-1 d-none">Заповніть назву поля</div>
                        <label class="form-label" for="titleInput_0_switch">Назва поля</label><input
                            id="titleInput_0_switch" class="form-control" type="text" placeholder="Назва поля приклад"
                            value="{{$field['name']}}"></div>
                    <div class="d-none"></div>
                    <div class="d-none"></div>
                </div>
                <hr>
                <div class="document-field-accordion-body-footer d-flex align-items-center justify-content-end">
                    <div class="form-check form-check-warning pe-1"><input type="checkbox" class="form-check-input"
                                                                           id="requiredCheck_0_switch"><label
                            class="form-check-label"
                            {{$field['required'] ? 'required' : ''}} for="requiredCheck_0_switch">Обов'язкове</label>
                    </div>
                    <div class="">
                        <button type="button" id="removeButton_0_switch"
                                class="btn btn-flat-danger d-flex align-items-center"><img class="trash-red"
                                                                                           src="/assets/icons/trash-red2.svg"><span>Видалити</span>
                        </button>
                    </div>
                </div>
            </div>
        </li>
        @break
    @case('uploadFile')
        <li class="group ui-draggable ui-draggable-handle" data-system="0"
            style="z-index: 1000; width: 185.462px; height: 61.641px;">
            <div class="accordion-header ui-accordion-header mb-0 bg-white" data-type="uploadFile">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-start"><img class="pe-1"
                                                                                      src="/assets/icons/create-type/upload.svg">
                        <p class="system-title m-0" data-key="uploadFile_field">{{$field['name']}}</p></div>
                    <div class="d-flex" id="header-badge">
                        <div>
                            @if($field['required'])
                                <span
                                    class="badge badge-light-secondary mx-2 d-none"
                                    id="field-badge-required">Обовʼязкове</span>
                            @endif
                        </div>
                        <div><img id="accordion-chevron" width="16px" src="/assets/icons/chevron-right.svg"
                                  alt="chevron"></div>
                    </div>
                    <div class="removeButtonBaseField" id="removeButton"><img src="/assets/icons/close-field-base.svg"
                                                                              alt="close-field-base"></div>
                </div>
            </div>
            <div class="document-field-accordion-body d-none" id="field-accordion-body">
                <div class="document-field-accordion-body-form">
                    <div class="mb-1">
                        <div class="js-validate-titleInput text-danger mb-1 d-none">Заповніть назву поля</div>
                        <label class="form-label" for="titleInput_0_uploadFile">Назва поля</label><input
                            id="titleInput_0_uploadFile" class="form-control" type="text"
                            placeholder="Назва поля приклад" value="{{$field['name']}}"></div>
                    <div class="d-none"></div>
                    <div class="d-none"></div>
                </div>
                <hr>
                <div class="document-field-accordion-body-footer d-flex align-items-center justify-content-end">
                    <div class="form-check form-check-warning pe-1"><input type="checkbox" class="form-check-input"
                                                                           id="requiredCheck_0_uploadFile"><label
                            class="form-check-label"
                            {{$field['required'] ? 'required' : ''}} for="requiredCheck_0_uploadFile">Обов'язкове</label>
                    </div>
                    <div class="">
                        <button type="button" id="removeButton_0_uploadFile"
                                class="btn btn-flat-danger d-flex align-items-center"><img class="trash-red"
                                                                                           src="/assets/icons/trash-red2.svg"><span>Видалити</span>
                        </button>
                    </div>
                </div>
            </div>
        </li>
        @break
    @case('comment')
        <li class="group ui-draggable ui-draggable-handle" data-system="0"
            style="width: 160.564px; height: 61.641px; z-index: 1000;">
            <div class="accordion-header ui-accordion-header mb-0 bg-white" data-type="comment">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-start"><img class="pe-1"
                                                                                      src="/assets/icons/create-type/align-justified.svg">
                        <p class="system-title m-0" data-key="comment_field">{{$field['name']}}</p></div>
                    <div class="d-flex" id="header-badge">
                        <div>
                            @if($field['required'])
                                <span
                                    class="badge badge-light-secondary mx-2 d-none"
                                    id="field-badge-required">Обовʼязкове</span>
                            @endif
                        </div>
                        <div><img id="accordion-chevron" width="16px" src="/assets/icons/chevron-right.svg"
                                  alt="chevron"></div>
                    </div>
                    <div class="removeButtonBaseField" id="removeButton"><img src="/assets/icons/close-field-base.svg"
                                                                              alt="close-field-base"></div>
                </div>
            </div>
            <div class="document-field-accordion-body d-none" id="field-accordion-body">
                <div class="document-field-accordion-body-form">
                    <div class="mb-1">
                        <div class="js-validate-titleInput text-danger mb-1 d-none">Заповніть назву поля</div>

                        <label class="form-label" for="titleInput_0_comment">Назва поля</label><input
                            id="titleInput_0_comment" class="form-control" type="text" placeholder="Назва поля приклад"
                            value="{{$field['name']}}"></div>
                    <div class="d-none"></div>
                    <div class="d-none"></div>
                </div>
                <hr>
                <div class="document-field-accordion-body-footer d-flex align-items-center justify-content-end">
                    <div class="form-check form-check-warning pe-1"><input type="checkbox" class="form-check-input"
                                                                           id="requiredCheck_0_comment"><label
                            class="form-check-label"
                            {{$field['required'] ? 'required' : ''}} for="requiredCheck_0_comment">Обов'язкове</label>
                    </div>
                    <div class="">
                        <button type="button" id="removeButton_0_comment"
                                class="btn btn-flat-danger d-flex align-items-center"><img class="trash-red"
                                                                                           src="/assets/icons/trash-red2.svg"><span>Видалити</span>
                        </button>
                    </div>
                </div>
            </div>
        </li>
        @break
@endswitch
