@extends('layouts.admin')
@section('title','Documents')
@section('page-style')
@endsection
@section('before-style')

@endsection

@section('content')
    <div class="container-fluid px-3">
        <div class="row" style="column-gap: 144px">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xxl-3 px-0"
                 style="min-width: 208px; max-width: fit-content">
                @include('layouts.setting')
            </div>
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xxl-9 px-0" style="max-width: 798px">
                <div class="tab-content card pb-0">
                    <div class="tab-pane card mb-0 active" id="vertical-pill-2" role="tabpanel"
                         aria-labelledby="stacked-pill-2" aria-expanded="false">
                        <div class="">
                            <div class="tab-title d-flex justify-content-between type-card-margin mt-2 mb-1">
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-0 fw-bolder">Типи документів</h4>
                                </div>
                                <div>
                                    <a href="{{route('document-type.create')}}" type="button"
                                       class="btn btn-flat-primary">Створити новий тип</a>
                                </div>
                            </div>
                            <div class="tab-search type-card-margin mb-2" style="width: 300px;">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text" id="basic-addon-search2"><i
                                            data-feather="search"></i></span>
                                    <input type="text" class="form-control" placeholder="Пошук" aria-label="Search..."
                                           aria-describedby="basic-addon-search2" id="searchTypeDoc"/>
                                </div>
                            </div>
                            <div class="document-type-list pt-1">
                                <div class="card-body px-0 py-0">
                                    <ul id="typeList" class="list-group" style="max-height: 407px; overflow-y: auto;">
                                        @foreach($documentTypes as $documentType)
                                            @php
                                                if ($documentType->status_id){
                                                $color = "";
                                                if ($documentType->status->key=='archieve'){
                                                    $color = "badge-light-dark";
                                                }elseif ($documentType->status->key=='system'){
                                                    $color = 'badge-light-primary';
                                                }elseif($documentType->status->key == 'draft'){
                                                    $color = 'badge-light-danger';
                                                }
                                                }
                                            @endphp
                                            <li class="list-group-item  justify-content-between type-card-margin"
                                                style="line-height: 2.5em;position: static">
                                                <p class="m-0 align-self-center"><a href="#"
                                                                                    class="list-group-item-action me-2">{{$documentType->name}}</a>
                                                    @if($documentType->status_id)
                                                        <span
                                                            class="badge {{$color}}">{{$documentType->status->name}}</span>
                                                    @endif
                                                </p>
                                                {{--                                                @if($isAdmin || $documentType->status_id === null)--}}
                                                <div class="d-inline-flex">
                                                    <a class="pe-1 dropdown-toggle hide-arrow"
                                                       data-bs-toggle="dropdown">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                             height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round"
                                                             class="feather feather-more-vertical font-small-4">
                                                            <circle cx="12" cy="12" r="1"></circle>
                                                            <circle cx="12" cy="5" r="1"></circle>
                                                            <circle cx="12" cy="19" r="1"></circle>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end"
                                                         id="dropdown-menu-type">


                                                        <a data-id=""
                                                           class="dropdown-item edit_package_button"
                                                           href="{{route('document-type.edit',['document_type'=>$documentType->id])}}">
                                                            Редагувати
                                                        </a>

                                                        @if($documentType->status_id === null || $documentType->status_id === 3)
                                                            <form method="post"
                                                                  action="{{ route('document-type.status.change', ['status' => 'archieve', 'document_type' => $documentType->id]) }}">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item w-100">
                                                                    Архівувати
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form method="post"
                                                                  action="{{ route('document-type.status.change', ['status' => 'null', 'document_type' => $documentType->id]) }}">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item w-100">
                                                                    Розархівувати
                                                                </button>
                                                            </form>

                                                        @endif


                                                        <form method="post"
                                                              action="{{ route('document-type.destroy', ['document_type' => $documentType->id]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item w-100">
                                                                Видалити
                                                            </button>
                                                        </form>


                                                    </div>
                                                </div>
                                                {{--                                                @endif--}}
                                            </li>
                                        @endforeach
                                    </ul>
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
    <script src="{{asset('assets/js/entity/document-type/type-list.js')}}"></script>
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>
@endsection
