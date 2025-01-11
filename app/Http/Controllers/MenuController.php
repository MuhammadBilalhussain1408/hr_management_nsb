<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu-list|menu-create|menu-edit|menu-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:menu-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:menu-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:menu-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $menus = Menu::latest()->paginate('20');
        return view('hrm.menus.index', compact('menus'));
    }
    public function create()
    {
        // return $user = Auth::user()->org->id;
        return view('hrm.menus.create');
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $request['name'] = $request->name;
        $str = strtolower($request->name);

        $request['slug'] =  preg_replace('/\s+/', '-', $str);

       

        $dt = now();

        $image = $request->file('image');
        if ($image) {

            $menu = Menu::find($data->id);

            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();

            $fileNameToStore = implode('.', [
              //  $filename,
                $dt->format('YmdHis'),
                $extension
            ]);

            $path = public_path('upload/cover_letter');
            $image->move($path, $fileNameToStore);
            // $path = $image->storeAs('public/upload/menu', $fileNameToStore);
             $menu->image = $fileNameToStore;
           // $menu->save();
        }
        $data = Menu::create($request->all());
        return redirect()->route('hrm.menus.index')
            ->with('success', 'menu created successfully.');
    }
    public function show(Menu $menu)
    {
        return view('hrm.menus.show', compact('menu'));
    }
    public function edit(Menu $menu)
    {
        return view('hrm.menus.edit', compact('menu'));
    }
    public function update(Request $request, Menu $menu)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
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

            $fileNameToStore = implode('.', [
               // $filename,
                $dt->format('YmdHis'),
                $extension
            ]);

            $path = public_path('upload/menu');
            $image->move($path, $fileNameToStore);
          //  $path = $image->storeAs('public/upload/menu', $fileNameToStore);
             $menu->image = $fileNameToStore;
           
           // $menu->save();
        }
        $menu->update($request->all());


        return redirect()->route('hrm.menus.index')
            ->with('success', 'menu updated successfully');
    }
    public function destroy(Menu $menu)
    {
        $menu->delete();
    
        return redirect()->route('hrm.menus.index')
                        ->with('success','menu deleted successfully');
    }
}
