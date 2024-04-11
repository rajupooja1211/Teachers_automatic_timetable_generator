
<p style="text-align:center;margin-top:100px;">Hello {{Auth::user()->name}} </p>
                


<div class="container" style="margin-left: 25%;">
    <div class="row" >
        <div class="col-xs-12 col-md-4 col-sm-8  col-md-offset-4 col-sm-offset-2">
            <div id="activation-form-container" style="border:solid;">
                <div class="login-form-header" style="background:#a72f1a;">
                    <h3 style="text-align: center;background:#a72f1a;">Add Timeslots</h3>
                </div>

                             <form class="form" method="POST" action="{{ URL::to('/sms') }}">
                                {!! csrf_field() !!}
                                @include('errors.form_errors')
                                <div class="modal-body">

                                    
                                <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="select2-wrapper">
                                    <label>Time</label>
                                    <input type="time" class="form-control" name="time" >
                                </div>
                                </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="select2-wrapper">
                                        <label>Day</label>
                                        <input type="day" class="form-control" name="day" >
                                    </div>
                                    </div>
                                    </div>
                               

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="select2-wrapper">
                                        <label>Class</label>
                                    <input type="text" class="form-control"  name="class">
                                </div>
                                </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="select2-wrapper">
                                    <label>Subject</label>
                                    <input type="text" class="form-control"  name="subject">
                                </div>
                                </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="select2-wrapper">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control"  name="phoneno">
                                </div>
                                </div>
                                </div>

                                

                            

                                <div class="form-group">
                                    <input type="submit" name="submit" value="Add Slots" class="btn btn-lg btn-block btn-primary">
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>