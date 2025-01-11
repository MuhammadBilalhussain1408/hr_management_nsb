<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\JobApplied;
use App\Models\JobPost;

class FromController extends Controller
{
    public function conatct_post(Request $request)
    {
        // dd($request);
        $data = new Contact;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->subject = $request->subject;
        $data->message = $request->message;
        $data->save();
        // return $data;

        //  $mail2 =['afroza2prova@gmail.com'];
        // return $email;
        //   Mail::to($mail2)->queue(new ContactEmail($data));
        return redirect()->back()->with('success', 'Successfully send your mail');
    }
    public function post_application(Request $request)
    {
        // return $request;

        request()->validate([
            'job_post_id' => 'required',
            'email' => 'required',
            'dob' => 'required',
        ]);
        $dt = now();
        $resume = $request->file('resume');
        if ($resume) {

            $filenameWithExt = $resume->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $resume->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore = implode('.', [
                $filename,
                $dt->format('YmdHis'),
                $extension
            ]);

         //   $path = $resume->storeAs('public/upload/resume', $fileNameToStore);
             $path = public_path('upload/resume');
            $resume->move($path, $fileNameToStore);
          //  $request['resume'] = $fileNameToStore;
        }
        $cover_letter = $request->file('cover_letter');
        if ($cover_letter) {

            $filenameWithExt2 = $cover_letter->getClientOriginalName();
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            $extension2 = $cover_letter->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore2 = implode('.', [
                $filename2,
                $dt->format('YmdHis'),
                $extension2
            ]);

          //  $path = $cover_letter->storeAs('public/upload/cover_letter', $fileNameToStore2);
           $path = public_path('upload/cover_letter');
            $cover_letter->move($path, $fileNameToStore2);
        }
       // $job = JobApplied::create($request->all());
  
        $job = new JobApplied;
        $job->job_post_id = $request->job_post_id;
       // $job->soc_code = $request->soc_code;
        $job->name = $request->name;
        $job->email = $request->email;
        $job->phone = $request->phone;
        $job->gender = $request->gender;
        $job->total_year_of_exp = $request->total_year_of_exp;
        $job->exp_month = $request->exp_month;
        $job->qualification = $request->qualification;
        $job->skill_set = $request->skill_set;
        $job->recent_employee = $request->recent_employee;
        $job->recent_job_title = $request->recent_job_title;
        $job->zip = $request->zip;
        $job->address = $request->address;
        $job->expected_salary = $request->expected_salary;
        $job->current_stage_requitment = $request->current_stage_requitment;
        $job->apply_from = $request->apply_from;
        $job->remark = $request->remark;
        if($cover_letter){
            $job->cover_letter = $fileNameToStore2;
        }
        if($resume){
            $job->resume = $fileNameToStore;
        }
       
        $job->organization_id = $request->organization_id;
        $job->dob = $request->dob;
        $job->status = 'Application Received';
        $job->save();



        $data = JobPost::where('id', $job->job_post_id)->select('slug', 'id')->first();
        return redirect('/career/application/' . $data->slug)->with('success', 'Send Successfully ');
    }
}
