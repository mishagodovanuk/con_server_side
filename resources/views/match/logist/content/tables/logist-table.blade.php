<div class="card-grid" >

    <div id="offcanvas-end-example">
        <div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1"
             id="settingTable" aria-labelledby="settingTableLabel"
             style="width: 400px; height: min-content; position:absolute; top: 46px; transform: unset; transition: unset; z-index: 1001;"
             data-bs-scroll="true">
            <div class="offcanvas-header">
                <h4 id="offcanvasEndLabel" class="offcanvas-title"> {{__('local_logist.log_table_configuration')}}</h4>
                <div class="nav-item nav-search text-reset" data-bs-dismiss="offcanvas"
                     aria-label="Close" style="list-style: none;"><a class="nav-link nav-link-grid">
                        <img src="{{asset('assets/icons/close-button.svg')}}"
                             alt="close-button"></a>
                </div>
            </div>
            <div class="offcanvas-body p-0">
                <div class="" id="body-wrapper">
                    <div class="d-flex flex-row align-items-center justify-content-between px-2">
                        <div class="form-check-label f-15">{{__('local_logist.log_change_row_height')}}:</div>
                        <div class="form-check form-check-warning form-switch d-flex align-items-center"
                             style="">
                            <button class="changeMenu-3">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 10.5H21" stroke="#A8AAAE" stroke-width="1.75"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 15H21" stroke="#A8AAAE" stroke-width="1.75"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 19.5H21" stroke="#A8AAAE" stroke-width="1.75"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <button class="changeMenu-2 active-row-table ">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 6H15" stroke="#A8AAAE" stroke-width="1.75"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3 12H15" stroke="#A8AAAE" stroke-width="1.75"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>

                        </div>
                    </div>
                    <div
                        class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                        <label class="form-check-label f-15" for="changeFonts">{{__('local_logist.log_increase_font')}}
                            </label>
                        <div class="form-check form-check-warning form-switch">
                            <input type="checkbox" class="form-check-input checkbox"
                                   id="changeFonts"/>
                        </div>
                    </div>
                    <div
                        class="mt-1 d-flex flex-row align-items-center justify-content-between px-2">
                        <label class="form-check-label f-15" for="changeCol">{{__('local_logist.log_change_resize_columns')}}
                            </label>
                        <div class="form-check form-check-warning form-switch">
                            <input type="checkbox" class="form-check-input checkbox"
                                   id="changeCol"/>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex flex-column justify-content-between h-100" id="">
                        <div>
                            <div style="float: left;" id="jqxlistbox"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="table-block" id="logist-table">

    </div>
</div>
