<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\Job;
use Illuminate\Http\Request;
use Auth;
use Str;

class JobPostController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:jobpost-list|jobpost-create|jobpost-edit|jobpost-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:jobpost-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:jobpost-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:jobpost-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $job_posts = JobPost::latest()->paginate('20');
        } else {
            $job_posts = JobPost::where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.job_posts.index', compact('job_posts'));
    }

    public function create()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $jobs = Job::distinct('soc_code')->pluck('soc_code');
        } else {
            $jobs = Job::where('organization_id', $org)->distinct('soc_code')->pluck('soc_code');
        }
        return view('hrm.job_posts.create', compact('jobs'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'job_id' => 'required',
            'soc_code' => 'required',
            'status' => 'required',
        ]);
        $request['slug'] = $request->organization_id . Str::random(8);
        JobPost::create($request->all());

        return redirect()->route('hrm.job_posts.index')
            ->with('success', 'JobPost created successfully.');
    }

    public function show(JobPost $Jobpost)
    {
        return view('hrm.job_posts.show', compact('Jobpost'));
    }

    public function edit(JobPost $JobPost)
    {
        $job = Job::where('id', $JobPost->job_id)->select('id', 'soc_code', 'job_title', 'job_des', 'department')->first();
        return view('hrm.job_posts.edit', compact('JobPost', 'job'));
    }

    public function update(Request $request, JobPost $JobPost)
    {
        // dd($request);
        request()->validate([
            'soc_code' => 'required',
            'status' => 'required',
        ]);

        if (!($JobPost->slug)) {
            $request['slug'] = $request->organization_id . Str::random(8);
        }
        $JobPost->update($request->all());

        return redirect()->route('hrm.job_posts.index')
            ->with('success', 'JobPost updated successfully');
    }

    public function destroy(JobPost $JobPost)
    {
        $JobPost->delete();

        return redirect()->route('hrm.job_posts.index')
            ->with('success', 'JobPost deleted successfully');
    }
    public function job_code(Request $request, $empid)
    {
        $jobs = Job::where([['soc_code', $empid]])->select('id', 'job_title')->get();
        // return response($jobs)->header('Content-Type', 'text/html');
        echo json_encode($jobs);
    }
    public function job_empid(Request $request, $empid, $soc)
    {
        $job_empid = Job::where([['id', $empid], ['soc_code', $soc]])->select('id', 'job_title', 'department', 'job_des', 'status')->get();
        // return response($jobs)->header('Content-Type', 'text/html');
        echo json_encode($job_empid);
    }
}
