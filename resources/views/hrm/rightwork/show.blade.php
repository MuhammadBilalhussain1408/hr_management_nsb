@extends('layouts.app-datatables')
@section('content')
<div class="page-content">
    <div class="container-flu">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{('/home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">rightWork profile </li>
                        </ol>
                    </div>
                </div>
            </div>
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
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
        </div><!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-md-12 col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12"> <img src="{{asset('/assets/images/UK HR CLOUD.png')}}" alt="" class="img-flu" wth="200">
                                <div style="position: fixed;   opacity: 0.5;   /* Safari */  -webkit-transform: rotate(-20deg); /* Firefox */  -moz-transform: rotate(-20deg);   /* IE */   /* Opera */ /* Internet Explorer */ filter: prog:DXImageTransform.Microsoft.BasicImage(rotation=3);  position: absolute; margin-top: 20px; margin-left: 585px; white-space: nowrap;color:#292e6a1c !important;">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center"> Right to Work Checklist (RTW)</h4>
                                <h5 class="text-center">{{$org->company_name}} </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div style="position: fixed;   opacity: 0.2;   /* Safari */  -webkit-transform: rotate(-60deg); /* Firefox */  -moz-transform: rotate(-60deg);   /* IE */   /* Opera */ /* Internet Explorer */ filter: prog:DXImageTransform.Microsoft.BasicImage(rotation=3);  position: absolute; font-size: 74px; margin-top: 92px; margin-left: 200px; white-space: nowrap;color:#292e6a1c !important;">
                                    UK HR CLOUD!
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th>Name of person:</th>
                                                <th> @forelse($rightWork->employees as $emp) {{ $emp->fname }} {{ $emp->mid_name }} {{ $emp->lname }} @empty @endforelse </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> Work start date: </td>
                                                <td>{{$rightWork->start_date}}</td>
                                            </tr>
                                            <tr>
                                                <td> Date & Time of Check: </td>
                                                <td>{{$rightWork->start_date}}</td>
                                            </tr>
                                            <tr>
                                                <td> Type of check:</td>
                                                <td>
                                                    @forelse ($rightWork->checktypes as $chk)
                                                    {{$chk->name}} - {{$chk->short_des}}
                                                    @empty
                                                    @endforelse
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Medium of check: </td>
                                                <td>
                                                    @forelse ($rightWork->checkmidias as $media)
                                                    {{$media->name}}
                                                    @empty
                                                    @endforelse
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Evidence Presented: </td>
                                                <td>{{$rightWork->evidence}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Step 1 for physical check</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    You must obtain original documents from either List A or List B of acceptable documents for manual right to work check </td>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th class="text-center">List A</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($datas['plists'] as $key => $list)
                                            <tr>
                                                <td>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            @if($rightWork->plists)
                                                            @if($rightWork->plists[0]['id'] == $list->id)
                                                            <input type="checkbox" class="form-check-input disabled_check" id="physicallist_id" name="physicallist_id[]" value="{{$list->id}}" checked disabled>
                                                            @else
                                                            <input type="checkbox" class="form-check-input" id="physicallist_id" name="physicallist_id[]" value="{{$list->id}}" disabled>
                                                            @endif
                                                            @endif
                                                            {{$list->name}}
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th class="text-center">List B Group 1</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($datas['plist1g'] as $key => $l1g)
                                            <tr>
                                                <td>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            @if($rightWork->plist1g->count() > 0)
                                                            @if($datas['plist1'][0]['id'] == $l1g->id)
                                                            <input type="checkbox" class="form-check-input disabled_check" id="physicallist_id" name="physicallist_id[]" value="{{$l1g->id}}" checked>
                                                            @else
                                                            <input type="checkbox" class="form-check-input" id="physicallist_id" name="physicallist_id[]" value="{{$l1g->id}}" disabled>
                                                            @endif
                                                            @else
                                                            <input type="checkbox" class="form-check-input" id="physicallist_id" name="physicallist_id[]" value="{{$l1g->id}}" disabled>
                                                           
                                                            @endif
                                                            {{$l1g->name}}
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th class="text-center">List B Group 2</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($datas['plist2g'] as $key => $l2g)
                                            <tr>
                                                <td>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            @if($rightWork->plist2g->count() > 0)
                                                            @if($datas['plist2'][0]['id'] == $l2g->id)
                                                            <input type="checkbox" class="form-check-input disabled_check" id="physicallist_id" name="physicallist_id[]" value="{{$l2g->id}}" disabled checked>
                                                            @else
                                                            <input type="checkbox" class="form-check-input disabled_check" id="physicallist_id" name="physicallist_id[]" value="{{$l2g->id}}" disabled checked>
                                                            @endif
                                                            @else
                                                            <input type="checkbox" class="form-check-input" id="physicallist_id" name="physicallist_id[]" value="{{$l2g->id}}" disabled>
                                                            @endif

                                                            {{$l2g->name}}
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Step 2 Check</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    You must check that the documents are genuine and that the person presenting them is the prospective employee or employee, the rightful holder and allowed to do the type of work you are offering.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    1. Are photographs consistent across documents and with the person’s appearance?
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-radio-label">
                                                            @if($rightWork->check_photo == 'Yes')
                                                            <input class="form-radio-input disabled_check" type="radio" name="check_photo" value="Yes" checked="" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="check_photo" value="Yes" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">Yes</span>
                                                        </label>
                                                        <label class="form-radio-label">
                                                            @if($rightWork->check_photo == 'No')
                                                            <input class="form-radio-input disabled_check" type="radio" name="check_photo" value="No" checked="" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="check_photo" value="No" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">No</span>
                                                        </label>
                                                        <label class="form-radio-label">
                                                            @if($rightWork->check_photo == 'N/A')
                                                            <input class="form-radio-input disabled_check" type="radio" name="check_photo" value="N/A" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="check_photo" value="N/A" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">N/A</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2. Are dates of birth consistent across documents and with the person’s appearance?
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-radio-label">
                                                            @if($rightWork->check_dob == 'Yes')
                                                            <input class="form-radio-input disabled_check" type="radio" name="check_dob" value="Yes" checked="" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="check_dob" value="Yes" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">Yes</span>
                                                        </label>
                                                        <label class="form-radio-label">
                                                            @if($rightWork->check_dob == 'No')
                                                            <input class="form-radio-input disabled_check" type="radio" name="check_dob" value="No" checked="" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="check_dob" value="No" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">No</span>
                                                        </label>
                                                        <label class="form-radio-label">
                                                            @if($rightWork->check_dob == 'N/A')
                                                            <input class="form-radio-input disabled_check" type="radio" name="check_dob" value="N/A" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="check_dob" value="N/A" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">N/A</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3. Are expiry dates for time-limited permission to be in the UK in the future i.e. they have not passed (if applicable)?
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-radio-label">
                                                            @if($rightWork->expiry_time_limit == 'Yes')
                                                            <input class="form-radio-input disabled_check" type="radio" name="expiry_time_limit" value="Yes" checked="" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="expiry_time_limit" value="Yes" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">Yes</span>
                                                        </label>
                                                        <label class="form-radio-label">
                                                            @if($rightWork->expiry_time_limit == 'No')
                                                            <input class="form-radio-input disabled_check" type="radio" name="expiry_time_limit" value="No" checked="" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="expiry_time_limit" value="No" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">No</span>
                                                        </label>
                                                        <label class="form-radio-label">
                                                            @if($rightWork->expiry_time_limit == 'N/A')
                                                            <input class="form-radio-input disabled_check" type="radio" name="expiry_time_limit" value="N/A" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="expiry_time_limit" value="N/A" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">N/A</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    4. Have you checked work restrictions to determine if the person is able to work for you and do the type of work you are offering? (for students who have limited permission to work during term-times, you must also obtain, copy and retain details of their academic term and vacation times covering the duration of their period of study in the UK for which they will be employed)
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-radio-label">
                                                            @if($rightWork->restriction == 'Yes')
                                                            <input class="form-radio-input disabled_check" type="radio" name="restriction" value="Yes" checked="" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="restriction" value="Yes" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">Yes</span>
                                                        </label>
                                                        <label class="form-radio-label">
                                                            @if($rightWork->restriction == 'No')
                                                            <input class="form-radio-input disabled_check" type="radio" name="restriction" value="No" checked="" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="restriction" value="No" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">No</span>
                                                        </label>
                                                        <label class="form-radio-label">
                                                            @if($rightWork->restriction == 'N/A')
                                                            <input class="form-radio-input disabled_check" type="radio" name="restriction" value="N/A" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="restriction" value="N/A" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">N/A</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    5. Are you satisfied the document is genuine, has not been tampered with and belongs to the holder?
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-radio-label">
                                                            @if($rightWork->doc_genuine == 'Yes')
                                                            <input class="form-radio-input disabled_check" type="radio" name="doc_genuine" value="Yes" checked="" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="doc_genuine" value="Yes" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">Yes</span>
                                                        </label>
                                                        <label class="form-radio-label">
                                                            @if($rightWork->doc_genuine == 'No')
                                                            <input class="form-radio-input disabled_check" type="radio" name="doc_genuine" value="No" checked="" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="doc_genuine" value="No" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">No</span>
                                                        </label>
                                                        <label class="form-radio-label">
                                                            @if($rightWork->doc_genuine == 'N/A')
                                                            <input class="form-radio-input disabled_check" type="radio" name="doc_genuine" value="N/A" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="doc_genuine" value="N/A" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">N/A</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    6. Have you checked the reasons for any different names across documents (e.g. marriage certificate, divorce decree, deed poll)? (Supporting documents should also be photocopied and a copy retained.)
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-radio-label">
                                                            @if($rightWork->other_doc == 'Yes')
                                                            <input class="form-radio-input disabled_check" type="radio" name="other_doc" value="Yes" checked="" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="other_doc" value="Yes" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">Yes</span>
                                                        </label>
                                                        <label class="form-radio-label">
                                                            @if($rightWork->other_doc == 'No')
                                                            <input class="form-radio-input disabled_check" type="radio" name="other_doc" value="No" checked="" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="other_doc" value="No" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">No</span>
                                                        </label>
                                                        <label class="form-radio-label">
                                                            @if($rightWork->other_doc == 'N/A')
                                                            <input class="form-radio-input disabled_check" type="radio" name="other_doc" value="N/A" disabled>
                                                            @else
                                                            <input class="form-radio-input" type="radio" name="other_doc" value="N/A" disabled>
                                                            @endif
                                                            <span class="form-radio-sign">N/A</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Step 3 Copy</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($datas['passports'] as $key => $pass)
                                            <tr>
                                                <td>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            @forelse($rightWork->passports as $ps2)
                                                            @if($ps2->id == $pass->id)
                                                            <input type="checkbox" class="form-check-input disabled_check" id="physicallist_id" name="physicallist_id[]" value="{{$l2g->id}}" disabled checked>
                                                            @else
                                                            <input type="checkbox" class="form-check-input" id="physicallist_id" name="physicallist_id[]" value="{{$l2g->id}}" disabled>
                                                            @endif
                                                            @empty
                                                            <input type="checkbox" class="form-check-input" id="physicallist_id" name="physicallist_id[]" value="{{$l2g->id}}" disabled>
                                                            @endforelse
                                                            {{$pass->name}}
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Type of RTW evidence</th>
                                                <th class="text-center">Right to work permission validity</th>
                                                <th class="text-center">Follow up RTW check requirement</th>
                                                <th class="text-center">Date followup required</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>List A </td>
                                                <td> {{$rightWork->list_right}} </td>
                                                <td> {{$rightWork->list_right_follow}} </td>
                                                <td> {{$rightWork->list_right_date}} </td>
                                            </tr>
                                            <tr>
                                                <td>List B: (Group 1) </td>
                                                <td> {{$rightWork->list_group1}} </td>
                                                <td> {{$rightWork->list_group1_follow}} </td>
                                                <td> {{$rightWork->list_group1_date}} </td>
                                            </tr>
                                            <tr>
                                                <td>Tier 4 Student Visa term and holiday date evidence </td>
                                                <td> {{$rightWork->list_tier4s}} </td>
                                                <td> {{$rightWork->list_tier4s_follow}} </td>
                                                <td> {{$rightWork->list_tier4s_date}} </td>
                                            </tr>
                                            <tr>
                                                <td>List B: (Group 2) </td>
                                                <td> {{$rightWork->list_group2}} </td>
                                                <td> {{$rightWork->list_group2_follow}} </td>
                                                <td> {{$rightWork->list_group2_date}} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th class="text-center">RTW Evidence Scans-1</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="scan-body" style="background: #edecec;">
                                                        <embed name="imgeid" id="imgeid" width="50%" src="{{asset('/upload/image/'.$datas['employee']['passport_proof'])}}">

                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered mt-3">
                                        <tbody>
                                            <tr>
                                                <td> RTW check result </td>
                                                <td>{{$rightWork->result}} </td>
                                                <td> Remarks </td>
                                            </tr>
                                            <tr>
                                                <td> Checker's Name </td>
                                                <td> {{$rightWork->check_name}} </td>
                                                <td>Contact No. </td>
                                                <td> {{$rightWork->check_phone}} </td>
                                            </tr>
                                            <tr>
                                                <td>Designation </td>
                                                <td> {{$rightWork->check_designation}} </td>
                                                <td> Email Address </td>
                                                <td> {{$rightWork->check_email}} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="btn-toolbar sw-toolbar sw-toolbar-bottom justify-content-end">
                            <div class="btn-group mr-2 sw-btn-group d-print-none" role="group">
                                <a href="javascript:window.print()" class="btn btn-info text-light"><i class="fa fa-print"></i></a>

                                <a href="{{URL::to('/rightWorks')}}" class="btn btn-dark text-light">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div><!-- end page content -->
    @endsection