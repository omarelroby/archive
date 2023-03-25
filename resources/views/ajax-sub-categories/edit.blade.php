@extends('layouts.layout.master')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">

            </div>
            <div class="content-body">
                <div class="alert alert-success" id="success-msg" style="display: none;">تم الحفظ بنجاح </div>
                <div class="card">
                    <div class="card-block">
                        <div class="card-body">
                            <form method="post" id="update-ajax" action=" " enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>subCategory_name</label>
                                            <input type="text" required name="subCategory_name" value="{{$sub_cat->subCategory_name}}" class="form-control">
                                            <input type="text" required name="sub_cat_id" value="{{$sub_cat->id}}" class="form-control" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>subCategory_types</label>
                                            <input type="text" required name="subCategory_types" value="{{$sub_cat->subCategory_types}}" class="form-control">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail"> اختر صورة العرض</label>
                                            <input type="file" class="form-control" value="{{$sub_cat->photo}}" name="photo">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button id="update_sub"
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

@section('scripts')
    <script>
        $(document).on('click','#update_sub',function (e) //id of button submit
        {
            e.preventDefault();
            var formData=new FormData($('#update-ajax')[0]); //get all form data by form id
            $.ajax({
                type:'post',
                enctype:'multipart/form-data',
                url:"{{route('update.subcategory')}}",
                data: formData,
                processData:false,
                contentType:false,
                cache:false,
                success:function (data)  //this returned all data from response()->json() in controller

                {
                    if(data.status==true){
                        $('#success-msg').show();
                    }

                },
                error:function (reject){
                },
            });
        });

    </script>

@stop
