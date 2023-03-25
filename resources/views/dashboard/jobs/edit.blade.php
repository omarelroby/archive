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
                        <form method="post"  action="{{route('jobs.update',$job->id)}} " >
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="row">



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>المسمي الوظيفي</label>
                                        <input type="text" value="{{$job->name}}" required name="name" class="form-control">
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>نوع الإدارات</label>
                                        <select type="text"  name="administration_id" class="form-control">
                                            <option value="">اختيار نوع الإدارة</option>
                                            @foreach($administrations as $administration)
                                                <option
                                                  @if($administration->id==$job->administration_id) selected @endif  value="{{$administration->id}}">{{$administration->name}}</option>
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
