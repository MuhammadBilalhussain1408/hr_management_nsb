<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;
use Image;
use Auth;

class ServiceController extends Controller
{
  function __construct()
  {
       $this->middleware('permission:service-list|service-create|service-edit|service-delete', ['only' => ['index','show']]);
       $this->middleware('permission:service-create', ['only' => ['create','store']]);
       $this->middleware('permission:service-edit', ['only' => ['edit','update']]);
       $this->middleware('permission:service-delete', ['only' => ['destroy']]);
  }
  public function index()
  {
      $user = Auth::user('id', 'name');
      $userRole = $user->roles->pluck('name')->first();
      $org = $user->org->id;
          $services = Service::get();
      return view('hrm.services.index', compact('services'));
  }

    public function create(Request $request)
    {
      return view('hrm.services.create');
    }

    public function edit(Request $request, $id)
    {
        $service = Service::where('id', $id)->first();
        $services = Service::get();
        return view('hrm.services.edit', compact('service', 'services'));
    }

    public function store(Request $request)
    {
   
      $request->validate([
        'meta_title' => 'required',
        'meta_keywords' => 'required',
       // 'thumnail' => 'mimes:jpeg,jpg,png|required|max:10000',
       // 'image' => 'mimes:jpeg,jpg,png|required|max:10000',
       // 'name' => 'required|unique:services',
        'details' => 'required',
      ],[
        'meta_title' => "Your Title is required.",
        'meta_keywords' => 'Meta keyword is required.',
       // 'name' => 'Service Title Needs to be filled up.',
        'details' => 'You have missed the service description',
      ]);

      $data = new Service;
      $data->name = $request->name;
      $data->meta_title = $request->meta_title;
      $data->slug = Str::of($request->name)->slug('-');
      $data->meta_desc = $request->meta_desc;
      $data->meta_keywords = $request->meta_keywords;
      $data->details = $request->details;
      $data->amount = $request->amount;
      $data->body = $request->body;
      $data->status = $request->status;

      if($request->hasFile('image'))
      {
          $imageName = time().'.'.$request->image->extension();
          $newPath = $request->image->move('uploads/service_image', $imageName);
          $path = "uploads/service_image/".$imageName;
          Image::make($newPath)->fit(1900, 474)->save($newPath);
          $data->image = $path;
      }
      if($request->hasFile('thumnail'))
      {
          $imageName = time().'.'.$request->thumnail->extension();
          $path = $request->thumnail->move('uploads/service_thumnail', $imageName);
          Image::make($path)->fit(750, 750)->save($path);
          $data->thumnail = $path;
      }

      $data->save();
      return redirect()->route('hrm.services.index')
      ->with('success', 'Service created successfully.');
    }
    public function update(Request $request , service $service)
    {
      // dd($request->all());
      $request->validate([
        'meta_title' => 'required',
        'meta_keywords' => 'required',
       // 'name' => 'required',
        'details' => 'required',
      ],[
        'meta_title' => "Your Title is required.",
        'meta_keywords' => 'Meta keyword is required.',
       // 'name' => 'Service Title Needs to be filled up.',
        'details' => 'You have missed the service description',
      ]);

      $data = Service::find($service->id);
      $data->name = $request->name;
      $data->meta_title = $request->meta_title;
      $data->slug = Str::of($request->name)->slug('-');
      $data->meta_desc = $request->meta_desc;
      $data->meta_keywords = $request->meta_keywords;
      $data->details = $request->details;
      $data->amount = $request->amount;
      $data->body = $request->body;
      $data->status = $request->status;

      if($request->hasFile('image'))
      {
          $imageName = time().'.'.$request->image->extension();
          $newPath = $request->image->move('uploads/service_image', $imageName);
          $path = "uploads/service_image/".$imageName;
          Image::make($newPath)->fit(1900, 474)->save($newPath);
          $data->image = $path;
      }
      if($request->hasFile('thumnail'))
      {
          $imageName = time().'.'.$request->thumnail->extension();
          $path = $request->thumnail->move('uploads/service_thumnail', $imageName);
          Image::make($path)->fit(750, 750)->save($path);
          $data->thumnail = $path;
      }
      if($request->hasFile('icon'))
      {
          $iconName = time().'.'.$request->icon->extension();
          $path = $request->icon->move('uploads/service_image/icon', $iconName);
          Image::make($path)->save($path);
          $data->icon = $path;
      }

      $data->save();
      return redirect()->route('hrm.services.index')
      ->with('success', 'Service created successfully.');
    }

   
    public function destroy(Request $request, Service $service)
    {
    //  $data = Service::find($request->id);
      if(!empty($service->image)){
        unlink($service->image);
      }
      if(!empty($service->thumnail)){
        unlink($service->thumnail);
      }
      $service->delete();
      return back()->with('success', 'A service has been deleted!');
    }
    public function get_ser(Request $request, $serid)
    {
        $sers = Service::where('id', $serid)->select('id', 'amount','details','status')->get();
        echo json_encode($sers);
    }
}
