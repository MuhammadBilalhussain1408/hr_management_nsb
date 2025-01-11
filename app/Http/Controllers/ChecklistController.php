<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;

class ChecklistController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:checklist-list|checklist-create|checklist-edit|checklist-delete', ['only' => ['index','show']]);
         $this->middleware('permission:checklist-create', ['only' => ['create','store']]);
         $this->middleware('permission:checklist-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:checklist-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checklists = Checklist::latest()->paginate('20');
        return view('hrm.checklists.index',compact('checklists'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hrm.checklists.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
    
        Checklist::create($request->all());
    
        return redirect()->route('hrm.checklists.index')
                        ->with('success','checklist created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist)
    {
        return view('hrm.checklists.show',compact('checklist'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist)
    {
        return view('hrm.checklists.edit',compact('checklist'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checklist $checklist)
    {
         request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
    
        $checklist->update($request->all());
    
        return redirect()->route('hrm.checklists.index')
                        ->with('success','checklist updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist)
    {
        $checklist->delete();
    
        return redirect()->route('hrm.checklists.index')
                        ->with('success','checklist deleted successfully');
    }
}
