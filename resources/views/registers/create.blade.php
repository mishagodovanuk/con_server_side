@extends('layouts.admin')
@section('title','')

@section('content')

    <div id="data_tab_1">
        <div class="card mx-2">
            <div class="card-header">
                <h4 class="card-title">Cтворення реєстру</h4>
            </div>
            <div class="card-body my-25">
                <form method="post" action="{{route('register.store')}}">
                    @csrf
                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label">Назва авто</label>
                        <input type="text" class="form-control" name="auto_name">
                    </div>
                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label">Час</label>
                        <input type="text" class="form-control" name="arrive">
                    </div>
                    <input type="submit" class="btn btn-primary">
                </form>

            </div>
@endsection

