@extends('layouts.app-input')

@section('content')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (if you haven't already included it) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


    <div class="page-content">
        <div class="container-fluid">
            <!-- Page-Title -->
            @can('attendance-create')
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="float-right">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ '/attendances' }}">attendance</a></li>
                                    <li class="breadcrumb-item active">Create New Bulk attendance </li>
                                </ol>
                            </div>
                            <h4 class="page-title"> Create Bulk attendance </h4>
                        </div>
                    </div>
                </div><!-- end page title end breadcrumb -->
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <table class="table table-striped table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Employee Name</th>
                                            <th>CheckIn Time</th>
                                            <th>Checkout Time</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="bulkTableBody">
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <select name="bulkData[0][emp_id]" class="form-control">
                                                    <option value=""></option>
                                                    @foreach ($employees as $emp)
                                                        <option value="{{ $emp->id }}">
                                                            {{ $emp->fname . ' ' . $emp->lname }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="time" name="bulkData[0][checkInTime]" class="form-control" />
                                            </td>
                                            <td>
                                                <input type="time" name="bulkData[0][checkOutTime]" class="form-control" />
                                            </td>
                                            <td>
                                                <select class="form-control" name="bulkData[0][attendance_status]">
                                                    <option value="Present">Present</option>
                                                    <option value="Absent">Absent</option>
                                                    <option value="Leave">Leave</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" onclick="AddMore()">+</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div><!-- container -->
            @endcan
            {{-- @include('layouts.footer') --}}
        </div>
        <script>
            function AddMore() {
                let trLenght = document.querySelectorAll('#bulkTableBody tr')?.length;
                console.log(trLenght);

                $('#bulkTableBody').append(`
                    <tr>
                        <td>${trLenght+1}</td>
                        <td>
                            <select name="bulkData[${trLenght}][emp_id]" class="form-control">
                                <option value=""></option>
                                @foreach ($employees as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->fname . ' ' . $emp->lname }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="time" name="bulkData[${trLenght}][checkInTime]" class="form-control" />
                        </td>
                        <td>
                            <input type="time" name="bulkData[${trLenght}][checkOutTime]" class="form-control" />
                        </td>
                        <td>
                            <select class="form-control" name="bulkData[${trLenght}][attendance_status]">
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                                <option value="Leave">Leave</option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger">-</button>
                        </td>
                    </tr>
                `)
            }
        </script>
    @endsection
