@extends('layouts.app-datatables')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.employees.create') }}"> Add New Employee</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-10 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-3">employees</h5>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        {!! Form::open(array('route' => 'hrm.search.contract_agreement','method'=>'POST')) !!}
                        <div class="row form-group">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Employee type:</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control" id="employee_type_id" required="" name="employee_type_id" onchange="chngdepartment(this.value);">
                                        <option value="">Select All</option>
                                        @forelse($etypes as $emp)
                                        <option value="{{$emp->id}}">{{$emp->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Employee Code:</strong>
                                    <input class="form-control" type="hidden" name="organization_id" value="{{Auth::user()->org->id}}">
                                    <select class="form-control" id="employee_id" required="" name="employee_id">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                           
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Go</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <div class="table-responsive">
                            <table id="datatable-buttons" data-order='[[ 0, "asc" ]]' data-page-length='20' class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Employee Name</th>
                                        <th>DOB</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Designation</th>
                                        <th>NI Number</th>
                                        <th>Visa Expired</th>
                                        <th>Passport No</th>
                                        <th>Passport Expiry date</th>
                                        <th>Address</th>
                                        <th>Job Join date</th>
                                        <th>NID</th>
                                        <th>Visa Expiry date</th>
                                        <th>Visa Review </th>
                                        <th>Euss Detail </th>
                                        <th>DBS Detail </th>
                                        <th>Nation Id Details </th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->code }}</td>
                                        <td>{{ $employee->fname }} {{ $employee->mid_name }} {{ $employee->lname }}</td>
                                        <td>{{ $employee->dob }}</td>
                                        <td>{{ $employee->con_number }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>@if($employee->designation){{ $employee->designation->name }}@endif</td>
                                        <td>{{ $employee->ni_no }}</td>
                                        <td>{{ $employee->visa }}</td>
                                        <td>{{ $employee->passport_no }}</td>
                                        <td>{{ $employee->expiry_date }}</td>
                                        <td>{{ $employee->street_address }}, {{ $employee->city }}, {{ $employee->country }} </td>
                                        <td>{{ $employee->join_date }}</td>
                                        <td>{{ $employee->nid }}</td>
                                        <td>{{ $employee->v_expiry_date }}</td>
                                        <td>{{ $employee->v_eligible_date }}</td>
                                        <td>{{ $employee->euss_remarks }}</td>
                                        <td>{{ $employee->dbs_remarks }}</td>
                                        <td>{{ $employee->nid_remarks }}</td>
                                        <td>
                                            <!-- <button type="submit" onclick="downloadTwo()" class="btn btn-primary">excel</button> -->
                                            <a class="btn btn-info" href="{{ route('hrm.employees.agreement',$employee->id) }}">Download PDF</a>
                                            <a class="btn btn-success" href="{{ route('hrm.emp_excel',$employee->id) }}">Download Excel</a>
                                          
                                        </td>
                                    </tr>
                                    @empty
                                    <p>No users</p>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- container -->
    @include('layouts.footer')
</div><!-- end page content -->
@include('layouts.script')
<script>
    function downloadTwo() {
        //jquery selection can be achieve via vanilla JS
        let dateVal = $("[name='date']").val();
        @foreach($employees as $employee)
        window.open("{{URL::to('emp_excel/'.$employee->id)}}?data=purcache&date=" + dateVal, "_blank");
        @endforeach

        return false;
    }
</script>
@endsection