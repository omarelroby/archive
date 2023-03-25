@extends('boards.layouts.master')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            @include('dashboard.includes.alerts.success')
            @include('dashboard.includes.alerts.errors')

        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-block">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{route('edit.update',$user->id)}} " >
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>الإسم </label>
                                            <input type="text" required value="{{$user->name}}" name="name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Photo</label>
                                            <input type="file"  name="photo" accept="image/*" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>الإيميل</label>
                                            <input type="text" value="{{$user->email}}" required name="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>الباسورد</label>
                                            <input type="password" required name="password" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <button type="submit"
                                                class="btn btn-primary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u">حفظ</button>
                                    </div>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

@endsection
