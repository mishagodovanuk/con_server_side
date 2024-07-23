<div class="col-12 col-md-6 mb-1 ">
    <label class="form-label" for="{{$key}}">{{$field['name']}}
        <span class="text-danger fs-5">{{$field['required'] ? '*' : ''}}</span>
    </label>
    @switch($field['type'])
        @case('text')
            <input
                type="{{isset($field['requiredIsNumber']) ? 'number' : 'text'}}"
                value="{{$document->data()['custom_blocks'][$i][$key]}}"
                class="form-control {{$field['required'] ? 'required-field' : ''}}"
                placeholder="{{$field['hint']}}"
                name="{{$key}}"
                id="{{$key.$loop->index}}"
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
                           value="{{$document->data()['custom_blocks'][$i][$key][0]}}"
                        {{$field['required'] ? 'required' : ''}}>
                </div>

                <div class="col-6">
                    <input type="number"
                           class="form-control col-6 {{$field['required'] ? 'required-field' : ''}}"
                           placeholder="До"
                           name="{{$key}}[]"
                           id="{{$key}}"
                           value="{{$document->data()['custom_blocks'][$i][$key][1]}}"
                        {{$field['required'] ? 'required' : ''}}>
                </div>
            </div>
            @break
        @case('date')
            <div class="input-group input-group-merge">
                <input type="text"
                       class="form-control flatpickr-basic flatpickr-input {{$field['required'] ? 'required-field' : ''}}"
                       id="{{$key.$loop->index}}"
                       name="{{$key}}"
                       placeholder="{{$field['hint']}}"
                       value="{{$document->data()['custom_blocks'][$i][$key]}}"
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
                   class="form-control flatpickr-range flatpickr-input {{$field['required'] ? 'required-field' : ''}}"
                   placeholder="{{$field['hint']}}"
                   readonly="readonly"
                   value="{{$document->data()['custom_blocks'][$i][$key][0]}} to {{$document->data()['custom_blocks'][$i][$key][1]}}"
                {{$field['required'] ? 'required' : ''}}
            >
            @break
        @case('dateTimeRange')
            <div class="row">
                <div class="col-6">
                    <input type="text"
                           id="{{$key}}_date"
                           value="{{$document->data()['custom_blocks'][$i][$key][0]}}"
                           name="{{$key}}[]"
                           class="form-control flatpickr-basic flatpickr-input {{$field['required'] ? 'required-field' : ''}}"
                           placeholder="Дата"
                           readonly="readonly"
                        {{$field['required'] ? 'required' : ''}}>
                </div>
                <div class="col-3">
                    <input type="text"
                           id="{{$key}}_time_from"
                           value="{{$document->data()['custom_blocks'][$i][$key][1]}}"
                           name="{{$key}}[]"
                           class="form-control flatpickr-time text-start flatpickr-input {{$field['required'] ? 'required-field' : ''}}"
                           placeholder="Від"
                           readonly="readonly"
                        {{$field['required'] ? 'required' : ''}}>
                </div>
                <div class="col-3">
                    <input type="text"
                           id="{{$key}}_time_to"
                           value="{{$document->data()['custom_blocks'][$i][$key][2]}}"
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
                           value="{{$document->data()['custom_blocks'][$i][$key][0]}}"
                           name="{{$key}}[]"
                           class="form-control flatpickr-basic text-start flatpickr-input {{$field['required'] ? 'required-field' : ''}}"
                           placeholder="Дата"
                           readonly="readonly"
                        {{$field['required'] ? 'required' : ''}}>
                </div>
                <div class="col-6">
                    <input type="text"
                           id="{{$key}}_time"
                           value="{{$document->data()['custom_blocks'][$i][$key][1]}}"
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
                           value="{{$document->data()['custom_blocks'][$i][$key][0]}}"
                           name="{{$key}}[]"
                           class="form-control flatpickr-time text-start flatpickr-input {{$field['required'] ? 'required-field' : ''}}"
                           placeholder="Від"
                           readonly="readonly"
                        {{$field['required'] ? 'required' : ''}}>

                </div>
                <div class="col-6">
                    <input type="text"
                           id="{{$key}}_to"
                           value="{{$document->data()['custom_blocks'][$i][$key][1]}}"
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
                id="{{$key}}-custom-{{$i}}"
                name="{{$key}}"
                data-id="{{'['.$document->data()['header_ids'][$key.'_id'].']'}}"
                data-placeholder="{{$field['hint']}}"
                data-dictionary="{{$documentType->settings()['custom_blocks'][$i][$key]['directory']}}"
                {{$field['required'] ? 'required' : ''}}>
            </select>
            @break
        @case('label')
            <select class="select2 form-select select2-multiple dictionary-search
                    {{$field['required'] ? 'required-field-select' : ''}}"
                    id="{{$key.$loop->index}}"
                    data-id="{{'['.$document->data()['header_ids'][$key.'_id'].']'}}"
                    data-dictionary="{{$documentType->settings()['custom_blocks'][$i][$key]['directory']}}"
                    name="{{$key}}[]"
                    data-placeholder="{{$field['hint']}}"
                    {{$field['required'] ? 'required' : ''}}
                    multiple>
            </select>
            @break
        @case('switch')
            <div
                class="form-check d-flex align-items-center gap-2 form-check-primary form-switch">
                <input type="checkbox"
                       {{$document->data()['custom_blocks'][$i][$key] =="on" ? 'checked' : ''}}
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
                   name="{{$key}}"
                   id="{{$key}}"
            />
            @break
        @case('comment')
            <textarea class="form-control {{$field['required'] ? 'required-field' : ''}}"
                      id="{{$key}}"
                      rows="3"
                      name="{{$key}}"
                      placeholder="{{$field['hint']}}"
                    {{$field['required'] ? 'required' : ''}}>
               {{$document->data()['custom_blocks'][$i][$key]}}
            </textarea>
            @break
    @endswitch
</div>
