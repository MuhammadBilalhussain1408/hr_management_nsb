<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Checklist;
use App\Models\Document;
use App\Models\Organization;
use App\Models\OrgType;
use App\Models\Employee;
use App\Models\Sector;
use App\Models\Trading;
use Auth;
use DB;

class OrganizationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:organization-list|organization-create|organization-edit|organization-delete', ['only' => ['index', 'show', 'view']]);
        $this->middleware('permission:organization-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:organization-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:organization-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $org = Auth::user()->org->id;
        $organizations = Organization::where('id', $org)->get();
        return view('hrm.organizations.index', compact('organizations'));
    }

    public function create()
    {
        return view('hrm.organizations.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
        ]);

        Organization::create($request->all());

        return redirect()->route('hrm.organizations.index')
            ->with('success', 'organization created successfully.');
    }

    public function show(Request $request, $id)
    {
        $user = User::where('slug', $id)->select('id', 'slug')->first();
        $org = Auth::user()->org->slug;
        $organization = Organization::where('slug', $id)->first();

        return view('hrm.organizations.show', compact('organization'));
    }
    public function get_org(Request $request, $empid)
    {
        $organization = Organization::where('slug', $empid)->first();
        return view('hrm.organizations.show', compact('organization'));
    }

    public function edit(Request $request, $id)
    {
        $user = User::where('slug', $id)->select('id', 'name', 'slug', 'email', 'phone', 'address', 'company_name', 'website', 'immigration', 'terms_conditions')->first();

        $org = Auth::user()->org->id;
        $organization = Organization::where('id', $org)->first();
        // return $organization->trading;
        $checklists = Checklist::select('name', 'id')->where('status', 'Enable')->get();
        $countries = Country::select('name', 'slug')->where('status', 1)->get();
        $org_types = OrgType::where('status', 'Enable')->get();
        $employees = Employee::where('organization_id', $org)->get();
        $sectors = Sector::where('status', 'Enable')->get();

        // return $organization->docs;
        // return $organization->user;
        return view('hrm.organizations.edit', compact('user', 'organization', 'countries', 'checklists', 'org_types', 'employees', 'sectors'));
    }

    public function update(Request $request, Organization $organization)
    {
        //  dd($request);
        request()->validate([
            'company_name' => 'required',
        ]);

        $organization->update($request->all());

        $dt = now();
        $proof = $request->file('proof');
        $level_proof = $request->file('level_proof');
        $file = $request->file('image');
        $logo = $request->file('logo');
        $key_proof = $request->file('key_proof');
        if ($file) {

            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();


            $fileNameToStore = implode('.', [
                $filename,
                $dt->format('YmdHis'),
                $extension
            ]);

           // $path = $file->storeAs('public/upload/photo', $fileNameToStore);
            $path = public_path('upload/photo');
            $file->move($path, $fileNameToStore);
            $organization->image = $fileNameToStore;
        }
        if ($logo) {

            $filenameWithExt2 = $logo->getClientOriginalName();
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            $extension2 = $logo->getClientOriginalExtension();


            $fileNameToStore2 = implode('.', [
                $filename2,
                $dt->format('YmdHis'),
                $extension2
            ]);

           // $path2 = $logo->storeAs('public/upload/logo', $fileNameToStore2);
             $path2 = public_path('upload/logo');
            $logo->move($path2, $fileNameToStore2);
            $organization->logo = $fileNameToStore2;
        }
        if ($proof) {

            $filenameWithExt3 = $proof->getClientOriginalName();
            $filename3 = pathinfo($filenameWithExt3, PATHINFO_FILENAME);
            $extension3 = $proof->getClientOriginalExtension();


            $fileNameToStore3 = implode('.', [
                $filename3,
                $dt->format('YmdHis'),
                $extension3
            ]);

           // $path3 = $proof->storeAs('public/upload/proof', $fileNameToStore3);
             $path3 = public_path('upload/proof');
            $proof->move($path3, $fileNameToStore3);
            $organization->proof = $fileNameToStore3;
        }
        if ($level_proof) {

            $filenameWithExt4 = $level_proof->getClientOriginalName();
            $filename4 = pathinfo($filenameWithExt4, PATHINFO_FILENAME);
            $extension4 = $level_proof->getClientOriginalExtension();


            $fileNameToStore4 = implode('.', [
                $filename4,
                $dt->format('YmdHis'),
                $extension4
            ]);

           // $path4 = $level_proof->storeAs('public/upload/level_proof', $fileNameToStore4);
            $path4 = public_path('upload/level_proof');
            $level_proof->move($path4, $fileNameToStore4);
            $organization->level_proof = $fileNameToStore4;
        }
        if ($key_proof) {

            $filenameWithExt4 = $key_proof->getClientOriginalName();
            $filename4 = pathinfo($filenameWithExt4, PATHINFO_FILENAME);
            $extension4 = $key_proof->getClientOriginalExtension();


            $fileNameToStore4 = implode('.', [
                $filename4,
                $dt->format('YmdHis'),
                $extension4
            ]);

            //$path4 = $key_proof->storeAs('public/upload/key_proof', $fileNameToStore4);
              $path4 = public_path('upload/key_proof');
            $key_proof->move($path4, $fileNameToStore4);
            $organization->key_proof = $fileNameToStore4;
        }

        $organization->save();
        // $request->file(['checklist']);
        // $datas = $request['checklist'];
        // if( $datas){
        //  foreach ($datas as $key => $all) { 
        //     $docs = new Document;
        //      foreach ($all as $key2 => $value) {

        //          if ($key2 == 'name') {
        //              $name = $value;
        //          }
        //          if ($key2 == 'image') {
        //              $image = $value;
        //          }
        //      }

        //     $docs->organization_id = $organization->id;
        //     $docs->name = $name;
        //     $docs->image = $image;
        //     $docs->save();
        //  }
        // }
        $trading = $request['trading'];
        if ($trading) {
            DB::table("tradings")->where('organization_id', $organization->id)->delete();
            foreach ($trading as $key => $all) {
                $docs = new Trading;
                foreach ($all as $key2 => $value) {

                    if ($key2 == 'day') {
                        $day = $value;
                    }
                    if ($key2 == 'day_status') {
                        $day_status = $value;
                    }
                    if ($key2 == 'day_open') {
                        $day_open = $value;
                    }
                    if ($key2 == 'day_close') {
                        $day_close = $value;
                    }
                }

                $docs->organization_id = $organization->id;
                $docs->day = $day;
                $docs->day_status = $day_status;
                $docs->day_open = $day_open;
                $docs->day_close = $day_close;
                $docs->save();
            }
        }


        $checklists = $request->file(['checklist']);
        $datas = $request['checklist'];
        if ($checklists) {
            foreach ($checklists as $key => $all) {
                $chk = new Document;
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
              //  $path = $image->storeAs('public/upload/doc', $fileNameToStore);
                
                $path = public_path('upload/doc');
                $image->move($path, $fileNameToStore);
            
                $chk->organization_id = $organization->id;
                $chk->name = $name;
                $chk->image = $fileNameToStore;
                $chk->save();
            }
        }
        $user = User::where('id', $organization->user_id)->value('slug');
        return redirect('/hrm/organizations' . '/' . $organization->slug)
            ->with('success', 'organization updated successfully');
    }
    public function org_view(Request $request, $slug)
    {
        $user = User::where('slug', $slug)->select('id', 'name', 'slug')->first();
        $org = Auth::user()->org->id;
        $organization = Organization::where('id', $org)->first();
        $checklists = Checklist::select('name', 'id')->where('status', 'Enable')->get();
        $countries = Country::select('name', 'slug')->where('status', 1)->get();
        $org_types = OrgType::where('status', 'Enable')->get();
        $employees = Employee::where('organization_id', $org)->get();
        $sectors = Sector::where('status', 'Enable')->get();

        return view('hrm.organizations.view', compact('user', 'organization', 'countries', 'checklists', 'org_types', 'employees', 'sectors'));
    }

    public function destroy(User $organization)
    {
        $organization->delete();

        return redirect()->route('hrm.organizations.index')
            ->with('success', 'organization deleted successfully');
    }
    public function organization_doc(Request $request)
    {
        $user = Auth::user('id');
        $org = $user->org->id;
        $checklists = Document::where('organization_id', $org)->get();
        $doc = '0';

        return view('hrm.organizations.document', compact('user', 'org', 'checklists', 'doc'));
    }
    public function doc_search(Request $request)
    {
        $user = Auth::user('id');
        $org = $user->org->id;
        $doc_id = $request->document_id;
        $checklists = Document::where('organization_id', $org)->get();
        $doc = Document::where('id', $doc_id)->first();

        return view('hrm.organizations.document', compact('user', 'org', 'checklists', 'doc'));
    }
}
