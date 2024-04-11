<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardService;

use App\Models\Day;
use Twilio\Rest\Client;
use App\Models\User;
use App\Models\Timetable;
use App\Models\AcademicPeriod;
use App\Models\Timeslot;
use App\Models\Course;
use App\Models\Professor;
use App\Models\ProfessorSchedule;

class TeacherDashboardController extends Controller
{
    /**
     * Create a new instance of this controller
     *
     */
    public function __construct(DashboardService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
       
    }

    /**
     * Show the application's dashboard
     */
    public function index()
    {
        $data = $this->service->getData();
        $timetables = Timetable::orderBy('created_at', 'DESC')->paginate(10);
        $users=User::all();
        $days = Day::all();
        $timeslots=Timeslot::all();
        $courses=Course::all();
        $professors=Professor::all();
        $professorschedules=ProfessorSchedule::all();
        $academicPeriods = AcademicPeriod::all();
        return view('teacher.index', compact('timeslots','users','professors','professorschedules','courses','data', 'timetables', 'days', 'academicPeriods'));
    }



    
}
