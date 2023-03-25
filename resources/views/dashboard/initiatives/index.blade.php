@extends('layouts.layout.master')
@section('page_name','Continents List')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left">

                <a href="{{route('initiatives.create')}} " class="btn btn-danger font-weight-bold py-3 px-6">
                    <i class="la la-plus"></i>
                    إضافة مبادرة
                </a>
            </div>
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-block">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="indexTable" class="table table-bordered table-striped datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>التفاصيل</th>
                                    <th>التاريخ</th>
                                    <th>المكان</th>
                                    <th>الصورة</th>
                                    <th style="text-align: center;">صور أخرى</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($initiatives as $key=>$initiative)
                                    <tr>
                                    <td> {{++$key}}</td>
                                    <td>{{$initiative->name}} </td>
                                    <td>{{$initiative->details}} </td>
                                    <td>{{$initiative->date}} </td>
                                    <td>{{$initiative->location}} </td>
                                    <td><img style="width: 200px;" src="{{$initiative->photo}} "></td>

                                    <td>
                                        <a href="{{route('initiatives.show',$initiative->id)}}" type="button" class="btn btn-primary">عرض صور أخرى للمبادرة</a>
                                    </td>
                                    <td>
{{--                                        <form class="myform"   method="post"  action="{{route('service.destroy',$service->id)}}">--}}
{{--                                            @csrf--}}
{{--                                            {{ method_field('DELETE') }}--}}
{{--                                            <a href="{{route('service.edit',$service->id)}}" class="btn btn-icon btn-sm btn-success"><i class="la la-edit"></i></a>--}}
{{--                                            <button type="submit"  class="btn btn-icon btn-sm btn-danger"><i class="la la-trash"></i></button>--}}
{{--                                        </form>--}}

                                    </td>
                                        @endforeach

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->



<script>
    $(document).ready(function() {

        $('.myform').submit(function() {
            if (confirm('Are you sure?')) {

                return true;
            }
            else
            {
                return false;
            }

            // your code here
        });
    });
</script>
@endsection
