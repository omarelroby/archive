@extends('boards.layouts.master')
@section('page_name','Continents List')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

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
                                    <th>رقم المستند</th>
                                    <th>نوع المستند</th>
                                    <th>الجهة</th>
                                    <th>تاريخ الوارد</th>
                                    <th>تاريخ الصادر</th>
                                    <th style="width: 90px; text-align: center;">عرض الملفات</th>
                                    <th style="text-align: center;">تعديل الحالة</th>
                                    <th style="text-align: center;"> الحالة</th>



                                </tr>
                                </thead>
                                <tbody>
                                @foreach($files as $key=>$file)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$file->name}}</td>
                                        <td>{{$file->file_number}}</td>
                                        <td>{{$file->document->name}}</td>
                                        <td>{{$file->parties->name}}</td>
                                        <td>{{$file->import_date}}</td>
                                        <td>{{$file->export_date}}</td>
                                        <td>
                                            <a  href="{{route('boards.show',$file->id)}}" class="btn btn-primary"  >عرض الملفات</a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="{{route('enabled',$file->pivot->id)}}"   class="btn btn-primary">أوافق</a>
                                            <a href="{{route('disabled',$file->pivot->id)}}"   class="btn btn-danger">لا أوافق</a>
                                        </td>
                                        <td>


                                        @if ($file->pivot->status == 0)
                                                <span class="text-warning">في انتظار الرد</span>
                                            @elseif($file->pivot->status== 1)
                                                <span class="text-success">تمت الموافقة</span>
                                            @else
                                                <span class="text-danger">تم الرفض</span>
                                            @endif

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
