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
                            <form method="post" enctype="multipart/form-data" action="{{route('files.store')}} ">
                                @csrf

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>رقم المعاملة</label>
                                            <input type="text" required
                                                   value="{{\App\Models\Files::orderBy('id','desc')->first()->id+1??1}}"
                                                   name="file_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>اسم المعاملة </label>
                                            <input type="text" required name="name" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>التاريخ </label>
                                            <input type="date" required name="import_date" class="form-control">
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>نوع المستند</label>
                                            <select type="text" name="document_type_id" class="form-control">
                                                <option value="">اختيار نوع المستند</option>
                                                @foreach($docs as $doc)
                                                    <option value="{{$doc->id}}">{{$doc->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>الملفات</label>
                                            <input type="file" multiple name="doc_files[]" accept="application/pdf"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>نوع المعاملة</label>
                                            <select type="text" required name="transaction" class="form-control">

                                                <option value="">اختر</option>
                                                <option value="صادر">صادر</option>
                                                <option value="وارد">وارد</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>درجة الأهمية</label>
                                            <select type="text" required name="priority" class="form-control">
                                                <option value="">اختر درجة الأهمية</option>
                                                @foreach($importances as $importance)
                                                <option value="{{$importance->name}}">{{$importance->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>حالات المتابعة</label>
                                            <select type="text" required name="revision" class="form-control">
                                                <option value="">اختر حالة المتابعة</option>
                                                    @foreach($follows as $follow)
                                                <option value="{{$follow->name}}">{{$follow->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>مطلوب الرد على الوثيقة</label>
                                            <select type="text" required name="reply" class="form-control">
                                                <option value="">اختر</option>
                                                    @foreach($response as $resp)
                                                <option value="{{$resp->name}}">{{$resp->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>وارد من\صادر الي</label>
                                            <select type="text" required name="parties_id" class="form-control">
                                                <option value="">اختيار الجهة</option>

                                                @foreach($parties as $part)
                                                    <option value="{{$part->id}}">{{$part->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>الموظفين</label>
                                            <select multiple type="text" id="parts_id" required name="parts_id[]" class="form-control">
                                                <option value="">اختيار الموظفين</option>
                                                @foreach($boards as $board)
                                                    <option value="{{$board->id}}">{{$board->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <button type="submit"
                                                class="btn btn-primary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u">
                                            حفظ
                                        </button>
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
