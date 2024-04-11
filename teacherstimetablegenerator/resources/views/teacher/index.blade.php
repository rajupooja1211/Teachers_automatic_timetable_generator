@extends('layouts.teacherapp')

@section('title')
Teacher Dashboard
@endsection

@section('content')
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 page-container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 page-title">
            <h1><span class="fa fa-dashboard"></span>Teacher Dashboard</h1>
        </div>
    </div>

    <div class="page-body menubar">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row cards-container">
                    
                    <p style="text-align:center;">Hello {{Auth::user()->name}} </p>
                    
                       
                </div>
            </div>
        </div>
    </div>
    


    <div id="resource-container">
        @include('teacher.timetables')
    </div>
</div>
@include('teacher.modals')
@endsection

@section('scripts')
<script src="{{URL::asset('/js/teacher/index.js')}}"></script>
@endsection