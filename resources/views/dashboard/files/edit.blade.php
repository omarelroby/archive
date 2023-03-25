@extends('layouts.layout.master')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            @include('dashboard.includes.alerts.success')
            @include('dashboard.includes.alerts.errors')

        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-block">
                    <div class="card-body">
                        <form method="post"  action="{{route('files.update',$file->id)}} " >
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>رقم المعاملة</label>
                                        <input type="text" required value="{{$file->file_number}}" name="file_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>اسم المعاملة </label>
                                        <input type="text" value="{{$file->name}}" required name="name" class="form-control">
                                    </div>
                                </div>





                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> التاريخ </label>
                                        <input type="date" required value="{{$file->import_date}}" name="import_date" class="form-control">
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>نوع المستند</label>
                                        <select type="text"  name="document_type_id" class="form-control">
                                            <option value="">اختيار نوع المستند</option>
                                            @foreach($docs as $doc)
                                                <option
                                                   @if($doc->id==$file->document_type_id)selected @endif value="{{$doc->id}}">{{$doc->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>نوع المعاملة</label>
                                        <select type="text"  name="transaction" class="form-control">
                                            <option @if($file->transaction=='صادر')selected @endif value="صادر">صادر</option>
                                            <option @if($file->transaction=='وارد')selected @endif value="وارد">وارد</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>درجة الأهمية</label>
                                        <select type="text"  name="priority" class="form-control">
                                            <option @if($file->priority=='قصوى')selected @endif value="قصوى">قصوى</option>
                                            <option @if($file->priority=='متوسطة')selected @endif value="متوسطة">متوسطة</option>
                                            <option @if($file->priority=='عادية')selected @endif value="عادية">عادية</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">


                                        <label>

                                            مطلوب الرد على الوثيقة

                                        </label>
                                        <select type="text"  name="reply" class="form-control">
                                            <option @if($file->reply=='غير مطلوب الرد')selected @endif value="غير مطلوب الرد">غير مطلوب الرد</option>
                                            <option @if($file->reply=='تم الرد')selected @endif value="تم الرد">تم الرد</option>
                                            <option @if($file->reply=='مطلوب الرد')selected @endif value="مطلوب الرد">مطلوب الرد</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>حالات المتابعة</label>
                                        <select type="text"  name="revision" class="form-control">
                                            <option @if($file->revision=='مغلق')selected @endif value="مغلق">مغلق</option>
                                            <option @if($file->revision=='تحت المراجعة')selected @endif  value="تحت المراجعة">تحت المراجعة</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>وارد من\صادر الي</label>
                                        <select type="text"  name="parties_id" class="form-control">
                                            <option value="">اختيار الجهة</option>
                                            @foreach($parties as $part)
                                                <option
                                                    @if($part->id==$file->parties_id)selected @endif value="{{$part->id}}">{{$part->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>الموظفين</label>
                                        <select multiple type="text"  name="parts_id[]" class="form-control">
                                            <option value="">اختيار الموظفين</option>
                                            @foreach($Boards as $board)
                                                <option @if(in_array($board->id,$fboards))selected @endif value="{{$board->id}}">{{$board->name}}</option>
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
