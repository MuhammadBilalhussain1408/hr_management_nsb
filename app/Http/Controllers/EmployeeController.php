<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use App\Models\EmployeeType;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Bank;
use App\Models\Tax;
use App\Models\EmpEducation;
use App\Models\EmpJob;
use App\Models\EmpTaining;
use App\Models\EmpEmergCon;
use App\Models\EmpPassport;
use App\Models\EmpConInfo;
use App\Models\EmpOther;
use App\Models\Taxable;
use App\Models\Diduction;
use App\Models\EmpPay;
use App\Models\EmpDbs;
use App\Models\EmpEuss;
use App\Models\EmpVisa;
use App\Models\EmpNid;
use App\Models\EmpODoc;
use App\Models\Organization;
use Auth;
use DB;
use Carbon\Carbon;
use Mail;
use App\Mail\LetterEmail;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:employee-list|employee-create|employee-edit|employee-delete|only-organization', ['only' => ['index', 'show']]);
        $this->middleware('permission:employee-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:employee-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:employee-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $employees = Employee::get();
        } else {
            $employees = Employee::where('organization_id', $org)->get();
        }

        return view('hrm.employees.index', compact('employees'));
    }

    public function create()
    {
        $user = Auth::user()->slug;
        $org = Auth::user()->org->id;
        $organization = Organization::where('slug', $user)->select('id', 'company_name')->first();
        $countries = Country::select('name', 'slug')->where('status', 1)->get();
        $currency = Currency::select('name')->where('status', 1)->get();
        $banks = Bank::select('id', 'name')->where('organization_id', $org)->where('status', 1)->get();
        $taxes = Tax::select('id', 'tax_code')->where('organization_id', $org)->where('status', 1)->get();
        $departments = Department::select('id', 'name')->where('organization_id', $org)->orderBy('name', 'asc')->where('status', 'Enable')->get();
        $emptypes = EmployeeType::select('id', 'name')->where('organization_id', $org)->orderBy('name', 'asc')->where('status', 'Enable')->get();
        $employees = Employee::where('organization_id', $org)->select('id', 'fname', 'lname', 'mid_name')->get();
        $taxables = Taxable::select('id', 'name')->get();
        $diductions = Diduction::select('id', 'name')->get();
        return view('hrm.employees.create', compact('countries', 'currency', 'banks', 'taxes', 'departments', 'emptypes', 'employees', 'taxables', 'diductions', 'organization'));
    }


    public function store(Request $request)
    {
        request()->validate([
            'fname' => 'required',
            'lname' => 'required',
        ]);

        $data = Employee::create($request->all());
        $dt = now();
        $emp = Employee::find($data->id);
        $value = $request->company_name;
        $emp->code =  strtok($value, " ") . $data->id;
        $image = $request->file('image');
        if ($image) {

            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore = implode('.', [
                $filename,
                $dt->format('YmdHis'),
                $extension
            ]);

           // $path = $image->storeAs('public/upload/image', $fileNameToStore);
            $path = public_path('upload/image');
            $image->move($path, $fileNameToStore);
            $emp->image = $fileNameToStore;
        }
        $pr_add_proof = $request->file('pr_add_proof');
        if ($pr_add_proof) {

            $filenameWithExt2 = $pr_add_proof->getClientOriginalName();
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            $extension2 = $pr_add_proof->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore2 = implode('.', [
                $filename2,
                $dt->format('YmdHis'),
                $extension2
            ]);

           // $path = $image->storeAs('public/upload/image', $fileNameToStore2);
             $path = public_path('upload/image');
            $pr_add_proof->move($path, $fileNameToStore2);
            $emp->pr_add_proof = $fileNameToStore2;
        }
        $vf_proof = $request->file('vf_proof');
        if ($vf_proof) {

            $filenameWithExt3 = $vf_proof->getClientOriginalName();
            $filename3 = pathinfo($filenameWithExt3, PATHINFO_FILENAME);
            $extension3 = $vf_proof->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore3 = implode('.', [
                $filename3,
                $dt->format('YmdHis'),
                $extension3
            ]);

           // $path = $vf_proof->storeAs('public/upload/image', $fileNameToStore3);
             $path = public_path('upload/image');
            $vf_proof->move($path, $fileNameToStore3);
            $emp->vf_proof = $fileNameToStore3;
        }
        $vb_proof = $request->file('vb_proof');
        if ($vb_proof) {

            $filenameWithExt4 = $vb_proof->getClientOriginalName();
            $filename4 = pathinfo($filenameWithExt4, PATHINFO_FILENAME);
            $extension4 = $vb_proof->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore4 = implode('.', [
                $filename4,
                $dt->format('YmdHis'),
                $extension4
            ]);

           // $path = $vb_proof->storeAs('public/upload/image', $fileNameToStore4);
            $path = public_path('upload/image');
            $vb_proof->move($path, $fileNameToStore4);
            
            $emp->vb_proof = $fileNameToStore4;
        }
        $euss_proof = $request->file('euss_proof');
        if ($euss_proof) {

            $filenameWithExt5 = $euss_proof->getClientOriginalName();
            $filename5 = pathinfo($filenameWithExt5, PATHINFO_FILENAME);
            $extension5 = $euss_proof->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore5 = implode('.', [
                $filename5,
                $dt->format('YmdHis'),
                $extension5
            ]);

           // $path = $euss_proof->storeAs('public/upload/image', $fileNameToStore5);
              $path = public_path('upload/image');
            $euss_proof->move($path, $fileNameToStore5);
            $emp->euss_proof = $fileNameToStore5;
        }
        $dbs_proof = $request->file('dbs_proof');
        if ($dbs_proof) {

            $filenameWithExt6 = $dbs_proof->getClientOriginalName();
            $filename6 = pathinfo($filenameWithExt6, PATHINFO_FILENAME);
            $extension6 = $dbs_proof->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore6 = implode('.', [
                $filename6,
                $dt->format('YmdHis'),
                $extension6
            ]);

           // $path = $dbs_proof->storeAs('public/upload/image', $fileNameToStore6);
            $path = public_path('upload/image');
            $dbs_proof->move($path, $fileNameToStore6);
            $emp->dbs_proof = $fileNameToStore6;
        }
        $passport_proof = $request->file('passport_proof');
        if ($passport_proof) {

            $filenameWithExt7 = $passport_proof->getClientOriginalName();
            $filename7 = pathinfo($filenameWithExt7, PATHINFO_FILENAME);
            $extension7 = $passport_proof->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore7 = implode('.', [
                $filename7,
                $dt->format('YmdHis'),
                $extension7
            ]);

          //  $path = $passport_proof->storeAs('public/upload/image', $fileNameToStore7);
            $path = public_path('upload/image');
            $passport_proof->move($path, $fileNameToStore7);
            $emp->passport_proof = $fileNameToStore7;
        }
        $emp->save();

        $datas2 = $request['education'];
        if ($datas2) {
            foreach ($datas2 as $key => $all) {

                $data2 = new EmpEducation;
                $data2->employee_id = $data->id;

                foreach ($all as $key2 => $value) {

                    if ($key2 == 'qulification') {
                        $qulification = $value;
                    }
                    if ($key2 == 'subject') {
                        $subject = $value;
                    }
                    if ($key2 == 'institute') {
                        $institute = $value;
                    }
                    if ($key2 == 'uni') {
                        $uni = $value;
                    }
                    if ($key2 == 'passing_year') {
                        $passing_year = $value;
                    }
                    if ($key2 == 'percent') {
                        $percent = $value;
                    }
                    if ($key2 == 'grade') {
                        $grade = $value;
                    }
                    if ($key2 == 'doc_tran') {
                        $doc_tran = $value;
                    } else {
                        $doc_tran = '';
                    }
                    if ($key2 == 'doc_cer') {
                        $doc_cer = $value;
                    } else {
                        $doc_cer = '';
                    }
                }
                $data2->qulification = $qulification;
                $data2->subject = $subject;
                $data2->institute = $institute;
                $data2->uni = $uni;
                $data2->passing_year = $passing_year;
                $data2->percent = $percent;
                $data2->grade = $grade;
                $data2->doc_tran = $doc_tran;
                $data2->doc_cer = $doc_cer;
                $data2->save();
            }
        }

        $datas3 = $request['car'];
        if ($datas3) {
            foreach ($datas3 as $key => $all) {

                $data3 = new EmpJob;

                foreach ($all as $key2 => $value) {

                    if ($key2 == 'title') {
                        $title = $value;
                    }
                    if ($key2 == 'start_date') {
                        $start_date = $value;
                    }
                    if ($key2 == 'end_date') {
                        $end_date = $value;
                    }
                    if ($key2 == 'year_exp') {
                        $year_exp = $value;
                    }

                    if ($key2 == 'description') {
                        $description = $value;
                    }
                }
                foreach ($all as $key2 => $value2) {

                    if ($key2 == 'passing_year') {
                        $passing = $value2;
                    }
                }

                $data3->employee_id = $data->id;
                $data3->title = $title;
                $data3->start_date = $start_date;
                $data3->end_date = $end_date;
                $data3->year_exp = $year_exp;
                $data3->description = $description;
                $data3->save();
            }
        }
        $datas4 = $request['taining'];
        if ($datas4) {
            foreach ($datas4 as $key => $all) {

                $data4 = new EmpTaining;

                foreach ($all as $key2 => $value) {

                    if ($key2 == 'title') {
                        $title = $value;
                    }
                    if ($key2 == 'start_date') {
                        $start_date = $value;
                    }
                    if ($key2 == 'end_date') {
                        $end_date = $value;
                    }

                    if ($key2 == 'description') {
                        $description = $value;
                    }
                }

                $data4->employee_id = $data->id;
                $data4->title = $title;
                $data4->start_date = $start_date;
                $data4->end_date = $end_date;
                $data4->description = $description;
                $data4->save();
            }
        }
        if ($request->name) {
            $data5 = new EmpEmergCon;
            $data5->employee_id = $data->id;
            $data5->name = $request->name;
            $data5->relation = $request->relation;
            $data5->emg_email = $request->emg_email;
            $data5->emg_phone = $request->emg_phone;
            $data5->emg_address = $request->emg_address;
            $data5->save();
        }
        if ($request->postcode) {
            $data5 = new EmpConInfo;
            $data5->employee_id = $data->id;
            $data5->postcode = $request->postcode;
            $data5->se_add = $request->se_add;
            $data5->street_address = $request->street_address;
            $data5->state = $request->state;
            $data5->city = $request->city;
            $data5->ctyzen_country = $request->ctyzen_country;
            $data5->add_proof = $request->add_proof;
            $data5->save();
        }
        $datas7 = $request['other'];
        if ($datas7) {
            foreach ($datas7 as $key => $all) {

                $data7 = new EmpOther;

                foreach ($all as $key2 => $value) {

                    if ($key2 == 'title') {
                        $title = $value;
                    }
                    if ($key2 == 'doc') {
                        $doc = $value;
                    } else {
                        $doc = '';
                    }
                }

                $data7->employee_id = $data->id;
                $data7->title = $title;
                $data7->doc = $doc;
                $data7->save();
            }
        }
        //    if($request->passport){
        //     $data8 = new EmpPassport;
        //     $data8->employee_id = $data->id;
        //     $data8->passport_no = $request->passport_no;
        //     $data8->nationality = $request->epass_nationality;
        //     $data8->bith_place = $request->bith_place;
        //     $data8->issued_by = $request->issued_by;
        //     $data8->expiry_date = $request->expiry_date;
        //     $data8->eligible_for = $request->eligible_for;
        //     $data8->pr_add_proof = $request->pr_add_proof;
        //     $data8->crn_passport = $request->crn_passport;
        //     $data8->passport_remarks = $request->passport_remarks;
        //     $data8->save();
        //    }
        //    if($request->visa_no){
        //     $data9 = new EmpVisa;
        //     $data9->employee_id = $data->id;
        //     $data9->visa_no = $request->visa_no;
        //     $data9->visa_nation = $request->visa_nation;
        //     $data9->visa_resi = $request->visa_resi;
        //     $data9->v_issued_by = $request->v_issued_by;
        //     $data9->v_issued_date = $request->v_issued_date;
        //     $data9->v_expiry_date = $request->v_expiry_date;
        //     $data9->v_eligible_date = $request->v_eligible_date;
        //     $data9->vf_proof = $request->vf_proof;
        //     $data9->vb_proof = $request->vb_proof;
        //     $data9->crn_visa = $request->crn_visa;
        //     $data9->visa_remarks = $request->visa_remarks;
        //     $data9->save();
        //    }
        //    if($request->euss_no){
        //     $data10 = new EmpEuss;
        //     $data10->employee_id = $data->id;
        //     $data10->euss_no = $request->euss_no;
        //     $data10->euss_nation = $request->euss_nation;
        //     $data10->e_issued_by = $request->e_issued_by;
        //     $data10->e_issued_date = $request->e_issued_date;
        //     $data10->e_expiry_date = $request->e_expiry_date;
        //     $data10->e_eligible_date = $request->e_eligible_date;
        //     $data10->euss_proof = $request->euss_proof;
        //     $data10->crn_status = $request->crn_status;
        //     $data10->euss_remarks = $request->euss_remarks;
        //     $data10->save();
        //    }
        //    if($request->dbs_no){
        //     $data11 = new EmpDbs;
        //     $data11->employee_id = $data->id;
        //     $data11->dbs_type = $request->dbs_type;
        //     $data11->dbs_no = $request->dbs_no;
        //     $data11->dbs_nation = $request->dbs_nation;
        //     $data11->dbs_issued_by = $request->dbs_issued_by;
        //     $data11->dbs_issued_date = $request->dbs_issued_date;
        //     $data11->dbs_expiry_date = $request->dbs_expiry_date;
        //     $data11->dbs_eligible_date = $request->dbs_eligible_date;
        //     $data11->dbs_proof = $request->dbs_proof;
        //     $data11->dbs_status = $request->dbs_status;
        //     $data11->dbs_remarks = $request->dbs_remarks;
        //     $data11->save();
        //    }
        if ($request->nid) {
            $data11 = new EmpNid;
            $data11->employee_id = $data->id;
            $data11->nid = $request->nid;
            $data11->nid_nation = $request->nid_nation;
            $data11->nid_resi = $request->nid_resi;
            $data11->nid_issued_date = $request->nid_issued_date;
            $data11->nid_expiry_date = $request->nid_expiry_date;
            $data11->nid_eligible_date = $request->nid_eligible_date;
            $data11->nid_proof = $request->nid_proof;
            $data11->nid_status = $request->nid_status;
            $data11->nid_remarks = $request->nid_remarks;
            $data11->save();
        }
        $datas13 = $request['other_doc'];
        if ($datas13) {
            foreach ($datas13 as $key => $all) {

                $data13 = new EmpODoc;
                $data13->employee_id = $data->id;

                foreach ($all as $key2 => $value) {

                    if ($key2 == 'o_title') {
                        $o_title = $value;
                    }
                    if ($key2 == 'o_nation') {
                        $o_nation = $value;
                    }
                    if ($key2 == 'o_issued_date') {
                        $o_issued_date = $value;
                    }
                    if ($key2 == 'o_expiry_date') {
                        $o_expiry_date = $value;
                    }
                    if ($key2 == 'o_eligible_date') {
                        $o_eligible_date = $value;
                    }
                    if ($key2 == 'o_proof') {
                        $o_proof = $value;
                    } else {
                        $o_proof = '';
                    }
                    if ($key2 == 'o_remarks') {
                        $o_remarks = $value;
                    }
                }
                $data13->o_title = $o_title;
                $data13->o_nation = $o_nation;
                $data13->o_issued_date = $o_issued_date;
                $data13->o_expiry_date = $o_expiry_date;
                $data13->o_eligible_date = $o_eligible_date;
                $data13->o_proof = $o_proof;
                $data13->o_remarks = $o_remarks;
                $data13->save();
            }
        }
        if ($request->emp_group_name) {
            $data14 = new EmpPay;
            $data14->employee_id = $data->id;
            $data14->emp_group_name = $request->emp_group_name;
            $data14->emp_pay_scale = $request->emp_pay_scale;
            $data14->wedges_paymode = $request->wedges_paymode;
            $data14->emp_payment_type = $request->emp_payment_type;
            $data14->daily = $request->daily;
            $data14->min_work = $request->min_work;
            $data14->min_rate = $request->min_rate;
            $data14->tax_ref = $request->tax_ref;
            $data14->tax_per = $request->tax_per;
            $data14->emp_pay_type = $request->emp_pay_type;
            $data14->emp_bank_name = $request->emp_bank_name;
            $data14->bank_branch_id = $request->bank_branch_id;
            $data14->emp_account_no = $request->emp_account_no;
            $data14->emp_sort_code = $request->emp_sort_code;
            $data14->currency = $request->currency;
            $data14->save();
        }
        $data->emptax()->attach($request->taxable_id);
        $data->empdiduc()->attach($request->diduction_id);


        return redirect()->route('hrm.employees.index')
            ->with('success', 'employee created successfully.');
    }

    public function show(Employee $employee)
    {
        $org =  Organization::where('id', $employee->organization_id)->first();
        // return $employee->org_emp;
        return view('hrm.employees.show', compact('employee', 'org'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $user = Auth::user()->slug;
        $org = Auth::user()->org->id;
        $organization = Organization::where('slug', $user)->select('id', 'company_name')->first();
        $countries = Country::select('name', 'slug')->where('status', 1)->get();
        $currency = Currency::select('name')->where('status', 1)->get();
        $banks = Bank::select('id', 'name')->where('organization_id', $org)->where('status', 1)->get();
        $taxes = Tax::select('id', 'tax_code')->where('organization_id', $org)->where('status', 1)->get();
        $departments = Department::select('id', 'name')->where('organization_id', $org)->orderBy('name', 'asc')->where('status', 'Enable')->get();
        $emptypes = EmployeeType::select('id', 'name')->where('organization_id', $org)->orderBy('name', 'asc')->where('status', 'Enable')->get();
        $employees = Employee::where('organization_id', $org)->select('id', 'fname', 'lname', 'mid_name')->get();
        $taxables = Taxable::select('id', 'name')->get();
        $diductions = Diduction::select('id', 'name')->get();
        // $employee->emp_coninfo;
        return view('hrm.employees.edit', compact('employee', 'countries', 'currency', 'banks', 'taxes', 'departments', 'emptypes', 'employees', 'taxables', 'diductions', 'organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function emp_update(Request $request, Employee $employee)
    {
        request()->validate([
            // 'name' => 'required',
            // 'department' => 'required',
        ]);

        $employee->update($request->all());
        $dt = now();
        $employee_id =  $request->employee_id;

        $emp = Employee::find($request->employee_id);
        $value = $request->company_name;
        $emp->code =  strtok($value, " ") . $employee_id;
        $image = $request->file('image');
        if ($image) {

            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore = implode('.', [
                $filename,
                $dt->format('YmdHis'),
                $extension
            ]);

           // $path = $image->storeAs('public/upload/image', $fileNameToStore);
            $path = public_path('upload/image');
            $image->move($path, $fileNameToStore);
            $emp->image = $fileNameToStore;
        }
        $pr_add_proof = $request->file('pr_add_proof');
        if ($pr_add_proof) {

            $filenameWithExt2 = $pr_add_proof->getClientOriginalName();
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            $extension2 = $pr_add_proof->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore2 = implode('.', [
                $filename2,
                $dt->format('YmdHis'),
                $extension2
            ]);

          //  $path = $pr_add_proof->storeAs('public/upload/image', $fileNameToStore2);
            $path = public_path('upload/image');
            $pr_add_proof->move($path, $fileNameToStore2);
            $emp->pr_add_proof = $fileNameToStore2;
        }
        $vf_proof = $request->file('vf_proof');
        if ($vf_proof) {

            $filenameWithExt3 = $vf_proof->getClientOriginalName();
            $filename3 = pathinfo($filenameWithExt3, PATHINFO_FILENAME);
            $extension3 = $vf_proof->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore3 = implode('.', [
                $filename3,
                $dt->format('YmdHis'),
                $extension3
            ]);

           // $path = $vf_proof->storeAs('public/upload/image', $fileNameToStore3);
            $path = public_path('upload/image');
            $vf_proof->move($path, $fileNameToStore3);
            $emp->vf_proof = $fileNameToStore3;
        }
        $vb_proof = $request->file('vb_proof');
        if ($vb_proof) {

            $filenameWithExt4 = $vb_proof->getClientOriginalName();
            $filename4 = pathinfo($filenameWithExt4, PATHINFO_FILENAME);
            $extension4 = $vb_proof->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore4 = implode('.', [
                $filename4,
                $dt->format('YmdHis'),
                $extension4
            ]);

           // $path = $vb_proof->storeAs('public/upload/image', $fileNameToStore4);
             $path = public_path('upload/image');
            $vb_proof->move($path, $fileNameToStore4);
            $emp->vb_proof = $fileNameToStore4;
        }
        $euss_proof = $request->file('euss_proof');
        if ($euss_proof) {

            $filenameWithExt5 = $euss_proof->getClientOriginalName();
            $filename5 = pathinfo($filenameWithExt5, PATHINFO_FILENAME);
            $extension5 = $euss_proof->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore5 = implode('.', [
                $filename5,
                $dt->format('YmdHis'),
                $extension5
            ]);

           // $path = $euss_proof->storeAs('public/upload/image', $fileNameToStore5);
            $path = public_path('upload/image');
            $euss_proof->move($path, $fileNameToStore5);
            $emp->euss_proof = $fileNameToStore5;
        }
        $dbs_proof = $request->file('dbs_proof');
        if ($dbs_proof) {

            $filenameWithExt6 = $dbs_proof->getClientOriginalName();
            $filename6 = pathinfo($filenameWithExt6, PATHINFO_FILENAME);
            $extension6 = $dbs_proof->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore6 = implode('.', [
                $filename6,
                $dt->format('YmdHis'),
                $extension6
            ]);

           // $path = $dbs_proof->storeAs('public/upload/image', $fileNameToStore6);
            $path = public_path('upload/image');
            $dbs_proof->move($path, $fileNameToStore6);
            $emp->dbs_proof = $fileNameToStore6;
        }
        $passport_proof = $request->file('passport_proof');
        if ($passport_proof) {

            $filenameWithExt7 = $passport_proof->getClientOriginalName();
            $filename7 = pathinfo($filenameWithExt7, PATHINFO_FILENAME);
            $extension7 = $passport_proof->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore7 = implode('.', [
                $filename7,
                $dt->format('YmdHis'),
                $extension7
            ]);
            $path = public_path('upload/image');
            $passport_proof->move($path, $fileNameToStore7);
            
           // $path = $passport_proof->storeAs('public/upload/image', $fileNameToStore7);
            $emp->passport_proof = $fileNameToStore7;
        }

        $emp->save();

        $datas2 = $request['education'];
        $education = $request->file(['education']);
        if ($education) {
            foreach ($education as $key => $all) {

                foreach ($all as $key2 => $value) {

                    if ($datas2[0]['id']) {
                        $id = $datas2[0]['id'];
                    }
                    if ($datas2[0]['qulification']) {
                        $qulification = $datas2[0]['qulification'];
                    }
                    if ($datas2[0]['subject']) {
                        $subject = $datas2[0]['subject'];
                    }
                    if ($datas2[0]['institute']) {
                        $institute = $datas2[0]['id'];
                    }
                    if ($datas2[0]['uni']) {
                        $uni = $datas2[0]['institute'];
                    }
                    if ($datas2[0]['passing_year']) {
                        $passing_year = $datas2[0]['id'];
                    }
                    if ($datas2[0]['percent']) {
                        $percent = $datas2[0]['passing_year'];
                    }
                    if ($datas2[0]['grade']) {
                        $grade = $datas2[0]['grade'];
                    }
                    if ($key2 == 'doc_tran') {
                        $doc_tran = $value;

                        $filenameWithExt = $doc_tran->getClientOriginalName();
                        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        $extension = $doc_tran->getClientOriginalExtension();


                        $fileNameToStore = implode('.', [
                            $filename,
                            $dt->format('YmdHis'),
                            $key2,
                            $extension
                        ]);
                       // $path = $doc_tran->storeAs('public/upload/emp_doc', $fileNameToStore);
                        $path = public_path('upload/image');
                        $doc_tran->move($path, $fileNameToStore);
            
                    } else {
                        $doc_tran = '';
                    }
                    if ($key2 == 'doc_cer') {
                        $doc_cer = $value;

                        $filenameWithExt2 = $doc_cer->getClientOriginalName();
                        $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
                        $extension2 = $doc_cer->getClientOriginalExtension();


                        $fileNameToStore2 = implode('.', [
                            $filename2,
                            $dt->format('YmdHis'),
                            $key2,
                            $extension2
                        ]);
                      //  $path = $doc_cer->storeAs('public/upload/emp_doc', $fileNameToStore2);
                      
                       $path = public_path('upload/image');
                    $doc_cer->move($path, $fileNameToStore2);
                        
                    } else {
                        $doc_cer = '';
                    }
                }

                $data2 =  EmpEducation::find($id);
                $data2->employee_id =  $request->employee_id;
                $data2->qulification = $qulification;
                $data2->subject = $subject;
                $data2->institute = $institute;
                $data2->uni = $uni;
                $data2->passing_year = $passing_year;
                $data2->percent = $percent;
                $data2->grade = $grade;
                if ($doc_tran) {
                    $data2->doc_tran = $fileNameToStore;
                }

                if ($doc_cer) {
                    $data2->doc_cer = $fileNameToStore2;
                }

                $data2->save();
            }
        } else if ($datas2) {
            foreach ($datas2 as $key => $all) {


                foreach ($all as $key2 => $value) {
                    if ($key2 == 'id') {
                        $id = $value;
                    }

                    if ($key2 == 'qulification') {
                        $qulification = $value;
                    }
                    if ($key2 == 'subject') {
                        $subject = $value;
                    }
                    if ($key2 == 'institute') {
                        $institute = $value;
                    }
                    if ($key2 == 'uni') {
                        $uni = $value;
                    }
                    if ($key2 == 'passing_year') {
                        $passing_year = $value;
                    }
                    if ($key2 == 'percent') {
                        $percent = $value;
                    }
                    if ($key2 == 'grade') {
                        $grade = $value;
                    }
                    if ($key2 == 'doc_tran') {
                        $doc_tran = $value;
                    } else {
                        $doc_tran = '';
                    }
                    if ($key2 == 'doc_cer') {
                        $doc_cer = $value;
                    } else {
                        $doc_cer = '';
                    }
                }
                $data2 =  EmpEducation::find($id);
                $data2->employee_id =  $request->employee_id;
                $data2->qulification = $qulification;
                $data2->subject = $subject;
                $data2->institute = $institute;
                $data2->uni = $uni;
                $data2->passing_year = $passing_year;
                $data2->percent = $percent;
                $data2->grade = $grade;
                $data2->doc_tran = $doc_tran;
                $data2->doc_cer = $doc_cer;
                $data2->save();
            }
        }

        $datas3 = $request['car'];
        if ($datas3) {
            foreach ($datas3 as $key => $all) {

                foreach ($all as $key2 => $value) {
                    if ($key2 == 'id') {
                        $id3 = $value;
                        $data3 =  EmpJob::find($id3);
                    } else {
                        $data3 = new EmpJob;
                    }
                    if ($key2 == 'title') {
                        $title = $value;
                        $data3->title = $title;
                    }
                    if ($key2 == 'start_date') {
                        $start_date = $value;
                        $data3->start_date = $start_date;
                    }
                    if ($key2 == 'end_date') {
                        $end_date = $value;
                        $data3->end_date = $end_date;
                    }
                    if ($key2 == 'year_exp') {
                        $year_exp = $value;
                        $data3->year_exp = $year_exp;
                    }

                    if ($key2 == 'description') {
                        $description = $value;
                        $data3->description = $description;
                    }
                    if ($key2 == 'passing_year') {
                        $passing = $value;
                        $data3->passing_year = $passing;
                    }
                    $data3->employee_id =  $request->employee_id;
                    $data3->save();
                }
            }
        }
        $datas4 = $request['taining'];
        if ($datas4) {
            foreach ($datas4 as $key => $all) {

                foreach ($all as $key2 => $value) {
                    if ($key2 == 'id') {
                        $id4 = $value;
                        $data4 =  EmpTaining::find($id4);
                    } else {
                        $data4 = new EmpTaining;
                    }
                    if ($key2 == 'title') {
                        $title = $value;
                        $data4->title = $title;
                    }
                    if ($key2 == 'start_date') {
                        $start_date = $value;
                        $data4->start_date = $start_date;
                    }
                    if ($key2 == 'end_date') {
                        $end_date = $value;
                        $data4->end_date = $end_date;
                    }

                    if ($key2 == 'description') {
                        $description = $value;
                        $data4->description = $description;
                    }
                }


                $data4->employee_id =  $request->employee_id;
                $data4->save();
            }
        }
        if ($request->emg_name) {
            $id5 = $request->emg_id;
            if ($id5) {
                $data5 = EmpEmergCon::find($id5);
            } else {
                $data5 = new EmpEmergCon;
            }
            //  return $employee;

            $data5->employee_id =  $request->employee_id;
            $data5->emg_name = $request->emg_name;
            $data5->relation = $request->relation;
            $data5->emg_email = $request->emg_email;
            $data5->emg_phone = $request->emg_phone;
            $data5->emg_address = $request->emg_address;
            $data5->save();
        }
        if ($request->emp_cinfo_id) {
            $id6 = $request->emp_cinfo_id;
            $data6 = EmpConInfo::find($id6);
        } else {
            $data6 = new EmpConInfo;
        }
        //  return  $request->employee_id;
        $data6->employee_id =  $request->employee_id;
        $data6->postcode = $request->postcode;
        $data6->se_add = $request->se_add;
        $data6->street_address = $request->street_address;
        $data6->state = $request->state;
        $data6->city = $request->city;
        $data6->ctyzen_country = $request->ctyzen_country;
        $add_proof = $request->file('add_proof');
        if ($add_proof) {

            $filenameWithExt = $add_proof->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $add_proof->getClientOriginalExtension();

            $fileNameToStore = implode('.', [
                $filename,
                $dt->format('YmdHis'),
                $extension
            ]);

           // $path = $add_proof->storeAs('public/upload/emp_doc', $fileNameToStore);
            $path = public_path('upload/image');
            $add_proof->move($path, $fileNameToStore);
                        
            $data6->add_proof = $fileNameToStore;
        }

        $data6->save();
        $datas7 = $request['other'];
        if ($datas7) {
            foreach ($datas7 as $key => $all) {



                foreach ($all as $key2 => $value) {
                    if ($key2 == 'id') {
                        $id7 = $value;
                        $data7 = EmpOther::find($id7);
                    } else {
                        $data7 = new EmpOther;
                    }
                    if ($key2 == 'title') {
                        $title = $value;
                    }
                    if ($key2 == 'doc') {
                        $doc = $value;
                    } else {
                        $doc = '';
                    }
                }

                $data7->employee_id =  $request->employee_id;
                $data7->title = $title;
                $data7->doc = $doc;
                $data7->save();
            }
        }
        // if($request->passport){
        //     $id8 = $request->passport_id;
        //     if($id8){
        //         $data8 = EmpPassport::find($id8);
        //      }
        //      else{
        //         $data8 = new EmpPassport;
        //      }

        //  $data8->employee_id =  $request->employee_id;
        //  $data8->passport_no = $request->passport_no;
        //  $data8->nationality = $request->epass_nationality;
        //  $data8->bith_place = $request->ebith_place;
        //  $data8->issued_by = $request->issued_by;
        //  $data8->expiry_date = $request->expiry_date;
        //  $data8->eligible_for = $request->eligible_for;
        //  $data8->pr_add_proof = $request->pr_add_proof;
        //  $data8->crn_passport = $request->crn_passport;
        //  $data8->passport_remarks = $request->passport_remarks;
        //  $data8->save();
        // }
        // if($request->visa_no){
        //     $id9 = $request->visa_id;
        //     if($id9){
        //         $data9 = EmpVisa::find($id9);
        //      }
        //      else{
        //         $data9 = new EmpVisa;
        //      }

        //  $data9->employee_id =  $request->employee_id;
        //  $data9->visa_no = $request->visa_no;
        //  $data9->visa_nation = $request->visa_nation;
        //  $data9->visa_resi = $request->visa_resi;
        //  $data9->v_issued_by = $request->v_issued_by;
        //  $data9->v_issued_date = $request->v_issued_date;
        //  $data9->v_expiry_date = $request->v_expiry_date;
        //  $data9->v_eligible_date = $request->v_eligible_date;
        //  $data9->vf_proof = $request->vf_proof;
        //  $data9->vb_proof = $request->vb_proof;
        //  $data9->crn_visa = $request->crn_visa;
        //  $data9->visa_remarks = $request->visa_remarks;
        //  $data9->save();
        // }
        // if($request->euss_no){
        //     $euss_id = $request->euss_id;
        //     if($euss_id){
        //         $data10 = EmpEuss::find($euss_id);
        //      }
        //      else{
        //         $data10 = new EmpEuss;
        //      }

        //  $data10->employee_id =  $request->employee_id;
        //  $data10->euss_no = $request->euss_no;
        //  $data10->euss_nation = $request->euss_nation;
        //  $data10->e_issued_by = $request->e_issued_by;
        //  $data10->e_issued_date = $request->e_issued_date;
        //  $data10->e_expiry_date = $request->e_expiry_date;
        //  $data10->e_eligible_date = $request->e_eligible_date;
        //  $data10->euss_proof = $request->euss_proof;
        //  $data10->crn_status = $request->crn_status;
        //  $data10->euss_remarks = $request->euss_remarks;
        //  $data10->save();
        // }
        // if($request->dbs_no){
        //     $dbs_id = $request->dbs_id;
        //     if($dbs_id){
        //         $data11 = EmpDbs::find($dbs_id);
        //      }
        //      else{
        //         $data11 = new EmpDbs;
        //      }

        //  $data11->employee_id =  $request->employee_id;
        //  $data11->dbs_type = $request->dbs_type;
        //  $data11->dbs_no = $request->dbs_no;
        //  $data11->dbs_nation = $request->dbs_nation;
        //  $data11->dbs_issued_by = $request->dbs_issued_by;
        //  $data11->dbs_issued_date = $request->dbs_issued_date;
        //  $data11->dbs_expiry_date = $request->dbs_expiry_date;
        //  $data11->dbs_eligible_date = $request->dbs_eligible_date;
        //  $data11->dbs_proof = $request->dbs_proof;
        //  $data11->dbs_status = $request->dbs_status;
        //  $data11->dbs_remarks = $request->dbs_remarks;
        //  $data11->save();
        // }
        if ($request->nid) {
            $nid_id = $request->nid_id;
            if ($nid_id) {
                $data11 = EmpNid::find($nid_id);
            } else {
                $data11 = new EmpNid;
            }

            $data11->employee_id =  $request->employee_id;
            $data11->nid = $request->nid;
            $data11->nid_nation = $request->nid_nation;
            $data11->nid_resi = $request->nid_resi;
            $data11->nid_issued_date = $request->nid_issued_date;
            $data11->nid_expiry_date = $request->nid_expiry_date;
            $data11->nid_eligible_date = $request->nid_eligible_date;
            $data11->nid_proof = $request->nid_proof;
            $data11->nid_status = $request->nid_status;
            $data11->nid_remarks = $request->nid_remarks;
            $data11->save();
        }
        $datas13 = $request['other_doc'];
        if ($datas13) {
            foreach ($datas13 as $key => $all) {

                foreach ($all as $key2 => $value) {

                    if ($key2 == 'o_title') {
                        $o_title = $value;
                    }
                    if ($key2 == 'o_nation') {
                        $o_nation = $value;
                    }
                    if ($key2 == 'o_issued_date') {
                        $o_issued_date = $value;
                    }
                    if ($key2 == 'o_expiry_date') {
                        $o_expiry_date = $value;
                    }
                    if ($key2 == 'o_eligible_date') {
                        $o_eligible_date = $value;
                    }
                    if ($key2 == 'o_proof') {
                        $o_proof = $value;
                    } else {
                        $o_proof = '';
                    }
                    if ($key2 == 'o_remarks') {
                        $o_remarks = $value;
                    }
                }
                $o_doc_id = $request->o_doc_id;
                if ($o_doc_id) {
                    $data13 = EmpODoc::find($o_doc_id);
                } else {
                    $data13 = new EmpODoc;
                }
                $data13->employee_id =  $request->employee_id;
                $data13->o_title = $o_title;
                $data13->o_nation = $o_nation;
                $data13->o_issued_date = $o_issued_date;
                $data13->o_expiry_date = $o_expiry_date;
                $data13->o_eligible_date = $o_eligible_date;
                $data13->o_proof = $o_proof;
                $data13->o_remarks = $o_remarks;
                $data13->save();
            }
        }
        if ($request->emp_group_name) {
            $epay_id = $request->epay_id;
            if ($epay_id) {
                $data14 = EmpPay::find($epay_id);
            } else {
                $data14 = new EmpPay;
            }

            $data14->employee_id =  $request->employee_id;
            $data14->emp_group_name = $request->emp_group_name;
            $data14->emp_pay_scale = $request->emp_pay_scale;
            $data14->wedges_paymode = $request->wedges_paymode;
            $data14->emp_payment_type = $request->emp_payment_type;
            $data14->daily = $request->daily;
            $data14->min_work = $request->min_work;
            $data14->min_rate = $request->min_rate;
            $data14->tax_ref = $request->tax_ref;
            $data14->tax_per = $request->tax_per;
            $data14->emp_pay_type = $request->emp_pay_type;
            $data14->emp_bank_name = $request->emp_bank_name;
            $data14->bank_branch_id = $request->bank_branch_id;
            $data14->emp_account_no = $request->emp_account_no;
            $data14->emp_sort_code = $request->emp_sort_code;
            $data14->currency = $request->currency;
            $data14->save();
        }
        $employee->emptax()->detach();
        $employee->emptax()->attach($request->taxable_id);
        $employee->empdiduc()->detach();
        $employee->empdiduc()->attach($request->diduction_id);

        return redirect()->route('hrm.employees.index')
            ->with('success', 'employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Employee $employee)
    {
        $employee->delete();
        $edu = DB::table('emp_education')->where('employee_id', $request->employee_id)->delete();
        // $edu->delete();

        $job =  DB::table('emp_jobs')->where('employee_id', $request->employee_id)->delete();
        $taining = DB::table('emp_tainings')->where('employee_id', $request->employee_id)->delete();
        $erg =  DB::table('emp_emerg_cons')->where('employee_id', $request->employee_id)->delete();
        $con =  DB::table('emp_con_infos')->where('employee_id', $request->employee_id)->delete();
        $other =  DB::table('emp_others')->where('employee_id', $request->employee_id)->delete();
        $otherin =  DB::table('emp_other_infos')->where('employee_id', $request->employee_id)->delete();
        $pass =  DB::table('emp_passports')->where('employee_id', $request->employee_id)->delete();
        $visa =  DB::table('emp_visas')->where('employee_id', $request->employee_id)->delete();
        $euss =  DB::table('emp_eusses')->where('employee_id', $request->employee_id)->delete();
        $emp_dbs =  DB::table('emp_dbs')->where('employee_id', $request->employee_id)->delete();
        $nid =  DB::table('emp_nids')->where('employee_id', $request->employee_id)->delete();
        $emp_o_docs =  DB::table('emp_o_docs')->where('employee_id', $request->employee_id)->delete();
        $emp_pays =  DB::table('emp_pays')->where('employee_id', $request->employee_id)->delete();
        if ($employee->emptax()) {
            $employee->emptax()->detach();
        }
        if ($employee->empdiduc()) {
            $employee->empdiduc()->detach();
        }

        return redirect()->route('hrm.employees.index')
            ->with('success', 'employee deleted successfully');
    }
    public function get_designation(Request $request, $empid)
    {
        $designations = Designation::where([['department_id', $empid]])->select('id', 'name', 'department_id')->where('status', 'Enable')->get();
        echo json_encode($designations);
    }
    public function get_emp(Request $request, $empid)
    {
        $emp = Employee::where([['id', $empid]])->with('designation')->select('id', 'fname', 'mid_name', 'lname', 'start_date', 'join_date', 'email', 'con_number')->first();
        echo json_encode($emp);
    }
    public function get_emp_doc(Request $request, $empid, $val)
    {
        $emp = Employee::where([['id', $empid]])->select('passport_proof', 'pr_add_proof', 'vf_proof', 'vb_proof', 'euss_proof', 'dbs_proof')->first();
        echo json_encode($emp);
    }
    public function get_emp_ytpe(Request $request, $empid)
    {
        $org = Auth::user()->org->id;
        $emp = Employee::where([['employee_type_id', $empid], ['organization_id', $org]])->select('id', 'fname', 'mid_name', 'lname', 'code')->get();
        echo json_encode($emp);
    }
    public function emp_excel($id)
    {
        $employee = Employee::find($id);
        $org =  Organization::where('id', $employee->organization_id)->select('company_name')->first();
        $fileName = $employee->fname . '_employee' . '.xlsx';
        return Excel::download(new EmployeesExport(['employee' => $id, 'org' => $org]), $fileName);
    }
    public function emp_migrant()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        $organization = Organization::where('id', $org)->first();
        $date = Carbon::today()->format('Y-m-d');
        $rem_1 = Carbon::today()->subDays(90)->format('Y-m-d');
        $rem_2 = Carbon::today()->subDays(60)->format('Y-m-d');
        $rem_3 = Carbon::today()->subDays(30)->format('Y-m-d');
      //  $employes1 =  Employee::where('v_expiry_date', '<=', $date)->where('v_expiry_date', '>=', $rem_1)->orwhere([['e_expiry_date', '<=', $date], ['e_expiry_date', '>=', $rem_1]])->get();
      //  $employes2 =  Employee::where('organization_id', $org)->where('v_expiry_date', '<=', $date)->where('v_expiry_date', '>=', $rem_1)->orwhere([['e_expiry_date', '<=', $date], ['e_expiry_date', '>=', $rem_1]])->get();
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $employes1 =  Employee::where('v_expiry_date', '<=', $date)->where('v_expiry_date', '>=', $rem_1)->orwhere([['e_expiry_date', '<=', $date], ['e_expiry_date', '>=', $rem_1]])->get();
            $employes2 =  Employee::where('organization_id', $org)->where('v_expiry_date', '<=', $date)->where('v_expiry_date', '>=', $rem_1)->orwhere([['e_expiry_date', '<=', $date], ['e_expiry_date', '>=', $rem_1]])->get();

        } else {
            $employes1 =  Employee::where('organization_id', $org)->where('nationality', '!=', $organization->country)->orwhere([['e_expiry_date', '<=', $date], ['e_expiry_date', '>=', $rem_1]])->get();
            $employes2 =  Employee::where('organization_id', $org)->where('v_expiry_date', '<=', $date)->where('v_expiry_date', '>=', $rem_1)->orwhere([['e_expiry_date', '<=', $date], ['e_expiry_date', '>=', $rem_1]])->get();
        }

        return view('hrm.employees.migrant', compact('employes1','employes2', 'rem_1', 'rem_2', 'rem_3'));
    }
    public function migrant_letter($emp_code, $days)
    {
        $employee = Employee::where('code', $emp_code)->first();
        $org =  Organization::where('id', $employee->organization_id)->select('company_name')->first();
        $rem = Carbon::today()->subDays($days)->format('Y-m-d');

        // $rem = $letter;
        // $date = Carbon::today()->format('Y-m-d');
        // $to = Carbon::createFromFormat('Y-m-d', $date);
        // $from = Carbon::createFromFormat('Y-m-d', $letter);

        // $days = $to->diffInDays($from);


        return view('hrm.employees.migrant_letter', compact('employee', 'org', 'rem', 'days'));
    }
    public function letter_sent(Request $request)
    {
        //  dd($request);
        $employee_id = $request->employee_id;
        $employee = Employee::where('id', $employee_id)->first();
        $org =  Organization::where('id', $employee->organization_id)->select('company_name')->first();
        $rem = Carbon::today()->subDays(90)->format('Y-m-d');
        $mail2 = $employee['email'];
        Mail::to($mail2)->queue(new LetterEmail($employee, $org, $rem));

        return redirect()->back()->with('success', 'employee updated successfully');

        // return view('hrm.employees.migrant_letter', compact('employee', 'org','rem'));
    }
    public function get_employee(Request $request)
    {
        $user = Auth::user('id');
        $org = $user->org->id;
        $emps = Employee::where('organization_id', $org)->get();
       // dd($org_id);
       // $emps = Employee::where();
        echo json_encode($emps);
    }
    public function employee_doc(Request $request)
    {
        $user = Auth::user('id');
        $org = $user->org->id;
        $emps = Employee::where('organization_id', $org)->get();
        $doc = '0';

        return view('hrm.employees.document', compact('user', 'org', 'emps'));
    }
    public function empdoc_search(Request $request)
    {
        $user = Auth::user('id');
        $org = $user->org->id;
        $employee_id = $request->employee_id;
        $doc = $request->doc;
        $emp = Employee::where('id', $employee_id)->first();

        return view('hrm.employees.document', compact('user', 'org', 'checklists', 'emp'));
    }
    public function contract_agreement(Request $request)
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
     
         if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
                $etypes = EmployeeType::where('organization_id', $org)->get();
                $employees = [];
            } else {
                $etypes = EmployeeType::where('organization_id', $org)->get();
                $employees = [];
            }
        return view('hrm.employees.contract_agreement', compact('employees','etypes'));
    }
    public function search_contract_agreement(Request $request)
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        $emp_types = $request->employee_type_id;
        $emp_id = $request->employee_id;
        if ($emp_types && $emp_id) {
            if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
                $etypes = EmployeeType::where('organization_id', $org)->get();
                $employees = Employee::where('organization_id', $org)->where('employee_type_id',$emp_types)->where('id',$emp_id)->get();
            } else {
                $etypes = EmployeeType::where('organization_id', $org)->get();
                $employees = Employee::where('organization_id', $org)->where('employee_type_id',$emp_types)->where('id',$emp_id)->get();
            }
        }
       else if($emp_types && $emp_id =='all') {
            if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
                $etypes = EmployeeType::where('organization_id', $org)->get();
                $employees = Employee::where('organization_id', $org)->where('employee_type_id',$emp_types)->get();
            } else {
                $etypes = EmployeeType::where('organization_id', $org)->get();
                $employees = Employee::where('organization_id', $org)->where('employee_type_id',$emp_types)->get();
            }
        }
        else{
            if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
                $etypes = EmployeeType::where('organization_id', $org)->get();
                $employees = [];
            } else {
                $etypes = EmployeeType::where('organization_id', $org)->get();
                $employees = [];
            }
        }
        return view('hrm.employees.contract_agreement', compact('employees','etypes'));
    }
    public function agreement(Employee $employee)
    {
        $org =  Organization::where('id', $employee->organization_id)->first();
        return view('hrm.employees.agreement', compact('employee', 'org'));
    }
    public function change_cercumastances(Employee $employee)
    {
        $user = Auth::user()->slug;
        $org = Auth::user()->org->id;
        $organization = Organization::where('slug', $user)->select('id', 'company_name')->first();
        $countries = Country::select('name', 'slug')->where('status', 1)->get();
        $currency = Currency::select('name')->where('status', 1)->get();
        $banks = Bank::select('id', 'name')->where('organization_id', $org)->where('status', 1)->get();
        $taxes = Tax::select('id', 'tax_code')->where('organization_id', $org)->where('status', 1)->get();
        $departments = Department::select('id', 'name')->where('organization_id', $org)->orderBy('name', 'asc')->where('status', 'Enable')->get();
        $emptypes = EmployeeType::select('id', 'name')->where('organization_id', $org)->orderBy('name', 'asc')->where('status', 'Enable')->get();
        $employees = Employee::where('organization_id', $org)->select('id', 'fname', 'lname', 'mid_name')->get();
        $taxables = Taxable::select('id', 'name')->get();
        $diductions = Diduction::select('id', 'name')->get();
        // $employee->emp_coninfo;
        return view('hrm.employees.change_cercumastances', compact('employee', 'countries', 'currency', 'banks', 'taxes', 'departments', 'emptypes', 'employees', 'taxables', 'diductions', 'organization'));
    }
    public function change_cercumastances_emp(Request $request, Employee $employee)
    {
        request()->validate([
             'date_change' => 'required',
            // 'department' => 'required',
        ]);

        

        $emp = Employee::find($employee->id);
        $emp->date_change = $request->date_change;
        $emp->home = $request->home;
        $emp->date_change = $request->date_change;
        $emp->hr = $request->hr;
        $emp->save();

        return redirect()->route('hrm.cercumastances')
            ->with('success', 'Cercumastances add successfully');
    }
    public function cercumastances()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $employees = Employee::where('date_change','!=',NULL)->get();
        } else {
            $employees = Employee::where('organization_id', $org)->where('date_change','!=',NULL)->get();
        }

        return view('hrm.employees.cercumastances', compact('employees'));
    }
    public function cercumastances_view(Employee $employee)
    {
        $org =  Organization::where('id', $employee->organization_id)->first();
        // return $employee->org_emp;
        return view('hrm.employees.view_cercumastances', compact('employee', 'org'));
    }
}
