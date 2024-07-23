@extends('layouts.admin')
@section('title','Регламенти')
@section('page-style')
@endsection
@section('before-style')

@endsection

@section('content')
    <div class="container-fluid px-3 css-entity-regulation">
        <div class="row" style="column-gap: 144px">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xxl-3 px-0"
                 style="min-width: 208px; max-width: fit-content">
                @include('layouts.setting')
            </div>
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xxl-9 px-0" style="max-width: 798px">
                <div class="tab-content card pb-0">
                    <div role="tabpanel" class="tab-pane mb-0 active" id="vertical-pill-5"
                         aria-labelledby="stacked-pill-5"
                         aria-expanded="true">
                        <div id="all-regulation">
                            <div class="p-2">
                                <h4 data-i18n="RegulationTitle" class="fw-bolder mb-0">
                                    Регламенти
                                </h4>
                            </div>
                            <hr class="my-0">
                            <div id="list-regulation"></div>
                        </div>

                        <div id="selected-type"></div>

                        <div id="create-regulation"></div>

                        <div id="edit-regulation"></div>

                        <div id="view-regulation"></div>

                    </div>

                </div>
            </div>
        </div>

        <div class="modal text-start" id="archive_regulation" tabindex="-1"
             aria-labelledby="myModalLabel6" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                <div class="modal-content">
                    <div class="card popup-card p-2">
                        <h4 class="fw-bolder">
                            <span data-i18n="TitleModalArchive">Архівування регламенту</span>
                            <span id="titleModalArchive"></span>
                        </h4>
                        <div class="card-body row mx-0 p-0">

                            <p class="my-2 p-0"> Ви впевнені що хочете архівувати цей регламент?
                            </p>

                            <div class="col-12">
                                <div class="d-flex float-end">
                                    <button type="button" class="btn btn-link cancel-btn"
                                            data-dismiss="modal">Скасувати
                                    </button>
                                    <button type="button" class="btn btn-primary" id="archiveRule">Підтвердити
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="modal text-start" id="delete_regulation" tabindex="-1"
             aria-labelledby="myModalLabel6" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                <div class="modal-content">
                    <div class="card popup-card p-2">
                        <h4 class="fw-bolder" id="titleModalRegulationDelete">
                            Видалення регламенту
                        </h4>
                        <div class="card-body row mx-0 p-0">

                            <p class="my-2 p-0"> Ви впевнені що хочете видалити цей регламент?
                            </p>

                            <div class="col-12">
                                <div class="d-flex float-end">
                                    <button type="button" class="btn btn-link cancel-btn"
                                            data-dismiss="modal">Скасувати
                                    </button>
                                    <button type="button" class="btn btn-primary" id="deleteRegulation">Підтвердити
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="modal text-start" id="no_delete_regulation" tabindex="-1"
             aria-labelledby="myModalLabel6" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                <div class="modal-content">
                    <div class="card popup-card p-2">
                        <h4 class="fw-bolder" id="titleModalNoRegulationDelete">
                            Неможливе видалення регламенту
                        </h4>
                        <div class="card-body row mx-0 p-0">

                            <p class="my-2 p-0"> Цей регламент звʼязаний з <a class="link-primary" href="#">договорами
                                    (3)</a>. <br>Щоб видалити регламент у
                                вас не має бути поточних
                                <br> договорів з цим регламентом.
                            </p>

                            <div class="col-12">
                                <div class="d-flex float-end">
                                    <button type="button" class="btn btn-primary cancel-btn"
                                            data-dismiss="modal">Зрозуміло
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="modal text-start" id="no_archive_regulation" tabindex="-1"
             aria-labelledby="myModalLabel6" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                <div class="modal-content">
                    <div class="card popup-card p-2">
                        <h4 class="fw-bolder" id="titleModalNoArchive">
                            Неможливе архівування регламенту
                        </h4>
                        <div class="card-body row mx-0 p-0">

                            <p class="my-2 p-0"> Цей регламент звʼязаний з <a class="link-primary" href="#">договорами
                                    (3)</a>. <br>Щоб архівувати регламент у вас не має бути поточних <br> договорів
                                з
                                цим регламентом.
                            </p>

                            <div class="col-12">
                                <div class="d-flex float-end">
                                    <button type="button" class="btn btn-primary cancel-btn"
                                            data-dismiss="modal">Зрозуміло
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="modal text-start" id="save_edit_regulation" tabindex="-1"
             aria-labelledby="myModalLabel6" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 555px!important;">
                <div class="modal-content">
                    <div class="card popup-card p-2">
                        <h4 class="fw-bolder" id="titleModalSaveEditRegulation">
                            Збереження змін в регламенті
                        </h4>
                        <div class="card-body row mx-0 p-0">

                            <p class="my-2 p-0"> Цей регламент є батьківськім і має дочірні регламенти. <br> Зміни
                                які
                                ви внесли можуть бути відображені в усіх
                                <br> дочірніх регламентах.
                            </p>

                            <div class="form-check form-check-warning">
                                <input type="checkbox" class="form-check-input" id="save-children-regulation">
                                <label class="form-check-label" for="save-children-regulation">Внести зміни в дочірні
                                    регламенти</label>
                            </div>

                            <div class="col-12">
                                <div class="d-flex float-end">
                                    <button type="button" class="btn btn-link cancel-btn"
                                            data-dismiss="modal">Скасувати
                                    </button>
                                    <button type="button" id="save-edit-regulation" class="btn btn-primary"
                                            data-dismiss="modal">Зберегти
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection

@section('page-script')

    <script src="{{asset('assets/js/utils/modalHideButton.js')}}"></script>
    <script type="module" src="{{asset('assets/js/entity/regulation/regulation.js')}}"></script>
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>

@endsection
