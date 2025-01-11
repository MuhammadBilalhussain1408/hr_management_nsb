<?php

namespace App\Http\Controllers;

use App\Models\Submenu;
use App\Models\Menu;
use Illuminate\Http\Request;

class SubmenuController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:submenu-list|submenu-create|submenu-edit|submenu-delete', ['only' => ['index','show']]);
         $this->middleware('permission:submenu-create', ['only' => ['create','store']]);
         $this->middleware('permission:submenu-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:submenu-delete', ['only' => ['destroy']]);
    }
  
    public function index()
    {
        $submenus = Submenu::latest()->paginate('20');
        return view('hrm.submenus.index',compact('submenus'));
    }
    public function create()
    {
        $menus = Menu::where('status','Enable')->get();
        return view('hrm.submenus.create',compact('menus'));
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
            'menu_id' => 'required',
        ]);
    
       // $request['name'] = $request->name;
        $str = strtolower($request->name);

        $request['slug'] =  preg_replace('/\s+/', '-', $str);
        $data = new Submenu;
        $dt = now();
        $image = $request->file('image');
        if ($image) {

            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore = implode('.', [
               // $filename,
                $dt->format('YmdHis'),
                $extension
            ]);

          //  $path = $image->storeAs('public/upload/submenu', $fileNameToStore);
            $path = public_path('upload/submenu');
            $image->move($path, $fileNameToStore);
            $data->image = $fileNameToStore;
           
        }
        $data->menu_id = $request->menu_id;
        $data->name = $request->name;
        $data->slug = preg_replace('/\s+/', '-', $str);
        $data->meta_title = $request->meta_title;
        $data->meta_keywords = $request->meta_keywords;
        $data->meta_des = $request->meta_des;
        $data->body = $request->body;
        $data->status = $request->status;
        $data->save();
    
        return redirect()->route('hrm.submenus.index')
                        ->with('success','submenu created successfully.');
    }
    public function show(Submenu $submenu)
    {
        return view('hrm.submenus.show',compact('submenu'));
    }
    public function edit(Submenu $submenu)
    {
        $menus = Menu::where('status','Enable')->get();
        return view('hrm.submenus.edit',compact('submenu','menus'));
    }
    public function update(Request $request, Submenu $submenu)
    {
      //  dd($request);
         request()->validate([
            'name' => 'required',
            'status' => 'required',
            'menu_id' => 'required',
        ]);
        $request['name'] = $request->name;
        $str = strtolower($request->name);

        $request['slug'] =  preg_replace('/\s+/', '-', $str);

       
        $dt = now();
        $image = $request->file('image');
        if ($image) {

            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore = implode('.', [
               // $filename,
                $dt->format('YmdHis'),
                $extension
            ]);

           // $path = $image->storeAs('public/upload/submenu', $fileNameToStore);
            $path = public_path('upload/submenu');
            $image->move($path, $fileNameToStore);
            $submenu->image = $fileNameToStore;
        }
      //  $submenu->update($request->all());
        $submenu->menu_id = $request->menu_id;
        $submenu->name = $request->name;
        $submenu->slug = preg_replace('/\s+/', '-', $str);
        $submenu->meta_title = $request->meta_title;
        $submenu->meta_keywords = $request->meta_keywords;
        $submenu->meta_des = $request->meta_des;
        $submenu->body = $request->body;
        $submenu->status = $request->status;
        $submenu->save();
    
        return redirect()->route('hrm.submenus.index')
                        ->with('success','submenu updated successfully');
    }
    public function destroy(Submenu $submenu)
    {
        $submenu->delete();
    
        return redirect()->route('hrm.submenus.index')
                        ->with('success','submenus deleted successfully');
    }
    public function get_submenu(Request $request, $id)
    {
        $sub = Submenu::where([['menu_id', $id]])->select('id', 'name', 'menu_id','slug')->get();
        echo json_encode($sub);
    }
}
