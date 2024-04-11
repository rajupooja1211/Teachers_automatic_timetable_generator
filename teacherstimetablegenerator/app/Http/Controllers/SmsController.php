<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    
    public function sms(){
        
        return view('sms.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'time' => 'required',
            'day' => 'required',
            'class' => 'required',
            'subject' => 'required',
            'phoneno'=>'required'
        ];

        

        $this->validate($request, $rules);

        $time = $request->time;
        $day = $request->day;
        $class = $request->class;
        $subject= $request->subject;
        $phoneno= $request->phoneno;
        DB::insert("insert into sms (time,day,class,subject,phoneno) values('$time','$day','$class','$subject','$phoneno')");
    

        return redirect('/sms');
    }


    public function sendSmsNotificaition()
    {

        

        $timenow=now()->format('H:i');
        $daynow=now()->format('l');

        $sms = DB::select('select * from sms');
        foreach($sms as $sm){
            $time=$sm->time;
            $day=$sm->day;
            $phoneno=$sm->phoneno;
            $class=$sm->class;
            $subject=$sm->subject;
            

            //redirect ('/sendsms',compact('time','day','phoneno','class','subject'));
            
            if($timenow=="$time" && $daynow=="$day")
            {   
                $sid = getenv("TWILIO_SID");
                $token = getenv("TWILIO_TOKEN");
                $sendernumber=getenv("TWILIO_PHONE");
                $twilio = new Client($sid, $token);
                $message = $twilio->messages
                ->create("+91'$phoneno'", // to
                         [
                             "body" => "Reminder! You have $class $subject at $time today",
                             "from" =>$sendernumber,
                         ]
                );

                return redirect('/sms');
             }

             else{
                return redirect('/sms');
             }
            }
        
           

            
        }
        



   
}
