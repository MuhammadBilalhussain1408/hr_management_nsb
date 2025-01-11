<?php

namespace App\Http\Controllers;

use App\Models\JobPublished;
use App\Models\Job;
use App\Models\JobPublished_has_link;
use Illuminate\Http\Request;
use Auth;
use DB;

class JobPublishedController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:jobPublished-list|jobPublished-create|jobPublished-edit|jobPublished-delete', ['only' => ['index','show']]);
         $this->middleware('permission:jobPublished-create', ['only' => ['create','store']]);
         $this->middleware('permission:jobPublished-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:jobPublished-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $job_publisheds = jobPublished::latest()->paginate('20');
        } else {
            $job_publisheds = jobPublished::where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.job_publisheds.index',compact('job_publisheds'));
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
        return view('hrm.job_publisheds.create', compact('jobs'));
    }
    
    public function store(Request $request)
    {       
        request()->validate([
            'job_id' => 'required',
            'soc_code' => 'required',
            'status' => 'required',
        ]);
        $dt = now();
       $jobPublished = jobPublished::create($request->all());
        $checklists = $request->file(['checklist']);
        $datas = $request['checklist'];
        if ($checklists) {
            foreach ($checklists as $key => $all) {
                $chk = new JobPublished_has_link;
                foreach ($all as $key2 => $value) {

                    if ($datas[0]['name']) {
                        $name = $datas[0]['name'];
                    }
                    if ($key2 == 'image') {
                        $image = $value;
                    }
                }
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();


                $fileNameToStore = implode('.', [
                    $filename,
                    $dt->format('YmdHis'),
                    $key2,
                    $extension
                ]);
                $path = $image->storeAs('public/upload/job_published', $fileNameToStore);
                $chk->job_published_id = $jobPublished->id;
                $chk->link = $name;
                $chk->image = $fileNameToStore;
                $chk->save();
            }
        }
    
        return redirect()->route('hrm.job_publisheds.index')
                        ->with('success','jobPublished created successfully.');
    }
    
    public function show(jobPublished $jobPublished)
    {
        return view('hrm.job_publisheds.show',compact('jobPublished'));
    }
    
    public function edit(jobPublished $jobPublished)
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $job = Job::distinct('soc_code')->pluck('soc_code');
        } else {
            $job = Job::where('organization_id', $org)->distinct('soc_code')->pluck('soc_code');
        }
     //  return $jobPublished->job_published_link;
       $job_published_link =  JobPublished_has_link::where('job_published_id',$jobPublished->id)->get();
        return view('hrm.job_publisheds.edit',compact('jobPublished','job','job_published_link'));
    }
    
    public function update(Request $request, jobPublished $jobPublished)
    {
       // dd($request);
         request()->validate([
            'soc_code' => 'required',
            'status' => 'required',
        ]);
        $dt = now();
        $jobPublished->update($request->all());
        $checklists = $request->file(['checklist']);
        $datas = $request['checklist'];
        if ($checklists) {
            DB::table("job_published_has_links")->where('job_published_id', $jobPublished->id)->delete();
            foreach ($checklists as $key => $all) {
                $chk = new JobPublished_has_link;
                foreach ($all as $key2 => $value) {

                    if ($datas[0]['name']) {
                        $name = $datas[0]['name'];
                    }
                    if ($key2 == 'image') {
                        $image = $value;
                    }
                }
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();


                $fileNameToStore = implode('.', [
                    $filename,
                    $dt->format('YmdHis'),
                    $key2,
                    $extension
                ]);
                $path = $image->storeAs('public/upload/job_published', $fileNameToStore);
                $chk->job_published_id = $jobPublished->id;
                $chk->link = $name;
                $chk->image = $fileNameToStore;
                $chk->save();
            }
        }
    
        return redirect()->route('hrm.job_publisheds.index')
                        ->with('success','jobPublished updated successfully');
    }
    
    public function destroy(JobPublished $jobPublished)
    {
        //
    }
}
