@extends('layouts.empty')
@section('title','Workspaces')
@section('page-style')
@endsection
@section('before-style')
    <link rel="stylesheet" type="text/css" href="{{asset(mix('vendors/css/vendors.min.css'))}}">
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="workspaces-header d-flex flex-column pb-2">
            <h2 class="text-center pb-1 fw-semibold">Робочі середовища</h2>
            <span
                class="text-center">Виберіть робоче середовище для подальшої роботи<br/>в системі або створіть нове</span>
        </div>

        <div class="row justify-content-start m-0 gy-1" id="">
            <div class="workspace-row-title">
                <h4 class="fw-bolder">Мої робочі середовища</h4>
            </div>

            @foreach ($workspaces as $workspace)

                <div class="col-12 col-sm-6 col-md-6 col-xl-3 col-xxl-3">
                    <div class="list-document-effect d-flex flex-column justify-content-between p-2"
                         style="border: 1px solid rgba(75, 70, 92, 0.16); border-radius: 6px;">
                        <div class="">
                            <div class="dropstart">
                                <a class="text-secondary"
                                   href="{{route('workspace.edit', ['workspace' => $workspace->id])}}"> <i
                                        data-feather="edit" class="font-medium-3 cursor-pointer"
                                        style="position: absolute; right: 10px;"></i></a>


                            </div>
                            <a id="workspace-change-link-{{$workspace->id}}" data-id="{{$workspace->id}}"
                               class="d-flex flex-column align-items-center"
                               href="#">
                                <div>
                                    <h4 class="pb-1 fw-bolder">{{$workspace->name}}</h4>
                                </div>
                                <div>

                                    @if (!is_null($workspace->avatar_type))
                                        <img style="width: 100px; height: 100px;"
                                             src="{{'/file/uploads/workspace/avatars/'.$workspace->id.'.'.$workspace->avatar_type}}">
                                    @else
                                        <div
                                            style="width: 100px;height: 100px;padding-right: 5px;border-radius: 50%;display: inline-block;vertical-align: middle;background: {{$workspace->avatar_color}};position: relative">
                                            <span
                                                style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);color: white;font-family: 'Montserrat';font-style: normal;font-weight: 500;font-size: 56px;line-height: 78px;">
                                                {{$workspace->name[0]}}
                                            </span>
                                        </div>
                                    @endif

                                </div>
                                <div class="d-flex flex-column align-items-center pt-3">
                                    <p class="text-dark fw-bold mb-0"
                                       style="padding-bottom: 5px;">{{$workspace->owner->name}}</p>
                                    <p class="text-dark fw-bold mb-0">{{trans_choice('workspace.companies', $workspace->companies_count, ['value' => $workspace->companies_count])}}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-12 col-sm-6 col-md-6 col-xl-3 col-xxl-3">
                <a class="text-dark" href="{{route('workspace.create-company')}}">
                    <div class="list-document-effect p-2 h-100"
                         style="border: 1px dashed rgba(75, 70, 92, 0.16); border-radius: 6px;">
                        <div class="card-body h-100">
                            <div class="d-flex justify-content-center align-items-center flex-column h-100  gap-1"
                                 style="min-height: 231px">
                                <div class="card-avatar">
                                    <img src="{{asset('assets/icons/plus-lg.svg')}}">
                                </div>
                                <div>
                                    <h5 class="card-text fw-bolder text-center">Додати робоче середовище</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        @if(count($requests))
            <div class="row justify-content-start m-0 gy-1" id="">
                <div class="workspace-row-title pt-1">
                    <h4 class="fw-bolder">Запити на долучення</h4>
                </div>

                @foreach($requests as $request)
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 col-xxl-3">
                        <div class="list-document-effect d-flex flex-column justify-content-between p-2"
                             style="border: 1px solid rgba(75, 70, 92, 0.16); border-radius: 6px;">

                            <div>
                                <div class="dropstart">
                                    <i data-feather='x' data-bs-toggle="modal"
                                       data-bs-target="#cancelWorkspaceRequest-{{$request->company->workspace->id}}"
                                       style="position: absolute; right: 10px; transform: scale(1.5);"></i>
                                </div>
                                <div class="d-flex flex-column align-items-center">
                                    <div>
                                        <h4 class="pb-1 fw-bolder">{{$request->company->workspace->name}}</h4>
                                    </div>
                                    <div>
                                        @if (!is_null($request->company->workspace->avatar_type))
                                            <img style="width: 100px; height: 100px;"
                                                 src="{{'/file/uploads/workspace/avatars/'.$request->company->workspace->id.'.'.$request->company->workspace->avatar_type}}">
                                        @else
                                            <div
                                                style="width: 100px;height: 100px;padding-right: 5px;border-radius: 50%;display: inline-block;vertical-align: middle;background: {{$request->company->workspace->avatar_color}};position: relative">
                                            <span
                                                style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);color: white;font-family: 'Montserrat';font-style: normal;font-weight: 500;font-size: 56px;line-height: 78px;">
                                                {{$request->company->workspace->name[0]}}
                                            </span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-center" style="padding: 10px 0;">

                                        @if($request->status === 0)
                                            <span class="badge badge-light-primary p-50">
                                        В процесі погодження
                                    </span>
                                        @endif

                                    </div>
                                    <div class="d-flex flex-column align-items-center">
                                        <p class="text-dark fw-bold mb-0"
                                           style="padding-bottom: 5px;">{{$request->company->workspace->owner->surname.' '
                                            .mb_substr($request->company->workspace->owner->name,0,1).'.'
                                            .mb_substr($request->company->workspace->owner->patronymic,0,1)}}</p>
                                        <p class="text-dark fw-bold mb-0">{{$request->company->email}}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Modal workspace request cancel start-->
                    <div class="modal fade" id="cancelWorkspaceRequest-{{$request->company->workspace->id}}"
                         tabindex="-1"
                         aria-labelledby="exampleModalCenterTitle"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content py-1">
                                <div class="modal-header">
                                    <h4 class="modal-title fw-bolder" id="exampleModalCenterTitle">Скасувати запит на
                                        приєднання
                                        до робочого середовища “{{$request->company->workspace->name}}”?</h4>
                                </div>
                                <div class="modal-body pt-0">
                                    <p>Ви дійсно хочете скасувати запит на приєднання до цього робочого середовища?</p>
                                </div>
                                <div class="modal-footer" style="border-top: none;">
                                    <button type="button" class="btn btn-flat-secondary" data-bs-dismiss="modal">
                                        Скасувати
                                    </button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Скасувати
                                        запит
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal workspace request cancel end-->
                @endforeach
            </div>
        @endif

        @if(count($userToCompanyRequests))
            <div class="row mx-0 justify-content-start m-0 gy-1" id="">
                <div class="workspace-row-title pt-1">
                    <h4 class="fw-bolder">Запрошення</h4>
                </div>

                @foreach ($userToCompanyRequests as $req)
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 col-xxl-3">
                        <div class="list-document-effect border-1 d-flex flex-column justify-content-between p-2"
                             style="border: 1px solid rgba(75, 70, 92, 0.16); border-radius: 6px;">
                            <div class="">
                                <div class="d-flex flex-column align-items-center">
                                    <div>
                                        <p class="pb-1 text-dark fw-bold">{{$req->company->workspace->name}}</p>
                                    </div>
                                    <div>

                                        @if (!is_null($req->user->avatar_type))
                                            <img style="width: 100px; height: 100px;"
                                                 src="{{'/file/uploads/user/avatars/'.$req->user->id.'.'.$req->user->avatar_type}}">
                                        @else
                                            <div
                                                style="width: 100px;height: 100px;padding-right: 5px;border-radius: 50%">
                                                <img style="width: 100px; height: 100px;"
                                                     src="{{asset("assets/images/avatar_empty.png")}}">
                                            </div>
                                        @endif

                                    </div>

                                    <div class="d-flex flex-column align-items-center pt-2">
                                        {{$req->user->name.' '.$req->user->surname}}
                                    </div>

                                    <div
                                        class="d-flex flex-wrap justify-content-between align-items-center w-100 gap-1 pt-1">
                                        <button class="btn flex-grow-1 btn-outline-danger user-unapprove"
                                                data-user="{{$req->user->id}}" data-company="{{$req->company->id}}">
                                            Відхилити
                                        </button>

                                        <button class="btn flex-grow-1 btn-primary user-approve"
                                                data-user="{{$req->user->id}}" data-company="{{$req->company->id}}">
                                            Погодитись
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        @endif
    </div>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/entity/workspace/workspace-settings.js')}}"></script>
@endsection
