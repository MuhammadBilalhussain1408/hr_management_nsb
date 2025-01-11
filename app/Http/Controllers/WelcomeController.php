<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Content;
use Validator;
use App\Models\Contact;
use App\Models\JobPost;
use App\Models\Organization;
use App\Mail\ContactEmail;
use Mail;


class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $data = Menu::where('id',1)->with('contents')->first();
        $blogs = Content::where('menu_id',12)->where('status','Enable')->orderBy('id','desc')->take(3)->get();
        $datas = Menu::orderBy('id','asc')->with('submenus')->where('status','Enable')->get();
        $con = Menu::where('slug','LIKE','contact'.'%')->take('1')->first();
           $about = $datas->where('id',2)->first();
        if($about){
           $contents = $about->contents()->take('4')->get();
        }
        else{
         $contents = '';
        }
       
        $service = $datas->where('id',3)->first();
         if($service){
           $ser_contents = $service->contents()->take('4')->get();
         }
         else{
          $ser_contents = '';
         }
        return view('welcome', compact('data','datas','con','blogs'));
    }
    public function about(Request $request)
    {
        $data =  Menu::where('slug','LIKE','about'.'%')->take('1')->first();
        $con = Menu::where('slug','LIKE','contact'.'%')->take('1')->first();
        $datas = Menu::orderBy('id','asc')->with('submenus')->where('status','Enable')->get();
       // $content = $data->contents()->orderBy('id','desc')->where('status','Enable')->limit('100')->get();
       return view('pages.about', compact('data','datas','con'));
    }
    public function page(Request $request, $slug)
    {
        $data = Menu::where('slug',$slug)->first();
        if(empty($data)){
            $data = Submenu::where('slug',$slug)->first();
        }
        $con = Menu::where('slug','LIKE','contact'.'%')->take('1')->first();
        $datas = Menu::orderBy('id','asc')->with('submenus')->where('status','Enable')->get();
        if($data->slug == 'login'){
            return view('auth.login', compact('data','datas'));
        }
        else{
            $content = $data->contents()->orderBy('id','desc')->where('status','Enable')->limit('50')->get();
        }
        //return $content; 

        return view('page', compact('data','datas','con','content'));
    }
    public function service(Request $request, $slug)
    {
        $data = Submenu::where('slug',$slug)->first();
        $submenus = Submenu::where('menu_id',$data->menu_id)->get();
        $datas = Menu::orderBy('id','asc')->with('submenus')->where('status','Enable')->get();
        $content = $data->contents()->orderBy('id','desc')->where('status','Enable')->limit('50')->get();
       return view('pages.service', compact('data','datas','submenus','content'));
    }
    public function view(Request $request, $slug)
    {
        $data = Content::where('slug',$slug)->first();
        $con = Menu::where('slug','LIKE','contact'.'%')->take('1')->first();
        $datas = Menu::orderBy('id','asc')->with('submenus')->where('status','Enable')->get();
     
        return view('pages.details', compact('data','datas','con'));
    }
    public function cleint_reviews(Request $request)
    {
        $data = Menu::where('id','3')->first();
        $datas = Menu::orderBy('id','asc')->with('submenus')->where('status','Enable')->get();
        return view('cleint-reviews', compact('data','datas','testimonials','com','cart'));
    }
    public function faq(Request $request)
    {
        $data = Menu::where('slug','faq')->first();
        $con = Menu::where('slug','LIKE','contact'.'%')->take('1')->first();
        $datas = Menu::orderBy('id','asc')->with('submenus')->where('status','Enable')->get();
        $content = $data->contents()->orderBy('id','desc')->where('status','Enable')->limit('100')->get();
        return view('faq', compact('data','datas','product','con','cart','content'));
    }
  
    public function contact_us(Request $request)
    {
        $data =  Menu::where('slug','LIKE','contact'.'%')->take('1')->first();
        $con = Menu::where('slug','LIKE','contact'.'%')->take('1')->first();
        $datas = Menu::orderBy('id','asc')->with('submenus')->where('status','Enable')->get();
       // $content = $data->contents()->orderBy('id','desc')->where('status','Enable')->limit('100')->get();
       return view('pages.contact', compact('data','datas','con'));
    }

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

        $mail2 =['info@ukhrcloud.com'];
        // return $email;
        Mail::to($mail2)->queue(new ContactEmail($data));
        return redirect()->back()->with('success','Successfully send your mail');
    }
    public function login(Request $request)
    {
        $data = Menu::where('slug','home')->first();
        $datas = Menu::orderBy('id','asc')->with('submenus')->where('status','Enable')->get();
       return view('auth.login', compact('data','datas'));
    }
    public function admin(Request $request)
    {
        $data = Menu::where('slug','home')->first();
        $datas = Menu::orderBy('id','asc')->with('submenus')->where('status','Enable')->get();
        return view('auth.login', ['url' => route('admin.login'), 'title'=>'Admin']);
    }
    public function register(Request $request)
    {
        $data = Menu::where('slug','home')->first();
        $datas = Menu::orderBy('id','asc')->with('submenus')->where('status','Enable')->get();
       return view('auth.register', compact('data','datas'));
    }
    public function career(Request $request, $slug)
    {
        $data = JobPost::where('slug',$slug)->first();
        $datas = Menu::orderBy('id','asc')->with('submenus')->where('status','Enable')->get();
        $org = Organization::where('id',$data->organization_id)->select('company_name')->first();
     
        return view('pages.career', compact('data','datas','org'));
    }
    public function application(Request $request, $slug)
    {
        $data = JobPost::where('slug',$slug)->first();
        $datas = Menu::orderBy('id','asc')->with('submenus')->where('status','Enable')->get();
        $org = Organization::where('id',$data->organization_id)->select('company_name','address','zip','post_code','address1','country','city','road')->first();
     
        return view('pages.career_application', compact('data','datas','org'));
    }
    public function errors(Request $request)
    {
        $data = Menu::where('slug','home')->first();
        $datas = Menu::orderBy('id','asc')->with('submenus')->where('status','Enable')->get();
       return view('errors.404', compact('data','datas'));
    }
}
