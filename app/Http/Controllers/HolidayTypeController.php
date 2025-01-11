<?php

namespace App\Http\Controllers;

use App\Models\HolidayType;
use App\Models\Organization;
use Illuminate\Http\Request;
use Auth;
use Str;

class HolidayTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:HolidayType-list|HolidayType-create|HolidayType-edit|HolidayType-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:HolidayType-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:HolidayType-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:HolidayType-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $holiday_types = HolidayType::latest()->paginate('20');
        } else {
            $holiday_types = HolidayType::latest()->where('organization_id', $org)->paginate('20');
        }

        return view('hrm.holiday_types.index', compact('holiday_types'));
    }
    public function create()
    {
        // return $user = Auth::user()->org->id;
        return view('hrm.holiday_types.create');
    }
    public function store(Request $request)
    {
        $request['slug'] = $request->organization_id . Str::random(8);
        request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        HolidayType::create($request->all());

        return redirect()->route('hrm.holiday_types.index')
            ->with('success', 'holiday_type created successfully.');
    }


    public function show(HolidayType $holidayType)
    {
        //
    }


    public function edit($id)
    {
        $holidayType = HolidayType::where('slug', $id)->first();
        return view('hrm.holiday_types.edit', compact('holidayType'));
    }


    public function update(Request $request, HolidayType $holidayType)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        //  $request['slug'] = Str::random(8);
        $holidayType->update($request->all());

        return redirect()->route('hrm.holiday_types.index')
            ->with('success', 'holidayType updated successfully');
    }


    public function destroy(HolidayType $holidayType)
    {
        $holidayType->delete();

        return redirect()->route('hrm.holiday_types.index')
            ->with('success', 'holidayType deleted successfully');
    }
}
