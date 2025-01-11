<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Str;
use Auth;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $data = User::orderBy('id', 'DESC')->get();
        } else {
            $data = User::orderBy('id', 'DESC')->where('id',$user->id)->orWhere('organization_id',$org)->get();
        }
       
        return view('hrm.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
         if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $roles = Role::pluck('name', 'name')->all();
        } else {
            $roles = Role::where('name', 'Employee')->pluck('name', 'name')->all();
        }
        

        return view('hrm.users.create', compact('roles','userRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['slug'] = Str::random(8);
        $input['company_name'] = $request->company_name;

        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        $org = new Organization;
        $org->user_id = $user->id;
        $org->company_name = $request->company_name;
        $org['slug'] = Str::random(8);
        $org->save();

        return redirect()->route('hrm.users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('hrm.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auth_user = Auth::user('id', 'name');
        $user = User::find($id);
      //  $userRole = $auth_user->roles->pluck('name')->all();
        $userRole = $auth_user->roles->pluck('name')->first();
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $roles = Role::pluck('name', 'name')->all();
        } else {
           // $org = $user->org->id;
            $roles = Role::where('name', 'Employee')->pluck('name', 'name')->all();
        }
       

        return view('hrm.users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        if (empty($user->slug)) {
            $input['slug'] = Str::random(8);
        }
        $input['terms_conditions'] = 'Yes';
        $input['immigration'] = 'Yes';
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));
        $org = Organization::where('user_id', $user->id)->first();
        if (empty($org)) {
            $org = new Organization;
            $org->user_id = $user->id;
            $org->company_name = $request->company_name;
            $org->f_name = $request->name;
            $org['slug'] = Str::random(8);
            $org->org_email = $request->email;
            $org->phone = $request->phone;
           
            $org->save();
        }
         if (empty($org->slug)){
             $org['slug'] = Str::random(8);
             $org->save();
         }
        return redirect()->route('hrm.users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('hrm.users.index')
            ->with('success', 'User deleted successfully');
    }
}
