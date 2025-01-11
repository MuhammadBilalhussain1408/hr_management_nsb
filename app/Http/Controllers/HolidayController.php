<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\HolidayType;
use App\Models\Organization;
use Illuminate\Http\Request;
use Auth;
use Str;

class HolidayController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:holiday-list|holiday-create|holiday-edit|holiday-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:holiday-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:holiday-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:holiday-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole =='Admin')) {
            $holidays = Holiday::with('holiday_types')->paginate('20');
        } else {
            $holidays = Holiday::with('holiday_types')->where('organization_id', $org)->paginate('20');
        }

        return view('hrm.holidays.index', compact('holidays'));
    }
    public function create()
    {
         $org = Auth::user()->org->id;
        $htypes = HolidayType::where('status', 'Enable')->where('organization_id', $org)->get();
        return view('hrm.holidays.create', compact('htypes'));
    }
    public function store(Request $request)
    {
        // dd($request);
        $request['slug'] = $request->organization_id . Str::random(8);
        request()->validate([
            'from_date' => 'required',
            'to_date' => 'required',
            'holiday_type_id' => 'required',
            'organization_id' => 'required',
        ]);


        Holiday::create($request->all());

        return redirect()->route('hrm.holidays.index')
            ->with('success', 'holiday created successfully.');
    }
    public function show(Holiday $holiday)
    {
        //
    }

    public function edit($id)
    {
         $org = Auth::user()->org->id;
        $holiday = Holiday::where('slug', $id)->first();
        $htypes = HolidayType::where('status', 'Enable')->where('organization_id', $org)->get();
        return view('hrm.holidays.edit', compact('holiday', 'htypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        request()->validate([
            'from_date' => 'required',
            'to_date' => 'required',
            'holiday_type_id' => 'required',
            'organization_id' => 'required',
        ]);
        //   $request['slug'] = Str::random(8);
        $holiday->update($request->all());

        return redirect()->route('hrm.holidays.index')
            ->with('success', 'holiday updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        return redirect()->route('hrm.holidays.index')
            ->with('success', 'holiday deleted successfully');
    }
}
