<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:gallery-list|gallery-create|gallery-edit|gallery-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:gallery-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:gallery-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:gallery-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $galleries = Gallery::latest()->paginate('20');
        return view('hrm.gallery.index', compact('galleries'));
    }
    public function create()
    {
        // return $user = Auth::user()->org->id;
        return view('hrm.gallery.create');
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $request['name'] = $request->name;

        $data = Gallery::create($request->all());

        $dt = now();

        $image = $request->file('image');
        if ($image) {

            $gallery = Gallery::find($data->id);

            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();

            $fileNameToStore = implode('.', [
              //  $filename,
                $dt->format('YmdHis'),
                $extension
            ]);

            $path = public_path('upload/gallery');
            $image->move($path, $fileNameToStore);
            // $path = $image->storeAs('public/upload/gallery', $fileNameToStore);
             $gallery->image = $fileNameToStore;
             $gallery->save();
        }
       
        return redirect()->route('hrm.galleries.index')
            ->with('success', 'gallery created successfully.');
    }
    public function show(Gallery $gallery)
    {
        return view('hrm.gallery.show', compact('gallery'));
    }
    public function edit(Gallery $gallery)
    {
        return view('hrm.gallery.edit', compact('gallery'));
    }
    public function update(Request $request,Gallery $gallery)
    {
        request()->validate([
            'name' => 'required',
        ]);


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

           // $path = $image->storeAs('public/upload/gallery', $fileNameToStore);
           $path = public_path('upload/gallery');
           $image->move($path, $fileNameToStore);
            $gallery->image = $fileNameToStore;
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

           // $path = $image2->storeAs('public/upload/gallery', $fileNameToStore2);
            $path = public_path('upload/gallery');
            $image->move($path, $fileNameToStore2);
            $gallery->image2 = $fileNameToStore2;
        }
        $gallery->name = $request->name;
        $gallery->status = $request->status;
        $gallery->save();

        return redirect()->route('hrm.galleries.index')
            ->with('success', 'gallery updated successfully');
    }
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
    
        return redirect()->route('hrm.galleries.index')
                        ->with('success','gallery deleted successfully');
    }
}
