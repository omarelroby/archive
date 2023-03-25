@extends('layouts.layout.master')
@section('page_name','Continents List')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left">

                <a href="{{url('admin/files/create')}}" class="btn btn-danger font-weight-bold py-3 px-6">
                    <i class="la la-plus"></i>
                    إضافة مستند
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
                                    <th>رقم المعاملة</th>
                                    <th>نوع المستند</th>
                                    <th>نوع المعاملة</th>
                                    <th>الأهمية</th>
                                    <th>الرد على الوثيقة</th>
                                    <th>حالات المتابعة</th>
                                    <th>الجهة</th>
                                    <th>التاريخ</th>
                                    <th>عرض الملفات</th>
                                    <th>العمليات</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($files as $key=>$file)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$file->name}}</td>
                                        <td>{{$file->file_number}}</td>
                                        <td>{{$file->document->name}}</td>
                                        <td>{{$file->transaction}}</td>
                                        <td>{{$file->priority}}</td>
                                        <td>{{$file->reply}}</td>
                                        <td>{{$file->revision}}</td>
                                        <td>{{$file->parties->name}}</td>
                                        <td>{{$file->import_date}}</td>
                                        <td>      <a  href="{{route('files.show',$file->id)}}" class="btn btn-primary"  >عرض الملفات</a></td>

                                    <td>

                                        <form class="myform" action="{{route('files.destroy',$file->id)}}" id="2"  method="post" >
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <a href="{{route('files.edit',$file->id)}}" class="btn btn-icon btn-sm btn-success"><i class="la la-edit"></i></a>
                                            <button type="submit" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash"></i></button>
                                        </form>

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
