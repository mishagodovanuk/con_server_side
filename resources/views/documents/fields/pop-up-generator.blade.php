<div class="col-12 mb-1">
    <label class="form-label" for="{{$key}}">{{$field['name']}}
        <span class="text-danger fs-5">{{$field['required'] ? '*' : ''}}</span>
    </label>
    @switch($field['type'])
        @case('text')
            <input
                type="{{isset($field['requiredIsNumber']) ? 'number' : 'text'}}"
                class="form-control {{$field['required'] ? 'required-field' : ''}}"
                placeholder="{{$field['hint']}}"
                name="{{$key}}"
                id="{{$key}}"
                {{$field['required'] ? 'required' : ''}}
            >
            @break
        @case('range')
            <div class="row">
                <div class="col-6">
                    <input type="number"
                           class="form-control col-6 {{$field['required'] ? 'required-field' : ''}}"
                           placeholder="Від"
                           name="{{$key}}[]"
                           id="{{$key}}"
                        {{$field['required'] ? 'required' : ''}}>
                </div>

                <div class="col-6">
                    <input type="number"
                           class="form-control col-6 {{$field['required'] ? 'required-field' : ''}}"
                           placeholder="До"
                           name="{{$key}}[]"
                           id="{{$key}}"
                        {{$field['required'] ? 'required' : ''}}>
                </div>
            </div>
            @break
        @case('date')
            <div class="input-group input-group-merge">
                <input type="text"
                       class="form-control js-current-data  flatpickr-basic flatpickr-input {{$field['required'] ? 'required-field' : ''}}"
                       id="{{$key}}"
                       name="{{$key}}"
                       placeholder="{{$field['hint']}}"
                       aria-describedby="{{$key}}-addon6"
                    {{$field['required'] ? 'required' : ''}}
                />
                <span class="input-group-text"
                      id="basic-addon6">
                    <img class="" src="{{asset('assets/icons/calendar.svg')}}">
                </span>
            </div>
            @break
        @case('dateRange')
            <input type="text"
                   id="{{$key}}"
                   name="{{$key}}"
                   class="form-control js-current-data flatpickr-range flatpickr-input {{$field['required'] ? 'required-field' : ''}}"
                   placeholder="{{$field['hint']}}"
                   readonly="readonly"
                {{$field['required'] ? 'required' : ''}}
            >
            @break
        @case('dateTimeRange')
            <div class="row">
                <div class="col-6">
                    <input type="text"
                           id="{{$key}}_date"
                           name="{{$key}}[]"
                           class="form-control js-current-data flatpickr-basic flatpickr-input {{$field['required'] ? 'required-field' : ''}}"
                           placeholder="Дата"
                           readonly="readonly"
                        {{$field['required'] ? 'required' : ''}}>
                </div>
                <div class="col-3">
                    <input type="text"
                           id="{{$key}}_time_from"
                           name="{{$key}}[]"
                           class="form-control flatpickr-time text-start flatpickr-input {{$field['required'] ? 'required-field' : ''}}"
                           placeholder="Від"
                           readonly="readonly"
                        {{$field['required'] ? 'required' : ''}}>
                </div>
                <div class="col-3">
                    <input type="text"
                           id="{{$key}}_time_to"
                           name="{{$key}}[]"
                           class="form-control flatpickr-time text-start flatpickr-input {{$field['required'] ? 'required-field' : ''}}"
                           placeholder="До"
                           readonly="readonly"
                        {{$field['required'] ? 'required' : ''}}>
                </div>
            </div>
            @break
        @case('dateTime')
            <div class="row">
                <div class="col-6">
                    <input type="text"
                           id="{{$key}}_date"
                           name="{{$key}}[]"
                           class="form-control js-current-data flatpickr-basic text-start flatpickr-input {{$field['required'] ? 'required-field' : ''}}"
                           placeholder="Дата"
                           readonly="readonly"
                        {{$field['required'] ? 'required' : ''}}>
                </div>
                <div class="col-6">
                    <input type="text"
                           id="{{$key}}_time"
                           name="{{$key}}[]"
                           class="form-control flatpickr-time text-start flatpickr-input {{$field['required'] ? 'required-field' : ''}}"
                           placeholder="Час"
                           readonly="readonly"
                        {{$field['required'] ? 'required' : ''}}>
                </div>
            </div>
            @break
        @case('timeRange')
            <div class="row">
                <div class="col-6">
                    <input type="text"
                           id="{{$key}}_from"
                           name="{{$key}}[]"
                           class="form-control flatpickr-time text-start flatpickr-input {{$field['required'] ? 'required-field' : ''}}"
                           placeholder="Від"
                           readonly="readonly"
                        {{$field['required'] ? 'required' : ''}}>

                </div>
                <div class="col-6">
                    <input type="text"
                           id="{{$key}}_to"
                           name="{{$key}}[]"
                           class="form-control flatpickr-time text-start flatpickr-input {{$field['required'] ? 'required-field' : ''}}"
                           placeholder="До"
                           readonly="readonly"
                        {{$field['required'] ? 'required' : ''}}>
                </div>
            </div>
            @break
        @case('select')
            <select
                class="select2 form-select {{$field['required'] ? 'required-field-select' : ''}} dictionary-search"
                id="{{$key}}-{{$fieldsID}}"
                name="{{$key}}"
                data-placeholder="{{$field['hint']}}"
                data-dictionary="{{$field['directory']}}">
                {{$field['required'] ? 'required' : ''}}
                <option value=""></option>
            </select>
            @break
        @case('label')
            <select class="select2 form-select select2-multiple dictionary-search
                    {{$field['required'] ? 'required-field-select' : ''}}"
                    id="{{$key}}-{{$fieldsID}}"
                    data-dictionary="{{$field['directory']}}"
                    name="{{$key}}[]"
                    data-placeholder="{{$field['hint']}}"
                    {{$field['required'] ? 'required' : ''}}
                    multiple>
                <option value=""></option>
            </select>
            @break
        @case('switch')
            <div
                class="form-check d-flex align-items-center gap-2 form-check-primary form-switch">
                <input type="checkbox"
                       class="form-check-input {{$field['required'] ? 'required-field-switch' : ''}}"
                       name="{{$key}}"
                       id="{{$key}}"
                    {{$field['required'] ? 'required' : ''}}>
                <div class="invalid-feedback">Поле обов'язкове до заповнення</div>
            </div>
            @break
        @case('uploadFile')
            <input class="form-control upload-file {{$field['required'] ? 'required-field' : ''}}"
                   data-buttonText="Вибрати файл"
                   type="file"
                   multiple
                   {{$field['required'] ? 'required' : ''}}
                   name="{{$key}}" id="{{$key}}"/>
            @break
        @case('comment')
            <textarea class="form-control {{$field['required'] ? 'required-field' : ''}}"
                      id="{{$key}}"
                      rows="3"
                      name="{{$key}}"
                      placeholder="{{$field['hint']}}"
            {{$field['required'] ? 'required' : ''}}>
            </textarea>
            @break
    @endswitch
</div>
