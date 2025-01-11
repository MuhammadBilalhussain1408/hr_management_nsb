<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Service;
use App\Models\Bank;
use App\Models\Organization;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class InvoiceController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:invoice-list|invoice-create|invoice-edit|invoice-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:invoice-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:invoice-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:invoice-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $invoices = Invoice::paginate(20);
        } else {
            $invoices = Invoice::where('organization_id', $org)->paginate(20);
        }
        return view('hrm.invoice.index', compact('invoices'));
    }
    public function create()
    {
        $organizations = Organization::get();
        $services = Service::where('status', 'Enable')->get();
        $banks = Bank::where('status', 'Enable')->get();

        return view('hrm.invoice.create', compact('services', 'banks','organizations'));
    }
    public function store(Request $request)
    {
        request()->validate([
            'service_id' => 'required',
            'status' => 'required',
        ]);

        $request['invoice_no'] = Carbon::now()->format('yms');
        $data = Invoice::create($request->all());

        return redirect()->route('hrm.invoices.index')
            ->with('success', 'Invoice created successfully.');
    }
    public function show(Invoice $invoice)
    {
        return view('hrm.invoice.show', compact('invoice'));
    }
    public function edit(Invoice $invoice)
    {
        $organizations = Organization::get();
        $services = Service::where('status', 'Enable')->get();
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        $banks = Bank::where('status', 'Enable')->get();

        // if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
        //     $banks = Bank::where('organization_id', $org)->where('status','Enable')->get();
        // } else {
        //     $banks = Bank::where('organization_id', $org)->where('status','Enable')->get();
        // }
        return view('hrm.invoice.edit', compact('invoice', 'services', 'banks','organizations'));
    }
    public function update(Request $request, Invoice $invoice)
    {
        request()->validate([
            'service_id' => 'required',
            'status' => 'required',
        ]);
        $request['invoice_no'] = $invoice->invoice_no;
        $invoice->update($request->all());

        return redirect()->route('hrm.invoices.index')
            ->with('success', 'Invoice updated successfully');
    }
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('hrm.invoices.index')
            ->with('success', 'Invoice deleted successfully');
    }
}
