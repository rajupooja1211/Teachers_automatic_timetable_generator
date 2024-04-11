<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\TimetableService;
use App\Events\TimetablesRequested;
use App\Models\CollegeClass;
use App\Models\Course;
use App\Models\Day;
use App\Models\Professor;
use App\Models\Room;
use App\Models\Timeslot;
use App\Models\Timetable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Create a new instance of this controller and set up
     * middlewares on this controller methods
     */
    public function __construct(TimetableService $service)
    {
        $this->service = $service;
        $this->middleware('auth', ['except' => ['export']]);
        $this->middleware('activated', ['except' => ['export']]);
    }

    /**
     * Handle ajax request to load timetable to populate
     * timetables table on dashboard
     *
     */
    public function index()
    {
        $timetables = Timetable::orderBy('created_at', 'DESC')->paginate(10);

        return view('dashboard.timetables', compact('timetables'));
    }

    /**
     * Create a new timetable object and hand over to genetic algorithm
     * to generate
     *
     * @param Illuminate\Http\Request $request The HTTP request
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'academic_period_id' => 'required',
            'phoneno'=>'required'
        ];

        $messages = [
            'academic_period_id.required' => 'An academic period must be selected'
        ];

        $this->validate(request(), $rules, $messages);

        $errors = [];
        $dayIds = [];

        $days = Day::all();

        foreach ($days as $day) {
            if ($request->has('day_' . $day->id)) {
                $dayIds[] = $day->id;
            }
        }

        if (!count($dayIds)) {
            $errors[] = 'At least one day should be selected';
        }

        if (count($errors)) {
            return Response::json(['errors' => $errors], 422);
        }

        $otherChecks = $this->service->checkCreationConditions();

        if (count($otherChecks)) {
            return Response::json(['errors' => $otherChecks], 422);
        }

        $timetable = Timetable::create([
            'user_id' => Auth::user()->id,
            'academic_period_id' => $request->academic_period_id,
            'status' => 'IN PROGRESS',
            'name' => $request->name
        ]);

        if ($timetable) {
            $timetable->days()->sync($dayIds);
        }

        event(new TimetablesRequested($timetable));

        return Response::json(['message' => 'Timetables are being generated.Check back later'], 200);
    }

    /**
     * Display a printable view of timetable set
     *
     * @param int $id
     */
    public function view($id)
    {
        $timetable = Timetable::find($id);

        if (!$timetable) {
            return redirect('/');
        } else {
            $path = $timetable->file_url;
            $timetableData =  Storage::get($path);
            $timetableName = $timetable->name;
            return view('timetables.view', compact('timetableData', 'timetableName'));
        }
    }

    public function export()
    {

        $academicPeriodId = 1;
        $groupIds =  DB::table("courses_classes")->where("academic_period_id", $academicPeriodId)->select("class_id")->get()->pluck("class_id");
        $moduleIds = DB::table("courses_classes")->where("academic_period_id", $academicPeriodId)->select("course_id")->get()->pluck("course_id");


        $professors = Professor::query()->with(['unavailable_timeslots'])->get()
            ->map(function ($item) {
                return [
                    "professorId" => $item->id,
                    "professorName" => $item->name,
                    "unavailableTimeslotIds" => $item->unavailable_timeslots->pluck('id')
                ];
            });
        $rooms = Room::query()->get()
            ->map(function ($item) {
                return [
                    "roomId" => $item->id,
                    "roomName" => $item->name,
                    "capacity" => $item->capacity
                ];
            });
        $timeslots =  Timeslot::query()->get()
            ->map(function ($item) {
                return [
                    "timeslotId" => $item->id,
                    "timeslot" => $item->time
                ];
            });
        $groups = CollegeClass::query()->with([
            'unavailable_rooms',
            'courses' => function ($query)  use ($moduleIds) {
                return $query->whereIn("courses.id", $moduleIds);
            }
        ])->whereIn("id", $groupIds)->get()
            ->map(function ($item) {
                return [
                    "groupId" => $item->id,
                    "groupSize" => $item->size,
                    "moduleIds" => $item->courses->pluck('id'),
                    "unauthorizedRoomIds" => $item->unavailable_rooms->pluck('id'),
                ];
            });
        $modules = Course::query()->with(['professors'])->whereIn("id", $moduleIds)->get()
            ->map(function ($item) {
                return [
                    "moduleId" => $item->id,
                    "moduleName" => $item->name,
                    "moduleCode" => $item->course_code,
                    "professorIds" => $item->professors->pluck('id')
                ];
            });



        return [
            "professors" => $professors,
            "rooms" => $rooms,
            "timeslots" => $timeslots,
            "groups" => $groups,
            "modules" => $modules
        ];
    }
}
