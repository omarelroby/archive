@extends('layouts.layout.master')
@section('page_name','Continents List')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left">

                <a href="{{route('admin.category')}}" class="btn btn-danger font-weight-bold py-3 px-6">
                    <i class="la la-plus"></i>
                    Add Category
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
                                    <th>Name</th>
                                    <th>photo</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->category_name}}</td>
                                    <td><img style="width: 100px" src="{{$category->photo}}"></td>
                                    <td>
                                        <form class="myform"  id="2"  method="post"  action="#">
                                            <a href="{{route('edit.category',$category->id)}}" class="btn btn-icon btn-sm btn-success"><i class="la la-edit">تعديل</i></a>
                                            <a href="{{route('delete.category',$category->id)}}" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash"></i></a>
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
