@extends('layouts.layout.master')
@section('page_name','Continents List')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

            <div class="content-header-left">
                <div class="alert alert-danger" id="success-msg" style="display: none;">تم الحذف بنجاح </div>

                <a href=" {{route('create.subcategory')}}" class="btn btn-danger font-weight-bold py-3 px-6">
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
                                    <th># of subcategories</th>
                                    <th>photo</th>
                                    <th>processes</th>

                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subCat as $category)
                                    <tr>
                                    <tr class="sub_category{{$category->id}}">
                                    <th scope="row">{{$category->id}}</th>
                                    <td>{{$category->subCategory_name}}</td>
                                    <td>{{$category->subCategory_types}}</td>
                                    <td><img style="width: 100px" src="{{$category->photo}}"></td>
                                    <td>
                                        <form class="myform"  id="2"  method="post"  action="#">
                                            <a href="{{route('edit.subcategory',$category->id)}}" class="btn  btn-sm btn-success">تعديل أجاكس</i></a>
                                            <a href="{{route('delete.category',$category->id)}}" class="btn btn-icon btn-sm btn-danger"><i class="la la-trash"></i></a>
                                            <a href=" " sub_id="{{$category->id}}"  class="delete_btn btn-sm btn-danger">حذف أجاكس</a>
                                        </form>

                                    </td>
                                    </tr>
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

@endsection
@section('scripts')
<script>
    $(document).on('click','.delete_btn',function (e) //id of button submit
    {
        e.preventDefault();
        var sub_cat =$(this).attr('sub_id'); //to get id and save it in sub_cat
        $.ajax({
            type:'post',
            url:"{{route('delete.subcategory')}}",
            data:{'_token':"{{csrf_token()}}",
                'id': sub_cat
            },
            success:function (data){
                if(data.status==true){
                    $('#success-msg').show();
                }
                $('.sub_category'+data.id).remove();  //to remove without reload by remove all row
            },
            error:function (reject){
            },
        });
    });
</script>
@stop
