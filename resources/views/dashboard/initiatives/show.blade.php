@extends('layouts.layout.master')
@section('page_name','Continents List')
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
                                    <th>الصورة</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($others as $key=>$other)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td><img style="width: 200px;" src="{{$other->other_photo}}"></td>
                                    </tr>
                                @endforeach

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
