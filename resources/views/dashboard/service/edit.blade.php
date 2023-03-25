@extends('layouts.layout.master')
@section('page_name','Add Continent')
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
                        <form method="post" enctype="multipart/form-data" action="{{route('service.update',$service->id)}} ">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>اسم الخدمة</label>
                                        <input type="text" value="{{$service->name}}" required name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>تفاصيل الخدمة</label>
                                        <input type="text" value="{{$service->details}}" required name="details" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail"> اختر صورة العرض</label>
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit"
                                            class="btn btn-primary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u">Save</button>
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
