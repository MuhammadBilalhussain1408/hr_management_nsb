<?php

namespace App\Http\Controllers;

use App\Exports\AttandanceExport;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\DayOff;
use App\Models\Shift;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\LeaveAllocation;
use App\Models\Organization;
use Auth;
use SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

// set_time_limit(3600);

class AttendanceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:attendance-list|attendance-create|attendance-edit|attendance-delete|attendance-csv-upload|attendance-report', ['only' => ['index', 'show']]);
        $this->middleware('permission:attendance-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:attendance-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:attendance-delete', ['only' => ['destroy']]);
        $this->middleware('permission:attendance-csv-upload', ['only' => ['attendance-csv-upload']]);
        $this->middleware('permission:attendance-report', ['only' => ['attendance-report']]);
    }

    public function index(Request $request)
    {
        $user = Auth::user('id', 'name', 'email');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        $employee = Employee::where('email', $user->email)->select('id', 'email')->first();
        //dd($employee);
        //$today = date('Y-m-d');
        // $r_day = date('Y-m-d', strtotime('+1 day', strtotime($today)));
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $datas = Attendance::select(
                'attendances.id',
                'attendances.organization_id',
                'attendances.date',
                'attendances.checked_in',
                'attendances.checked_out',
                'attendances.status',
                'attendances.duration',
                'employees.fname as employee_fname',
                'employees.mid_name as employee_mid_name',
                'employees.lname as employee_lname',
                'employees.code ',
                'departments.name as department_name',
                'designations.name as designation_name'
            )
                ->join('employees', 'attendances.employee_id', '=', 'employees.id')
                ->join('departments', 'attendances.department_id', '=', 'departments.id')
                ->join('designations', 'attendances.designation_id', '=', 'designations.id')
                ->get();
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        } else {
            $datas = Attendance::select(
                'attendances.id',
                'attendances.organization_id',
                'attendances.date',
                'attendances.checked_in',
                'attendances.checked_out',
                'attendances.status',
                'attendances.duration',
                'employees.fname as employee_fname',
                'employees.mid_name as employee_mid_name',
                'employees.lname as employee_lname',
                'employees.code',
                'departments.name as department_name',
                'designations.name as designation_name'
            )
                ->join('employees', 'attendances.employee_id', '=', 'employees.id')
                ->join('departments', 'attendances.department_id', '=', 'departments.id')
                ->join('designations', 'attendances.designation_id', '=', 'designations.id')
                ->get();
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        }

        return view('hrm.attendances.index', compact('datas', 'departments', 'employee'));
    }
    public function attendance_file_upload(Request $request)
    {
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        $today = date('Y-m-d');
        $r_day = date('Y-m-d', strtotime('+1 day', strtotime($today)));
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $datas = Attendance::select(
                'attendances.id',
                'attendances.organization_id',
                'attendances.date',
                'attendances.checked_in',
                'attendances.checked_out',
                'attendances.status',
                'attendances.duration',
                'employees.fname as employee_fname',
                'employees.mid_name as employee_mid_name',
                'employees.lname as employee_lname',
                'employees.code ',
                'departments.name as department_name',
                'designations.name as designation_name'
            )
                ->join('employees', 'attendances.employee_id', '=', 'employees.id')
                ->join('departments', 'attendances.department_id', '=', 'departments.id')
                ->join('designations', 'attendances.designation_id', '=', 'designations.id')
                ->where('attendances.date', '<=', $r_day)
                ->where('attendances.date', '>=', $today)
                ->get();

            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        } else {
            $datas = Attendance::select(
                'attendances.id',
                'attendances.organization_id',
                'attendances.date',
                'attendances.checked_in',
                'attendances.checked_out',
                'attendances.status',
                'attendances.duration',
                'employees.fname as employee_fname',
                'employees.mid_name as employee_mid_name',
                'employees.lname as employee_lname',
                'employees.code ',
                'departments.name as department_name',
                'designations.name as designation_name'
            )
                ->join('employees', 'attendances.employee_id', '=', 'employees.id')
                ->join('departments', 'attendances.department_id', '=', 'departments.id')
                ->join('designations', 'attendances.designation_id', '=', 'designations.id')
                ->where('attendances.date', '<=', $r_day)
                ->where('attendances.date', '>=', $today)
                ->get();
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        }

        return view('hrm.attendances.file_upload', compact('datas', 'departments'));
    }
    public function file_upload(Request $request)
    {
        request()->validate([
            'file' => 'required',
        ]);

        $upload = $request->file('file');
        $filePath = $upload->getRealPath();
        $file = fopen($filePath, 'r');
        $header = fgetcsv($file);
        $escapedHeader = [];
        //validate
        foreach ($header as $key => $value) {
            $lheader = strtolower($value);
            $escapedItem = preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }
        //looping through othe columns
        while ($columns = fgetcsv($file)) {
            if ($columns[0] == "") {
                //  continue;
            }

            //trim data
            foreach ($columns as $key => &$value) {
                // $value=preg_replace('/\D/','',$value);
            }
            $data = array_combine($escapedHeader, $columns);
            // setting type

            foreach ($data as $key => &$value) {
                $value = ($key == "id" || $key == "organizationid" || $key == "employeeid" || $key == "departmentid" || $key == "designationid" ||
                    $key == "checkedin" || $key == "checkedout" || $key == "date" || $key == "duration" || $key == "status" || $key == "checkedinloc" || $key == "checkedoutloc" || $key == "shiftid" ||
                    $key == "createdby") ? (string)$value : (string)$value;
            }
            // $id=$value['id'];
            //  $date=$data['date'];
            $organization_id = $data['organizationid'];
            $employee_id = $data['employeeid'];
            //  dd($date);
            $date = Carbon::parse($data['date']);

            $atten = new Attendance;
            $atten->organization_id = $organization_id;
            $atten->employee_id = $employee_id;
            $atten->department_id = $data['departmentid'];
            $atten->designation_id = $data['designationid'];
            $atten->checked_in = $data['checkedin'];
            $atten->checked_out = $data['checkedout'];
            $atten->date = $date;
            $atten->duration = $data['duration'];
            $atten->status = $data['status'];
            $atten->checked_in_loc = $data['checkedinloc'];
            $atten->checked_out_loc = $data['checkedoutloc'];
            $atten->shift_id = $data['shiftid'];
            $atten->created_by = Auth::user()->id;
            // dd($data);
            $atten->save();
        }

        if ($atten) {
            return redirect()->route('hrm.attendance_file_upload')
                ->with('success', 'Attendance created successfully.');
        } else {
            return redirect()->route('hrm.attendance_file_upload')
                ->with('success', 'Nothing uploaded.');
        }
    }
    public function Show(Request $request)
    {

        $user = Auth::user('id', 'name', 'email');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        $employee = Employee::where('email', $user->email)->select('id', 'email')->first();
        //dd($employee);
        $today = date('Y-m-d');
        $r_day = date('Y-m-d', strtotime('+1 day', strtotime($today)));
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $datas = Attendance::select(
                'attendances.id',
                'attendances.organization_id',
                'attendances.date',
                'attendances.checked_in',
                'attendances.checked_out',
                'attendances.status',
                'attendances.duration',
                'employees.fname as employee_fname',
                'employees.mid_name as employee_mid_name',
                'employees.lname as employee_lname',
                'employees.code ',
                'departments.name as department_name',
                'designations.name as designation_name'
            )
                ->join('employees', 'attendances.employee_id', '=', 'employees.id')
                ->join('departments', 'attendances.department_id', '=', 'departments.id')
                ->join('designations', 'attendances.designation_id', '=', 'designations.id')
                ->where('attendances.date', '<=', $r_day)
                ->where('attendances.date', '>=', $today)
                ->get();
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        } else {
            $datas = Attendance::select(
                'attendances.id',
                'attendances.organization_id',
                'attendances.date',
                'attendances.checked_in',
                'attendances.checked_out',
                'attendances.status',
                'attendances.duration',
                'employees.fname as employee_fname',
                'employees.mid_name as employee_mid_name',
                'employees.lname as employee_lname',
                'employees.code',
                'departments.name as department_name',
                'designations.name as designation_name'
            )
                ->join('employees', 'attendances.employee_id', '=', 'employees.id')
                ->join('departments', 'attendances.department_id', '=', 'departments.id')
                ->join('designations', 'attendances.designation_id', '=', 'designations.id')
                ->where('attendances.date', '<=', $r_day)
                ->where('attendances.date', '>=', $today)
                ->get();
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        }

        return view('hrm.attendances.index', compact('datas', 'departments', 'employee'));
    }

    public function attendance_daily(Request $request)
    {
        $user = Auth::user('id', 'name', 'email');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        $dep_id = $request->department_id;
        $des_id = $request->designation_id;
        $emp_id = $request->employee_id;
        $from_date = $request->from_date;
        $today = $request->to_date;
        $employee = Employee::where('id', $emp_id)
            ->select('id', 'fname', 'mid_name', 'lname', 'code', 'designation_id', 'department_id')
            ->with('department')
            ->with('designation')
            ->first();

        $r_day = date('Y-m-d', strtotime('+1 day', strtotime($from_date)));

        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $datas = Attendance::where('department_id', $dep_id)
                ->where('designation_id', $des_id)
                ->where('employee_id', $emp_id)
                ->where('date', '<=', $today)
                ->where('date', '>=', $r_day)
                ->get();

            $departments = Department::where('organization_id', $org)
                ->select('id', 'name', 'status')
                ->get();
        } else if ($userRole == 'Employee') {
            $datas = Attendance::where('organization_id', $org)
                ->where('employee_id', $emp_id)
                ->where('date', '<=', $today)
                ->where('date', '>=', $r_day)
                ->get();

            $departments = Department::where('organization_id', $org)
                ->select('id', 'name', 'status')
                ->get();
        } else {
            $datas = Attendance::where('organization_id', $org)
                ->where('employee_id', $emp_id)
                ->where('date', '<=', $today)
                ->where('date', '>=', $r_day)
                ->get();

            $departments = Department::where('organization_id', $org)
                ->select('id', 'name', 'status')
                ->get();
        }

        // Check if $datas is empty and set a message
        if ($datas->isEmpty()) {
            $noDataMessage = "No data available for the selected date range.";
        } else {
            $noDataMessage = null;
        }

        // Pass the message to the view
        return view('hrm.attendances.daily', compact('datas', 'departments', 'employee', 'noDataMessage'));
    }

    public function get_emp_attendance(Request $request) {
        $id = $request->id;

        $datas = Attendance::select(
            'attendances.id',
            'attendances.date',
            'attendances.status',
            'attendances.duration'
        )
        ->where('attendances.employee_id', '=', $id)
        ->get()
        ->map(function ($item) {
            return [
                'date' => \Carbon\Carbon::parse($item->date)->toDateString(), // Converts to YYYY-MM-DD
                'status' => $item->status
            ];
        });

        return response()->json($datas);
    }




    public function create(Request $request)
    {
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        // dd($org);
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $orgs = Organization::select('id', 'company_name')->get();
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        } else {
            $orgs = Organization::where('id', $org)->select('id', 'company_name')->get();
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        }
        $emps = DB::table('employees')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->join('designations', 'employees.designation_id', '=', 'designations.id')
            ->join('organizations', 'employees.organization_id', '=', 'organizations.id') // Joining organizations table
            ->select(
                'employees.id',
                'employees.fname',
                'employees.lname',
                'departments.name as department_name',

                'designations.name as designation_name',
                'organizations.company_name as organization_name',
                'designations.id as designation_id',
                'departments.id as department_id',
                'organizations.id as org_id'
            )
            ->where('organizations.id', $org)
            ->get();

        // $emps= DB::select("
        //      SELECT
        //         organizations.id AS organization_id,
        //         organizations.company_name,
        //         organizations.website,
        //         organizations.phone AS org_phone,
        //         departments.name AS department_name,
        //         designations.name AS designation_name,
        //         employees.id AS emp_id,
        //         employees.fname ,
        //         employees.lname ,
        //         employees.email AS employee_email
        //     FROM organizations
        //     LEFT JOIN departments
        //         ON departments.organization_id = organizations.id
        //     LEFT JOIN designations
        //         ON designations.department_id = departments.id
        //     LEFT JOIN employees
        //         ON employees.department_id = departments.id
        //         AND employees.designation_id = designations.id
        //     WHERE organizations.id= $org
        // ");

        // dd($emps);
        return view('hrm.attendances.create', compact('departments', 'orgs', 'emps'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'employee_id' => 'required|integer',
            'designation_id' => 'required|integer',
            'department_id' => 'required|integer',
            'org_id' => 'required|integer',
            'attendance_date' => 'required|date',
            'check_in_time' => 'nullable|date_format:H:i',
            'check_out_time' => 'nullable|date_format:H:i|after_or_equal:check_in_time',
            'attendance_status' => 'required|string',
        ]);

        // Retrieve attendance for the selected date
        $attendance = Attendance::where('employee_id', $validatedData['employee_id'])
            ->whereDate('date', $validatedData['attendance_date'])
            ->first();

        // If attendance for selected date doesn't exist, create a new record
        if (!$attendance) {
            $attendance = new Attendance();
            $attendance->organization_id = $validatedData['org_id'];
            $attendance->employee_id = $validatedData['employee_id'];
            $attendance->department_id = $validatedData['department_id'];
            $attendance->designation_id = $validatedData['designation_id'];
            $attendance->status = $validatedData['attendance_status'];
            $attendance->date = $validatedData['attendance_date']; // Set selected date
            $attendance->created_by = auth()->id(); // Optional: Logged-in user
        }

        // Update check-in time if provided
        if (!empty($validatedData['check_in_time'])) {
            $attendance->checked_in = $validatedData['attendance_date'] . ' ' . $validatedData['check_in_time'];
        }

        // Update check-out time if provided
        if (!empty($validatedData['check_out_time'])) {
            $attendance->checked_out = $validatedData['attendance_date'] . ' ' . $validatedData['check_out_time'];

            // Calculate duration in hours with decimal precision
            if ($attendance->checked_in) {
                $checkIn = Carbon::parse($attendance->checked_in);
                $checkOut = Carbon::parse($attendance->checked_out);
                $attendance->duration = round($checkIn->diffInMinutes($checkOut) / 60, 2); // Duration in hours
            }
        }

        $attendance->updated_by = auth()->id(); // Optional: Logged-in user
        $attendance->save();

        return response()->json([
            'message' => 'Attendance record updated successfully!',
            'attendance' => $attendance,
        ], 200);
    }


    public function bulk_attendance()
    {
        // dd(request());
        // $user = Auth::user('id', 'name');
        // $userRole = $user->roles->pluck('name')->first();
        // $org = $user->org->id;
        // // dd($org);
        // if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
        //     $orgs = Organization::select('id', 'company_name')->get();
        //     $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        // } else {
        //     $orgs = Organization::where('id', $org)->select('id', 'company_name')->get();
        //     $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        // }
        // $emps = DB::table('employees')
        // ->join('departments', 'employees.department_id', '=', 'departments.id')
        // ->join('designations', 'employees.designation_id', '=', 'designations.id')
        // ->join('organizations', 'employees.organization_id', '=', 'organizations.id') // Joining organizations table
        // ->select(
        //     'employees.id',
        //     'employees.fname',
        //     'employees.lname',
        //     'departments.name as department_name',

        //     'designations.name as designation_name',
        //     'organizations.company_name as organization_name',
        //     'designations.id as designation_id',
        //     'departments.id as department_id',
        //     'organizations.id as org_id'
        // )
        // ->where('organizations.id', $org)
        // ->get();
        $employees = Employee::all();
        // Pass the message to the view
        return view('hrm.attendances.addbulkattendance', compact('employees'));
        //return view ('hrm.attendances.addbulkattendance', compact('departments', 'orgs','emps'));

    }
    public function exportAttendance(Request $request)
    {
        // dd($request);
        DB::enableQueryLog();
        $fromDate = $request->from_date; // Format: '2025-01-01'
        $toDate = $request->to_date; // Format: '2025-03-01'
        $empId = $request->emp_id;

        return Excel::download(new AttandanceExport($fromDate, $toDate,$empId), 'Attendance.xlsx');

    }

    // public function store(Request $request)
    // {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'employee_id' => 'required|integer',
    //         'designation_id' => 'required|integer',
    //         'department_id' => 'required|integer',
    //         'org_id' => 'required|integer',
    //         'type' => 'required|string', // Ensures only 'checkIn' or 'checkOut'

    //     ]);

    //     // Retrieve today's attendance for the employee
    //     $attendance = Attendance::where('employee_id', $validatedData['employee_id'])
    //         ->whereDate('date', now()->toDateString()) // Check for the current date
    //         ->first();
    //         //$checkIn = $attendance->checked_in;
    //         //$checkOut = $attendance->checked_out;
    //     // If attendance for today doesn't exist, create a new record

    //     if (!$attendance->checked_in) {
    //         if ($validatedData['type'] === 'checkIn') {
    //             // Create a new attendance record
    //             $attendance = new Attendance();
    //             $attendance->organization_id = $validatedData['org_id'];
    //             $attendance->employee_id = $validatedData['employee_id'];
    //             $attendance->department_id = $validatedData['department_id'];
    //             $attendance->designation_id = $validatedData['designation_id'];
    //             $attendance->date = now()->toDateString(); // Set today's date
    //             $attendance->created_by = auth()->id(); // Logged-in user
    //             $attendance->status = 'P'; // Default status
    //             $attendance->checked_in = now(); // Set check-in time
    //             $attendance->updated_by = auth()->id(); // Logged-in user
    //             $attendance->save(); // Save the record

    //             // Return a success response
    //             return response()->json([
    //                 'message' => 'Check-In marked successfully!',
    //                 'attendance' => $attendance,
    //             ], 200);
    //         }
    //     }

    //     // Handle Check-Out
    //     if ($attendance->checked_in && !$attendance->checked_out) {
    //         if ($validatedData['type'] === 'checkOut') {
    //             $attendance->checked_out = now(); // Set check-out time

    //             // Calculate duration (only if check-in exists)
    //             $attendance->duration = now()->diffInMinutes($attendance->checked_in); // Duration in minutes
    //             $attendance->updated_by = auth()->id(); // Logged-in user
    //             $attendance->save(); // Update the record

    //             // Return a success response
    //             return response()->json([
    //                 'message' => 'Check-Out marked successfully!',
    //                 'attendance' => $attendance,
    //             ], 200);
    //         }
    //     }

    //     // If neither check-in nor check-out matches
    //     return response()->json([
    //         'message' => 'Invalid operation!',
    //     ], 400);


    // }



    // public function store(Request $request)
    // {

    //  $employeeId = $request->employee_id;
    //  $type = $request->type; // 'checkIn' or 'checkOut'
    //  $currentTime = now(); // Get the current date and time
    //         try {
    //             // Save attendance data
    //             DB::table('attendances')->insert([
    //                 'employee_id' => $employeeId,
    //                 'type' => $type,
    //                 'timestamp' => $currentTime,
    //                 'created_at' => $currentTime,
    //                 'updated_at' => $currentTime,
    //             ]);

    //             return response()->json([
    //                 'success' => true,
    //                 'message' => ucfirst($type) . ' marked successfully.'
    //             ]);
    //         } catch (\Exception $e) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Error: ' . $e->getMessage()
    //             ]);
    //         }

    //     //  dd($request);
    //     //     $user = Auth::user('id', 'name');
    //     //     $employee_id= $request['employee_id'];
    //     //     $org= $request['org_id'];
    //     //     $type= $request['type'];
    //     //     dd($type);
    //     //     $orgs = Organization::where('id', $org)->select('id', 'company_name')->get();
    //     //     $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
    //     //     $shift = Shift::where('id', $shift_id)->select('id', 'in_time', 'out_time', 'shift_code')->first();
    //     //     request()->validate([
    //     //         'employee_id' => 'required',
    //     //     ]);


    //     //     //$datas = $request['car'];
    //     //    // dd($datas);
    //     //     if ($datas) {
    //     //         foreach ($datas as $key => $all) {
    //     //             // return $key;
    //     //             foreach ($all as $key2 => $value) {
    //     //                 //  return $key2;
    //     //                 if ($key2 == 'checked_in') {
    //     //                     $checked_in = $value;
    //     //                 }
    //     //             }
    //     //             foreach ($all as $key2 => $value) {
    //     //                 if ($key2 == 'checked_out') {
    //     //                     $checked_out = $value;
    //     //                 }
    //     //             }
    //     //             foreach ($all as $key3 => $value) {
    //     //                 if ($key3 == 'date') {
    //     //                     $date = $value;
    //     //                 }
    //     //             }
    //     //             foreach ($all as $key4 => $value) {
    //     //                 if ($key4 == 'duration') {
    //     //                     $duration = $value;
    //     //                 }
    //     //             }
    //     //             foreach ($all as $key5 => $value) {
    //     //                 if ($key5 == 'status') {
    //     //                     $status = $value;
    //     //                 }
    //     //             }

    //     //             $data = new Attendance;
    //     //             $data->organization_id = $user->org->id;
    //     //             $data->employee_id = $request->employee_id;
    //     //             $data->department_id = $request->department_id;
    //     //             $data->designation_id = $request->designation_id;
    //     //             $data->checked_in = $checked_in;
    //     //             $data->checked_out = $checked_out;
    //     //             $data->date = $date;
    //     //             $data->duration = $duration;
    //     //             $data->status = $status;
    //     //             $data->checked_in_loc = $request->checked_in_loc;
    //     //             $data->checked_out_loc = $request->checked_out_loc;
    //     //             $data->shift_id = $request->shift_id;
    //     //             $data->created_by = $user->id;
    //     //             $data->save();
    //     //         }
    //     // }

    //         //  Attendance::create($request->all());

    //         // return redirect()->route('hrm.attendances.index')
    //         //     ->with('success', 'Attendance created successfully.');
    // }
    public function attendance_search(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $employee_id = $request->employee_id;
        $dep_id = $request->department_id;
        $des_id = $request->designation_id;
        $shift_id = $request->shift_id;

        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $shift = Shift::where('id', $shift_id)->select('id', 'in_time', 'out_time', 'shift_code')->first();
            $emp = Employee::where('id', $employee_id)->select('id', 'fname', 'mid_name', 'lname', 'code', 'department_id', 'designation_id')->first();
            $leave = LeaveAllocation::where('organization_id', $org)->where('employee_id', $employee_id)->where('effect_year', '<=', $to_date)->where('effect_year', '>=', $from_date)->get();
            $day_off = DayOff::where('organization_id', $org)->where('department_id', $dep_id)->where('designation_id', $des_id)->first();
            $holidays = Holiday::where('organization_id', $org)->where('to_date', '<=', $to_date)->where('from_date', '>=', $from_date)->get();
        } else {
            $shift = Shift::where('id', $shift_id)->select('id', 'in_time', 'out_time', 'shift_code')->first();
            $emp = Employee::where('organization_id', $org)->where('id', $employee_id)->select('id', 'fname', 'mid_name', 'lname', 'code', 'department_id', 'designation_id')->first();
            $leave = LeaveAllocation::where('organization_id', $org)->where('employee_id', $employee_id)->where('effect_year', '<=', $to_date)->where('effect_year', '>=', $from_date)->get();
            $day_off = DayOff::where('organization_id', $org)->where('department_id', $dep_id)->where('designation_id', $des_id)->first();
            $holidays = Holiday::where('organization_id', $org)->where('to_date', '<=', $to_date)->where('from_date', '>=', $from_date)->get();
        }

        return view('hrm.attendances.search', compact('emp', 'from_date', 'to_date', 'shift', 'day_off', 'leave', 'holidays'));
    }
    public function attendance_process(Request $request)
    {
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        $dep_id = $request->department_id;
        $des_id = $request->designation_id;
        $emp_id = $request->employee_id;
        // $from_date = $request->from_date;
        //$today = $request->to_date;
        $from_date =   \Carbon\Carbon::parse($request->from_date);
        $today = \Carbon\Carbon::parse(date('Y-m-d'));
        // $today = date('Y-m-d');
        $emp = Employee::where('id', $emp_id)->first();
        $r_day = date('Y-m-d', strtotime('+1 day', strtotime($today)));
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $datas = Employee::where('department_id', $dep_id)->where('designation_id', $des_id)->where('id', $emp_id)->where('created_at', '<=', $r_day)->where('created_at', '>=', $today)->select('id', 'fname', 'mid_name', 'lname', 'code', 'department_id', 'designation_id')->get();
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
            $leave = LeaveAllocation::where('organization_id', $org)->where('employee_id', $emp_id)->where('effect_year', '<=', $r_day)->where('effect_year', '>=', $from_date)->get();
            $day_off = DayOff::where('organization_id', $org)->where('department_id', $dep_id)->where('designation_id', $des_id)->first();
        } else {
            $datas = Employee::where('organization_id', $org)->where('department_id', $dep_id)->where('designation_id', $des_id)->where('id', $emp_id)->select('id', 'fname', 'mid_name', 'lname', 'code', 'department_id', 'designation_id')->get();
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
            $leave = LeaveAllocation::where('organization_id', $org)->where('employee_id', $emp_id)->where('effect_year', '<=', $r_day)->where('effect_year', '>=', $today)->get();
            $day_off = DayOff::where('organization_id', $org)->where('department_id', $dep_id)->where('designation_id', $des_id)->first();
        }
        $actual_time = '0';
        return view('hrm.attendances.process', compact('datas', 'departments', 'actual_time', 'leave', 'day_off'));
    }
    public function attendance_process_save(Request $request)
    {
        $from_date =   \Carbon\Carbon::parse($request->from_date);
        $to_date = \Carbon\Carbon::parse($request->to_date);
        $employee_id = $request->employee_id;
        $department_id = $request->department_id;
        $designation_id = $request->designation_id;
        $r_day = date('Y-m-d', strtotime('+1 day', strtotime($to_date)));

        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;

        if ($from_date && $to_date && $employee_id && $department_id && $designation_id) {
            $datas = Employee::where('organization_id', $org)->where('id', $employee_id)->select('id', 'fname', 'mid_name', 'lname', 'code', 'department_id', 'designation_id')->get();
            $attend = Attendance::where('date', '<=', $r_day)->where('date', '>=', $from_date)->where('employee_id', $employee_id)->get();
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
            $leave = LeaveAllocation::where('organization_id', $org)->where('employee_id', $employee_id)->where('effect_year', '<=', $r_day)->where('effect_year', '>=', $from_date)->get();
            $day_off = DayOff::where('organization_id', $org)->where('department_id', $department_id)->where('designation_id', $designation_id)->first();
            if ($day_off) {
                //  return $attend->unique('date')->pluck('checked_in')->count();
                $startOfMonth = Carbon::create($from_date->format('Y'), $from_date->format('m'), 1);
                $endOfMonth = $startOfMonth->copy()->endOfMonth();
                $workingDayCount = 0;
                $weekendDays = [$day_off->friday = 0, $day_off->saturday = 0, $day_off->sunday = 0, $day_off->monday = 0, $day_off->tuesday = 0, $day_off->wednesday = 0, $day_off->thursday = 0];

                for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
                    if (!in_array($date->dayOfWeek, $weekendDays)) {
                        // Exclude weekend days
                        $workingDayCount++;
                    }
                }
            } else {
                $workingDayCount = '0';
            }
        }
        if ($from_date && $to_date && $department_id && $designation_id) {
            $datas = Employee::where('organization_id', $org)->where('department_id', $department_id)->where('designation_id', $designation_id)->select('id', 'fname', 'mid_name', 'lname', 'code', 'department_id', 'designation_id')->get();
            $attend = Attendance::where('date', '<=', $r_day)->where('date', '>=', $from_date)->where('department_id', $department_id)->where('designation_id', $designation_id)->get();
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
            $leave = LeaveAllocation::where('organization_id', $org)->where('effect_year', '<=', $r_day)->where('effect_year', '>=', $from_date)->get();
            $day_off = DayOff::where('organization_id', $org)->where('department_id', $department_id)->where('designation_id', $designation_id)->first();
            if ($day_off) {
                $startOfMonth = Carbon::create($from_date->format('Y'), $from_date->format('m'), 1);
                $endOfMonth = $startOfMonth->copy()->endOfMonth();
                $workingDayCount = 0;
                $weekendDays = [$day_off->friday = 0, $day_off->saturday = 0, $day_off->sunday = 0, $day_off->monday = 0, $day_off->tuesday = 0, $day_off->wednesday = 0, $day_off->thursday = 0];

                for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
                    if (!in_array($date->dayOfWeek, $weekendDays)) {
                        // Exclude weekend days
                        $workingDayCount++;
                    }
                }
            } else {
                $workingDayCount = '0';
            }
        }
        // return $attend->pluck('checked_in')->count();
        return view('hrm.attendances.process', compact('datas', 'attend', 'departments', 'leave', 'day_off', 'workingDayCount', 'from_date', 'to_date'));
    }
    public function attendance_report(Request $request)
    {
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        $today = date('Y-m-d');
        $r_day = date('Y-m-d', strtotime('+1 day', strtotime($today)));
        $year =  date('Y');
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $datas = '';
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
            $attend = Attendance::where('organization_id', $org)->where('date', '<=', $r_day)->where('date', '>=', $today)->get();
            $day_off = DayOff::where('organization_id', $org)->first();
            $leave = '';
            $holidays = Holiday::where('organization_id', $org)->where('to_date', '<=', $r_day)->where('from_date', '>=', $today)->get();
        } else {
            $datas = '';
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
            $attend = Attendance::where('organization_id', $org)->where('date', '<=', $r_day)->where('date', '>=', $today)->get();
            $day_off = DayOff::where('organization_id', $org)->first();
            $leave = '';
            $holidays = Holiday::where('organization_id', $org)->where('to_date', '<=', $r_day)->where('from_date', '>=', $today)->get();
        }

        return view('hrm.attendances.report', compact('datas', 'departments', 'attend', 'day_off', 'year', 'leave', 'holidays'));
    }

    public function attendance_report_save(Request $request)
    {
        $year =  $request->from_date;
        $from_date =   Carbon::parse($request->from_date);
        $to_date = Carbon::parse($request->to_date);
        $employee_id = $request->employee_id;
        $department_id = $request->department_id;
        $designation_id = $request->designation_id;
        $r_day = date('Y-m-d', strtotime('+1 day', strtotime($to_date)));

        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;

        if ($from_date && $to_date && $employee_id && $department_id && $designation_id) {
            $datas = Employee::where('organization_id', $org)->where('id', $employee_id)->select('id', 'fname', 'mid_name', 'lname', 'code', 'department_id', 'designation_id')->first();

            $attend = Attendance::whereYear('date', $year)->where('employee_id', $employee_id)->get();
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
            $leave = LeaveAllocation::where('organization_id', $org)->where('id', $employee_id)->where('effect_year', '<=', $r_day)->where('effect_year', '>=', $from_date)->get();
            $day_off = DayOff::where('organization_id', $org)->where('department_id', $department_id)->where('designation_id', $designation_id)
                ->first();
            $holidays = Holiday::where('organization_id', $org)->whereYear('to_date', $from_date)->get();

            //   return $attend->where('date','2023-06-01')->pluck('checked_in')->count();
            //    return $attend = $attend->filter(function ($item) {
            //         return Carbon::parse($item->date)->month == 06;
            //     })->pluck('checked_in')->count();
            //  return Attendance::whereMonth('date', $from_date->format('m'))
            //  ->whereYear('date', $from_date->format('Y'))
            //  ->get(['checked_in']);
            //   if ($day_off) {
            // for($x = $from_date; $x <= $to_date; $x++){
            //      $dd[] = $x->format('l');
            // }
            //  $year = '2023';
            // $month ='01';
            // $startOfMonth = Carbon::create($year, $month, 1);
            // $endOfMonth = $startOfMonth->copy()->endOfMonth();
            // $workingDayCount = 0;

            // for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
            //     if ($date->isWeekday()) {
            //         // Exclude weekends (Saturday and Sunday)
            //         $workingDayCount++;
            //     }
            // }


            // return $workingDayCount;



            //     $working_days = 0;
            //     while ($from_date <= $to_date) {
            //         if ($from_date->isWeekday()) {

            //             $working_days++;
            //         }

            //         $from_date->addDay();
            //     }
            //     if ($day_off->friday = 0  || $day_off->friday = 1 &&  ($day_off->saturday = 0 ||  $day_off->saturday = 1) && ($day_off->sunday = 0 || $day_off->sunday = 1) && ($day_off->monday = 0 || $day_off->monday = 1) && ($day_off->tuesday = 0 || $day_off->tuesday = 1) && ($day_off->wednesday = 0 || $day_off->wednesday = 1) && $day_off->thursday = 0 || $day_off->thursday = 1) {
            //         $fri_sat_count = $from_date->diffInDaysFiltered(function ($date) {

            //             return $date->isFriday() || $date->isSaturday() || $date->isSunday() || $date->isMonday() || $date->isTuesday() || $date->isWednesday() || $date->isThursday();
            //         }, $to_date);
            //     }

            //     $working_days -= $fri_sat_count;
            //     $actual_time = $working_days;
            // } else {
            //     $actual_time = '0';
            // }
            return view('hrm.attendances.report', compact('datas', 'year', 'attend', 'departments', 'leave', 'day_off', 'year', 'to_date', 'holidays'));
        }

        // return $attend->pluck('checked_in')->count();
        return view('hrm.attendances.report', compact('datas', 'attend', 'departments', 'leave', 'day_off', 'from_date', 'to_date', 'holidays'));
    }
    public function get_duration(Request $request, $checked_in_val, $checked_out_val)
    {
        //  $attend = Attendance::where('checked_in', '<=', $checked_in_val)->where('checked_out', '>=', $checked_out_val)->get();
        $attend = ([
            'hour' => $checked_in_val,
            'min' => $checked_out_val,
        ]);
        echo json_encode($attend);
    }
    public function attendance_record(Request $request, $code, $year)
    {
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        $from_date = $request->year;
        $datas = Employee::where('code', $code)->select('id', 'fname', 'mid_name', 'lname', 'code', 'department_id', 'designation_id')->first();

        $attend = Attendance::whereYear('date', $year)->where('employee_id', $datas->id)->select('checked_in', 'employee_id', 'date', 'status')->get();
        // $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        $leave = LeaveAllocation::where('organization_id', $org)->where('id', $datas->id)->whereYear('effect_year', '=', $year)->select('id', 'organization_id', 'effect_year')->get();
        $day_off = DayOff::where('organization_id', $org)->where('department_id', $datas->department_id)->where('designation_id', $datas->designation_id)->first();
        $holiday = Holiday::where('organization_id', $org)->whereYear('from_date', '=', $year)->select('from_date', 'to_date', 'organization_id', 'day', 'num_of_day')->get();

        return view('hrm.attendances.record_view', compact('datas', 'attend', 'leave', 'day_off', 'year', 'holiday'));
    }
    public function attendance_emp_status(Request $request)
    {
        $user = Auth::user('id', 'name', 'email');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        $org_user = $user->org->user_id;
        $today = date('Y-m-d');
        $r_day = date('Y-m-d', strtotime('+1 day', strtotime($today)));
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $employee = Employee::where('organization_id', $org)->get();
            $datas = Attendance::where('date', '<=', $r_day)->where('date', '>=', $today)->get();
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        }
        if ($userRole == 'Employee') {
            $employee = Employee::where('email', $user->email)->first();
            $datas = Attendance::where('date', '<=', $r_day)->where('date', '>=', $today)->get();
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        } else {
            $employee = Employee::where('organization_id', $org)->get();
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
            $datas = Attendance::where('organization_id', $org)->where('date', '<=', $r_day)->where('date', '>=', $today)->get();
        }

        return view('hrm.attendances.attendance_emp_status', compact('datas', 'departments', 'employee'));
    }
    public function calenderatt()
    {
        return view('hrm.attendances.calendaratt');
    }
    public function generateCalendar(Request $request, $code, $year)
    {
        // $startYear = Carbon::now()->subYear()->year;
        // $endYear = Carbon::now()->year;
        $startYear = $year;
        $endYear = $year;
        $emp_id = $request->employee_id;

        $calendar = [];

        for ($year = $startYear; $year <= $endYear; $year++) {
            for ($month = 1; $month <= 12; $month++) {
                $daysInMonth = Carbon::create($year, $month)->daysInMonth;
                $monthData = [
                    'year' => $year,
                    'month' => $month,
                    'days' => [],
                ];

                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $attendanceStatus = $this->getAttendanceStatus($year, $month, $day, $code);
                    $monthData['days'][] = $attendanceStatus;
                }

                $calendar[] = $monthData;
            }
        }

        return view('hrm.attendances.calendar', compact('calendar'));
    }

    private function getAttendanceStatus($year, $month, $day, $code)
    {
        // Implement your logic to determine the attendance status based on the given year, month, and day
        // You can retrieve data from your database or use any other custom logic

        // Example logic: Generating a random attendance status
        $org = Auth::user()->org->id;
        $emp  = Employee::where('code', $code)->first();
        $attend = Attendance::whereYear('date', $year)->where('employee_id', $emp->id)->select('checked_in', 'employee_id', 'date', 'status')->get();

        $leave = LeaveAllocation::where('organization_id', $org)->where('employee_id', $emp->id)->whereYear('effect_year', '=', $year)->get();
        $day_off = DayOff::where('organization_id', $org)->where('department_id', $emp->department_id)->where('designation_id', $emp->designation_id)->first();
        // Carbon::SATURDAY, Carbon::SUNDAY;
        $weekendDays = [$day_off->friday = 0, $day_off->saturday = 0, $day_off->sunday = 0, $day_off->monday = 0, $day_off->tuesday = 0, $day_off->wednesday = 0, $day_off->thursday = 0];


        $statuses = ['P', 'L', 'A']; // Possible statuses: Present, Leave, Absent
        //  $statuses = [$attend->status]; // Possible statuses: Present, Leave, Absent
        $randomIndex = array_rand($statuses);
        return $statuses[$randomIndex];
    }
}
