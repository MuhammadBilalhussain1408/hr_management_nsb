<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Menu;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:content-list|content-create|content-edit|content-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:content-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:content-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:content-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $datas = Content::latest()->paginate('20');
        return view('hrm.contents.index', compact('datas'));
    }
    public function create()
    {
        $menus = Menu::get();
        return view('hrm.contents.create', compact('menus'));
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
            'menu_id' => 'required',
        ]);

        // Content::create($request->all());
        $str = strtolower($request->name);
        $request['slug'] =  preg_replace('/\s+/', '-', $str);
        $data = new Content;
        $dt = now();
        $image = $request->file('image');
        $image2 = $request->file('image2');
        if ($image) {

            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore = implode('.', [
              //  $filename,
                $dt->format('YmdHis'),
                $extension
            ]);

           // $path = $image->storeAs('public/upload/content', $fileNameToStore);
            $path = public_path('upload/content');
            $image->move($path, $fileNameToStore);
            $data->image = $fileNameToStore;
        }
        if ($image2) {

            $filenameWithExt2 = $image2->getClientOriginalName();
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            $extension2 = $image2->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore2 = implode('.', [
               // $filename2,
                $dt->format('YmdHis'),
                $extension2
            ]);

           // $path = $image2->storeAs('public/upload/content', $fileNameToStore2);
            $path = public_path('upload/content');
            $image->move($path, $fileNameToStore2);
            $data->image2 = $fileNameToStore2;
        }
        $data->menu_id = $request->menu_id;
        $data->submenu_id = $request->submenu_id;
        $data->name = $request->name;
        $data->slug = preg_replace('/\s+/', '-', $str);
        $data->meta_title = $request->meta_title;
        $data->meta_keywords = $request->meta_keywords;
        $data->meta_des = $request->meta_des;
        $data->body = $request->body;
        $data->status = $request->status;
        $data->save();

        return redirect()->route('hrm.contents.index')
            ->with('success', 'content created successfully.');
    }
    public function show(Content $content)
    {
        return view('hrm.contents.show', compact('content'));
    }
    public function edit(Content $content)
    {
        $contents = Content::where('status', 'Enable')->get();
        $menus = Menu::get();
        return view('hrm.contents.edit', compact('content', 'contents','menus'));
    }
    public function update(Request $request, Content $content)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
            'menu_id' => 'required',
        ]);

        // $content->update($request->all());

        $dt = now();
        $image = $request->file('image');
        $image2 = $request->file('image2');
        if ($image) {

            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore = implode('.', [
              //  $filename,
                $dt->format('YmdHis'),
                $extension
            ]);

           // $path = $image->storeAs('public/upload/content', $fileNameToStore);
           $path = public_path('upload/content');
           $image->move($path, $fileNameToStore);
            $content->image = $fileNameToStore;
        }
        if ($image2) {

            $filenameWithExt2 = $image2->getClientOriginalName();
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            $extension2 = $image2->getClientOriginalExtension();
            //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //  $extension = $file->extension();

            $fileNameToStore2 = implode('.', [
               // $filename2,
                $dt->format('YmdHis'),
                $extension2
            ]);

           // $path = $image2->storeAs('public/upload/content', $fileNameToStore2);
            $path = public_path('upload/content');
           $image->move($path, $fileNameToStore2);
            $content->image2 = $fileNameToStore2;
        }
        $str = strtolower($request->name);
        $content->menu_id = $request->menu_id;
        $content->submenu_id = $request->submenu_id;
        $content->name = $request->name;
        $content->slug = preg_replace('/\s+/', '-', $str);
        $content->meta_title = $request->meta_title;
        $content->meta_keywords = $request->meta_keywords;
        $content->meta_des = $request->meta_des;
        $content->body = $request->body;
        $content->status = $request->status;
        $content->save();

        return redirect()->route('hrm.contents.index')
            ->with('success', 'content updated successfully');
    }
    public function destroy(Content $content)
    {
        $content->delete();

        return redirect()->route('hrm.contents.index')
            ->with('success', 'department deleted successfully');
    }
}
