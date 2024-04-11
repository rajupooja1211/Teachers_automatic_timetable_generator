<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @if (count($timetables))
        <table class="table table-bordered">
            <thead>
                
                <tr class="table-head">
                    <th style="width:5%"></th>
                    @foreach($timeslots as $timeslot)
                    <th style="width:5%">{{$timeslot->time}}</th>
                    @endforeach
                </tr>
                
            </thead>

            <tbody>
                @foreach($days as $day)
                <tr>
                    <td>{{$day->name}}</td>
                    
                    
                   
                </tr>

                @endforeach
            </tbody>
        </table>
         
        @else
        <div class="no-data text-center">
            <p>No matching data was found</p>
        </div>
        @endif
    </div>
</div>