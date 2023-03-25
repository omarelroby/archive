@extends('layouts.layout.master')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-block">
                    <div class="card-body">
                        <form method="post" autocomplete="false" autofocus="false" enctype="multipart/form-data" action="{{route('BoardOfDirectors.store')}} " >
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>الإسم </label>
                                        <input type="text" required name="name" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>الرقم الوظيفي</label>
                                        <input type="text" required name="job_number" class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>صورة التوقيع</label>
                                        <input type="file"  name="photo" accept="image/*" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>رقم الجوال</label>
                                        <input type="text" required name="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>البريد الالكتروني</label>
                                        <input type="text" required name="email" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>كلمة المرور</label>
                                        <input type="password" required name="password" class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>تاكيد كلمة المرور</label>
                                        <input type="password" required name="password_confirmation" class="form-control">
                                    </div>
                                </div>





                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>الإدارات</label>
                                        <select type="text" required name="position" onchange="select_admin(this);" class="form-control">
                                            <option  selected value=""  >اختر الادارة</option>
                                            @foreach($positions as $position)
                                                <option value="{{$position->id}}">{{$position->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName" class="control-label">المنصب</label>
                                        <select id="job_id"  name="job_id" class="form-control">
                                        </select>
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <button type="submit"
                                            class="btn btn-primary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u">حفظ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function select_admin(elem)
    {
        var admin_id=$(elem).val();
        var opt='<option selected="true" value="" disabled="disabled">اختر الوظيفة</option>';

        $.ajax({
            url: '{{url('admin/get_job')}}'+'/'+admin_id,
            type: 'get',
            success:function (data) {
                console.log(data);

                $('#job_id').empty();
                for (var x=0;x<data.length; x++){
                    opt+='<option value="'+data[x].id+'">'+data[x].name+'</option>';
                }
                $('#job_id').append(opt);


            }
        });

    }
</script>
@endsection
