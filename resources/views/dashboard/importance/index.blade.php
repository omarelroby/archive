@extends('layouts.layout.master')
@section('page_name','Continents List')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left">

                <a href="{{url('admin/importance/create')}}" class="btn btn-danger font-weight-bold py-3 px-6">
                    <i class="la la-plus"></i>
                    إضافة درجة أهمية
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
                                    <th>العمليات</th>



                                </tr>
                                </thead>
                                <tbody>
                                @foreach($importances as $key=>$importance)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$importance->name}}</td>


                                    <td>

                                        <form class="myform" action="{{route('importance.destroy',$importance->id)}}" id="2"  method="post" >
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <a href="{{route('importance.edit',$importance->id)}}" class="btn btn-icon btn-sm btn-success"><i class="la la-edit"></i></a>
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
