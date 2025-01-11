<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:document-list|document-create|document-edit|document-delete', ['only' => ['index','show']]);
         $this->middleware('permission:document-create', ['only' => ['create','store']]);
         $this->middleware('permission:document-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:document-delete', ['only' => ['destroy']]);
    }
  
    public function index()
    {
        $documents = Document::latest()->paginate('20');
        return view('documents.index',compact('documents'));
    }
    public function create()
    {
        return view('documents.create');
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
    
        Document::create($request->all());
    
        return redirect()->route('documents.index')
                        ->with('success','document created successfully.');
    }
    public function show(Document $document)
    {
        return view('documents.show',compact('document'));
    }
    public function edit(Document $document)
    {
        return view('documents.edit',compact('document'));
    }
    public function update(Request $request, Document $document)
    {
         request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
    
        $document->update($request->all());
    
        return redirect()->route('documents.index')
                        ->with('success','document updated successfully');
    }
    public function destroy(Document $Document)
    {
        $Document->delete();
    
        return redirect()->back()->with('success','document deleted successfully');
    }
}
