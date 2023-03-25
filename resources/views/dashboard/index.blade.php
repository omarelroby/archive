@extends('layouts.layout.master')
@section('page_name','Continents List')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left">

                <a href=" " class="btn btn-danger font-weight-bold py-3 px-6">
                    <i class="la la-plus"></i>
                    Addssss product
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
                                    <th>Quantiy</th>
                                    <th>photo</th>
                                    <th>operations</th>


                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
{{--                                @foreach($products as $product)--}}
                                    <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td><img style="width: 200px;" src=" "></td>
                                    <td>
{{--                                        <form class="myform"  id="2"  method="post"  action="#">--}}
{{--                                            <a href="{{route('edit.product',$product->id)}}" class="btn btn-icon btn-sm btn-success"><i class="la la-edit"></i></a>--}}
{{--                                            <a href="{{route('delete.product',$product->id)}}" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash"></i></a>--}}
{{--                                        </form>--}}

                                    </td>
{{--                                        @endforeach--}}

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
