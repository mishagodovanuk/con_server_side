@extends('layouts.admin')
@section('title','')
@section('page-style')


@endsection
@section('before-style')
    <link rel="stylesheet" type="text/css"
          href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mx-2">
                    <div class="card-body row">
                        <div class="col-2">
                            <div class="border rounded px-1 py-3">
                                <img src="{{ $company->img_type? asset('uploads/company/image/'.$company->id.'.'.$company->img_type)
                : asset('assets/icons/empty-company.svg') }}" max-width="200px" width="100%" alt="company-logo">
                            </div>
                        </div>
                        <div class="col-3 d-flex flex-column">
                            <div class="f-15 fw-4">
                                Тип компанії
                            </div>
                            <div class=" f-15 fw-4 mt-2">
                                {{$company->type->key === 'legal' ? 'Назва' : 'Власник'}}
                            </div>
                            <div class=" f-15 fw-4 mt-2">
                                Адреса
                            </div>
                        </div>

                        <div class="col-5 d-flex flex-column">
                            <div class="f-15 fw-6">
                                {{$company->type->name}}
                            </div>
                            <div class="f-15 fw-6 mt-2">
                                {{$company->type->key === 'legal' ? 'Назва' : 'Власник'}}
                            </div>
                            <div class="f-15 fw-6 mt-2">
                                {{$company->address->settlement->name.', '.$company->address->street->name.
                               ' '.$company->address->building_number}}{{$company->address->apartment_number
                               ? ', квартрира '.$company->address->apartment_number :''}}
                            </div>
                        </div>

                        <div class="col-8 pe-3">
                            <h3 class="my-2">Про компанію:</h3>
                            <div class="lh-base text-justify">
                                {{$company->about}}
                            </div>

                            <div class="card-body p-0">
                                <!-- Outline buttons -->
                                <div class="demo-inline-spacing">
                                    <a href="{{route('company.edit',['company'=>$company->id])}}" class="btn btn-green">
                                        Редагувати профіль
                                    </a>
                                    <form action="{{route('company.destroy',['company'=>$company->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-flat-danger">Деактивувати</button>
                                    </form>
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
    <script src="{{asset('vendors/js/ui/jquery.sticky.js')}}"></script>
    <script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>

    <script src="{{asset('/js/scripts/tables/table-datatables-advanced.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('#example-1').dataTable({
                select: true
            });
            $('#example-2').dataTable({
                select: true
            });
            $('#example-3').dataTable({
                select: true
            });
        });
    </script>
    </script>
@endsection
