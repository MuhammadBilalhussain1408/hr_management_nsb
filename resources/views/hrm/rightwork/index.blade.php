@extends('layouts.app-datatables')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box"> <a class="btn btn-success" href="{{ route('hrm.right_works.create') }}"> Add New right_work</a>
                </div>
            </div>
        </div><!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-md-12 mt-0">
                <div class="card">
                    <div class="card-body"><h5 class="mt-0">right_works</h5>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="datatable-buttons" data-order='[[ 0, "asc" ]]' data-page-length='20' class="table table-striped table-bordered w-100">
                                 <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Employee name</th>
                                        <th>Date of Check</th>
                                        <th>Type of Check</th>
                                        <th class="dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($datas as $key => $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>@forelse($data->employees as $emp) {{ $emp->fname }} {{ $emp->mid_name }} {{ $emp->lname }} @empty @endforelse</td>
                                        <td>{{ $data->check_date }}</td>
                                        <td>
                                            @forelse($data->checktypes as $ctype)
                                            {{ $ctype->name }}
                                            @empty
                                            @endforelse
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('hrm.rightwork_excel',$data->id) }}"><span class="fa fa-download"></span> </a>
                                            <a class="btn btn-primary" href="{{ route('hrm.right_works.show',$data->id) }}"><span class="fa fa-eye"></span></a>
                                            @can('RightWork-edit')
                                                <a class="btn btn-primary" href="{{ route('hrm.right_works.edit',$data->id) }}"><span class="fa fa-edit"></span></a>
                                            @endcan
                                            @can('RightWork-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['hrm.right_works.destroy', $data->id],'style'=>'display:inline']) !!}
                                                   
                                                    <button type="submit" class="btn btn-danger"> <span class="fa fa-trash"></span></button>
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @empty
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
<script>
      function downloadTwo(){
     //jquery selection can be achieve via vanilla JS
     let dateVal = $("[name='date']").val();
     @foreach ($datas as $data)
        window.open("{{URL::to('emp_excel/'.$data->id)}}?data=purcache&date="+dateVal,"_blank");
        window.open("{{URL::to('emp_excel/'.$data->id)}}?data=checklist&date="+dateVal,"_blank");
    @endforeach

    return false;
}
</script>
@endsection