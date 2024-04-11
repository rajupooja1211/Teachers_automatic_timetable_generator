@extends('layouts.teacherapp')

@section('title')
Periods
@endsection

@section('content')
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 page-container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 page-title">
            <h1><span class="fa fa-clock-o"></span> Periods</h1>
        </div>
    </div>

</div>



@include('sms.modals')
@endsection

@section('scripts')
<script src="{{URL::asset('/js/sms/index.js')}}"></script>
@endsection