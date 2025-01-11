@extends('layouts.app-input')
@section('content')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        @can('Leave-allocation-list')
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">LeaveAllocations Management
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        {!! Form::open(array('route' => 'hrm.leave_report_excell','method'=>'POST')) !!}
                        <div class="row form-group">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="from_date" class="placeholder"> Year </label>
                                    <select class="form-control" id="effect_year" required="" name="effect_year">
                                        <option value="">Select</option>
                                        {{ $last= date('Y')-4 }}
                                        {{ $now = date('Y')+4 }}

                                        @for ($i = $now; $i >= $last; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="from_date" class="placeholder"> Employee </label>
                                    <select class="form-control" id="employee_id" required="" name="employee_id">
                                        <option value="">Select</option>
                                        @forelse($employees as $emp)
                                        <option value="{{$emp->id}}">{{ $emp->fname }} {{ $emp->mid_name }} {{ $emp->lname }} ({{ $emp->code }})</option>
                                        @empty
                                        @endforelse

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Create New LeaveAllocation</button>
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
        @endcan
    </div><!-- container -->
    @include('layouts.footer')
</div><!-- end page content -->

@endsection