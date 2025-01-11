@extends('layouts.app-datatables')
@section('content')
<div class="page-content">
    <div class="container-fluid">
     
        <div class="row">
            <div class="col-md-10 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0">employees</h5>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="datatable-buttons" data-order='[[ 0, "asc" ]]' data-page-length='20' class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Employee Name</th>
                                        <th>DOB</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Nationality</th>
                                        <th>NI Number</th>
                                        <th>Visa Expired</th>
                                        <th>Visa Reminder 90 days</th>
                                        <th>view</th>
                                        <th class="dt-no-sorting">Send</th>
                                        <th>Visa Reminder 60 days</th>
                                        <th>view</th>
                                        <th class="dt-no-sorting">Send</th>
                                        <th>Visa Reminder 30 days </th>
                                        <th>view</th>
                                        <th class="dt-no-sorting">Send</th>
                                        <th>Euss Reminder 90 days</th>
                                        <th>view</th>
                                        <th class="dt-no-sorting">Send</th>
                                        <th>Euss Reminder 60 days</th>
                                        <th>view</th>
                                        <th class="dt-no-sorting">Send</th>
                                        <th>Euss Reminder 30 days</th>
                                        <th>view</th>
                                        <th class="dt-no-sorting">Send</th>
                                        <th>Passport NO</th>
                                        <th>Address</th>
                                        <th>Email Send</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @can('employee-list')
                                    @foreach ($employes1 as $key => $emp1)
                                    <tr>
                                        <td>{{ $emp1->id }}</td>
                                        <td>{{ $emp1->fname}} {{ $emp1->mid_name }} {{ $emp1->lname }}</td>
                                        <td>{{ $emp1->dob }}</td>
                                        <td>{{ $emp1->con_number }}</td>
                                        <td>{{ $emp1->email }}</td>
                                        <td>{{ $emp1->nationality }}</td>
                                        <td>{{ $emp1->ni_no }}</td>
                                        <td>{{ $emp1->v_expiry_date }}</td>
                                        <td>{{ $rem_1 }}</td> 
                                        <td>
                                            <a class="btn" href="{{ URL::to('hrm/migrant_letter/'.$emp1->code.'/90') }}"><span class="fa fa-eye"> </span></a>
                                        </td>
                                        <td>
                                            {!! Form::open(array('route' => 'hrm.letter_sent','method'=>'POST')) !!}
                                            <input type="hidden" name="employee_id" value="{{$emp1->id}}">
                                            <input type="hidden" name="rem" value="{{$rem_1}}">
                                            <button type="submit" class="btn"><span class="fa fa-paper-plane"> </span> </button>
                                            {!! Form::close() !!}
                                        </td>
                                        <td>{{ $rem_2 }}</td>
                                        <td>
                                            <a class="btn" href="{{ URL::to('hrm/migrant_letter/'.$emp1->code.'/60') }}"><span class="fa fa-eye"> </span></a>
                                        </td>
                                        <td>
                                        {!! Form::open(array('route' => 'hrm.letter_sent','method'=>'POST')) !!}
                                            <input type="hidden" name="employee_id" value="{{$emp1->id}}">
                                            <input type="hidden" name="rem" value="{{$rem_2}}">
                                            <button type="submit" class="btn"><span class="fa fa-paper-plane"> </span> </button>
                                            {!! Form::close() !!}                                        </td>
                                        <td>{{ $rem_3 }}</td>
                                        <td>
                                            <a class="btn" href="{{ URL::to('hrm/migrant_letter/'.$emp1->code.'/30') }}"><span class="fa fa-eye"> </span></a>
                                        </td>
                                        <td>
                                        {!! Form::open(array('route' => 'hrm.letter_sent','method'=>'POST')) !!}
                                            <input type="hidden" name="employee_id" value="{{$emp1->id}}">
                                            <input type="hidden" name="rem" value="{{$rem_3}}">
                                            <button type="submit" class="btn"><span class="fa fa-paper-plane"> </span> </button>
                                            {!! Form::close() !!}                                        </td>
                                        <td>{{ $rem_1 }}</td>
                                        <td>
                                            <a class="btn" href="{{ URL::to('hrm/migrant_letter/'.$emp1->code.'/90') }}"><span class="fa fa-eye"> </span></a>
                                        </td>
                                        <td>
                                        {!! Form::open(array('route' => 'hrm.letter_sent','method'=>'POST')) !!}
                                            <input type="hidden" name="employee_id" value="{{$emp1->id}}">
                                            <input type="hidden" name="rem" value="{{$rem_1}}">
                                            <button type="submit" class="btn"><span class="fa fa-paper-plane"> </span> </button>
                                            {!! Form::close() !!}                                        </td>
                                        <td>{{ $rem_2 }}</td>
                                        <td>
                                            <a class="btn" href="{{ URL::to('hrm/migrant_letter/'.$emp1->code.'/60') }}"><span class="fa fa-eye"> </span></a>
                                        </td>
                                        <td>
                                        {!! Form::open(array('route' => 'hrm.letter_sent','method'=>'POST')) !!}
                                            <input type="hidden" name="employee_id" value="{{$emp1->id}}">
                                            <input type="hidden" name="rem" value="{{$rem_2}}">
                                            <button type="submit" class="btn"><span class="fa fa-paper-plane"> </span> </button>
                                            {!! Form::close() !!}                                        </td>
                                        <td>{{ $rem_3 }}</td>
                                        <td>
                                            <a class="btn" href="{{ URL::to('hrm/migrant_letter/'.$emp1->code.'/30') }}"><span class="fa fa-eye"> </span></a>
                                        </td>
                                        <td>
                                        {!! Form::open(array('route' => 'hrm.letter_sent','method'=>'POST')) !!}
                                            <input type="hidden" name="employee_id" value="{{$emp1->id}}">
                                            <input type="hidden" name="rem" value="{{$rem_3}}">
                                            <button type="submit" class="btn"><span class="fa fa-paper-plane"> </span> </button>
                                            {!! Form::close() !!}                                        </td>
                                        <td>{{ $emp1->passport_no }}</td>
                                        <td>{{ $emp1->nationality }}</td>
                                        <td>
                                            <a class="btn" href="{{ URL::to('hrm/migrant_letter/'.$emp1->code.'/90') }}"><span class="fa fa-paper-plane"> </span></a>
                                        </td>
                                        <td>
                                        <a class="btn" href="{{ route('hrm.emp_excel',$emp1->id) }}"><span class="fa fa-download"> </span></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endcan
                                    @can('only-organization')
                                    @foreach ($employes2 as $key => $emp2)
                                    <tr>
                                        <td>{{ $emp2->id }}</td>
                                        <td>{{ $emp2->fname}} {{ $emp2->mid_name }} {{ $emp2->lname }}</td>
                                        <td>{{ $emp2->dob }}</td>
                                        <td>{{ $emp2->con_number }}</td>
                                        <td>{{ $emp2->email }}</td>
                                        <td>{{ $emp2->nationality }}</td>
                                        <td>{{ $emp2->ni_no }}</td>
                                        <td>{{ $emp2->v_expiry_date }}</td>
                                        <td>{{ $rem_1 }}</td>
                                        <td>
                                            <a class="btn" href="{{ route('hrm.employees.show',$emp2->id) }}"><span class="fa fa-eye"> </span></a>
                                        </td>
                                        <td>
                                            <a class="btn" href="{{ route('hrm.employees.show',$emp2->id) }}"><span class="fa fa-paper-plane"> </span></a>
                                        </td>
                                        <td> 
                                            <a class="btn" href="{{ route('hrm.emp_excel',$emp2->id) }}"><span class="fa fa-download"> </span></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endcan
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

@endsection