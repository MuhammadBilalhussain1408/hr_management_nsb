<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Str;
use Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      //  dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
         $user = User::create([
            'name' => $data['name'],
            'lname' => $data['lname'],
            'slug' => Str::random(8),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'company_name' => $data['company_name'],
            'immigration' => $data['immigration'],
            'terms_conditions' => $data['terms_conditions'],
        ]);
       // $role = 'Company_owner';
      //  $user->assignRole($role);
       //   Organization::create([
       //     'company_name' => $data['company_name'],
       //     'name' => $data['name'],
       //     'lname' => $data['lname'],
       //     'org_email' => $data['email'],
       //     'phone' => $data['phone'],
       //     'user_id' =>$user['id'],
       //    'slug' => Str::random(8),
       //   ]);
       //  
         return $user; 
      //  return redirect()->back()->with('success', 'User updated successfully');

    }
public function register(Request $request)
{
    $this->validator($request->all())->validate();

    $user = $this->create($request->all());

    return back()->with('success', 'User registered successfully');
}
}
