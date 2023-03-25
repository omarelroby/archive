@extends('layouts.master')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-block">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data"  action="{{route('files.store')}} " >
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>اسم المستند </label>
                                        <input type="text" required name="name" class="form-control">
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>رقم المستند</label>
                                        <input type="text" required name="file_number" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>تاريخ الوارد</label>
                                        <input type="date" required name="import_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>تاريخ الصادر</label>
                                        <input type="date" required name="export_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>نوع المستند</label>
                                        <select type="text"  name="document_type_id" class="form-control">
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
                                        <input type="file" multiple  name="doc_files[]" accept="application/pdf"  class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>الجهة</label>
                                        <select type="text"  name="parties_id" class="form-control">
                                            <option value="">اختيار الجهة</option>
                                            @foreach($parties as $part)
                                                <option value="{{$part->id}}">{{$part->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>اعضاء مجلس الإدارة</label>
                                        <select multiple type="text"  name="parts_id[]" class="form-control">
                                            <option value="">اختيار الأعضاء</option>
                                            @foreach($boards as $board)
                                                <option value="{{$board->id}}">{{$board->name}}</option>
                                            @endforeach
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
<!-- ////////////////////////////////////////////////////////////////////////////-->

@endsection
