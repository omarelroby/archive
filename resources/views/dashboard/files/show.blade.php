@extends('layouts.layout.master')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left">


            </div>
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-block">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="indexTable" class="table ss table-bordered table-striped datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($files as $key=>$file)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td><a href="{{route('admin.files.status',$file->id)}}" target="_blank">عرض</a></td>

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
