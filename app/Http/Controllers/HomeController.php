<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\RightWork;
use App\Models\Organization;
use App\Models\JobPost;
use App\Models\JobApplied;
use Auth;
use Carbon\Carbon;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        if(Auth::user()->org){
            $org = Auth::user()->org->id; 
        }
        else{
             $org = '';
        }
        $date = Carbon::today()->format('Y-m-d');
        $rem_1 = Carbon::today()->subDays(90)->format('Y-m-d');
        $rem_2 = Carbon::today()->subDays(60)->format('Y-m-d');
        $rem_3 = Carbon::today()->subDays(30)->format('Y-m-d');
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $employees = Employee::select('id')->get();
            $employes_mig =  Employee::select('id')->where('v_expiry_date', '<=', $date)->where('v_expiry_date', '>=', $rem_1)->orwhere([['e_expiry_date', '<=', $date], ['e_expiry_date', '>=', $rem_1]])->get();
            $rightwords = RightWork::select('id')->get();
            $organizations = Organization::select('id')->get();
            $job_posts = JobPost::select('id')->get();
            $app_receceived = JobApplied::select('id')->where('status','Application Received')->get();
            $short_list = JobApplied::select('id')->where('status','Short listed')->get();
            $interviews = JobApplied::select('id')->where('status','Interview')->get();
            $hired = JobApplied::select('id')->where('status','Hired')->get();
            $job_offers = JobApplied::select('id')->where('status','Job Offered')->get();
            $rejects = JobApplied::select('id')->where('status','Rejected')->get();
        return view('home',compact('employees','employes_mig','rightwords','organizations','job_posts','app_receceived','short_list','interviews','hired','job_offers','rejects'));


        } else {
           
            if($org){
                $employees = Employee::select('id')->where('organization_id', $org)->get();
                $employes_mig =  Employee::select('id')->where('v_expiry_date', '<=', $date)->where('v_expiry_date', '>=', $rem_1)->where('organization_id', $org)->orwhere([['e_expiry_date', '<=', $date], ['e_expiry_date', '>=', $rem_1]])->get();
                $rightwords = RightWork::where('organization_id', $org)->select('id')->get();
                $organizations = Organization::select('id')->where('id', $org)->get();
                $job_posts = JobPost::select('id')->where('organization_id', $org)->get();
                $app_receceived = JobApplied::select('id')->where('organization_id', $org)->where('status','Application Received')->get();
                $short_list = JobApplied::select('id')->where('organization_id', $org)->where('status','Short listed')->get();
                $interviews = JobApplied::select('id')->where('status','Interview')->where('organization_id', $org)->get();
                $hired = JobApplied::select('id')->where('status','Hired')->where('organization_id', $org)->get();
                $job_offers = JobApplied::select('id')->where('status','Job Offered')->where('organization_id', $org)->get();
                $rejects = JobApplied::select('id')->where('status','Rejected')->where('organization_id', $org)->get();
                return view('home',compact('employees','employes_mig','rightwords','organizations','job_posts','app_receceived','short_list','interviews','hired','job_offers','rejects'));

            }
            else{
                $employees = '';
                $employes_mig =  '';
                $rightwords = '';
                $organizations =  Organization::select('id')->where('id', $user->organization_id)->get();
                $job_posts = '';
                $app_receceived = '';
                $short_list = '';
                $interviews = '';
                $hired = '';
                $job_offers = '';
                $rejects = '';
             return view('home',compact('employees','employes_mig','rightwords','organizations','job_posts','app_receceived','short_list','interviews','hired','job_offers','rejects'));

            }
     

        }
        return view('home',compact('employees','employes_mig','rightwords','organizations','job_posts','app_receceived','short_list','interviews','hired','job_offers','rejects'));
    }
}
