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
                            <li class="breadcrumb-item active">Employee profile </li>
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
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="datatable-buttons" data-order='[[ 0, "asc" ]]' data-page-length='150' class="table table-striped table-bordered w-100">
                                        <thead>
                                            <tr>
                                                <th>Serial NO</th>
                                                <th>Type</th>
                                                <th>Particulars</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td>Employee Code</td>
                                                <td>{{$employee->id}}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Employee Name</td>
                                                <td> {{$employee->fname}} {{$employee->mid_name}} {{$employee->lname}}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Employee Code</td>
                                                <td>{{$employee->id}}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Gender</td>
                                                <td>{{$employee->gender}}</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>NI Number</td>
                                                <td>{{$employee->ni_no}}</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Date of Birth</td>
                                                <td>{{$employee->dob}}</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Marital Status</td>
                                                <td>{{$employee->marital_status}}</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Nationality</td>
                                                <td>{{$employee->nationality}}</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Email</td>
                                                <td>{{$employee->email}}</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Contact Number</td>
                                                <td>{{$employee->con_number }}</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>Alternative Contact</td>
                                                <td>{{$employee->al_contact}}</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Department </td>
                                                <td> {{$employee->department->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>13</td>
                                                <td>Designation</td>
                                                <td>{{$employee->designation->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>14</td>
                                                <td>Date of Joining</td>
                                                <td>{{$employee->join_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>15</td>
                                                <td>Employment Type</td>
                                                <td>@if(!empty($employee->emp_type)) {{$employee->emp_type->name}}@endif</td>
                                            </tr>
                                            <tr>
                                                <td>16</td>
                                                <td>Date of Confirmation</td>
                                                <td>{{$employee->date_confirm}}</td>
                                            </tr>
                                            <tr>
                                                <td>17</td>
                                                <td>Contract start date</td>
                                                <td> {{$employee->start_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>18</td>
                                                <td>Contract end date</td>
                                                <td>{{$employee->end_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>19</td>
                                                <td>Job Location</td>
                                                <td>{{$employee->job_location}}</td>
                                            </tr>
                                            <tr>
                                                <td>20</td>
                                                <td>Job Title</td>
                                                <td>@if(@empty($employee->emp_jobs)){{$employee->emp_jobs->title}}@endif</td>
                                            </tr>
                                            <tr>
                                                <td>21</td>
                                                <td>Start Date</td>
                                                <td>@if(@empty($employee->emp_jobs)){{$employee->emp_jobs->start_date}}@endif</td>
                                            </tr>
                                            <tr>
                                                <td>22</td>
                                                <td>End date</td>
                                                <td> @if(@empty($employee->emp_jobs)){{$employee->emp_jobs->end_date}}@endif</td>
                                            </tr>
                                            <tr>
                                                <td>23</td>
                                                <td>Year of Experience</td>
                                                <td>@if(@empty($employee->emp_jobs)){{$employee->emp_jobs->year_exp}}@endif</td>
                                            </tr>
                                            <tr>
                                                <td>24</td>
                                                <td>Year of experience</td>
                                                <td>@if(@empty($employee->emp_jobs)){{$employee->emp_jobs->passing_year}}@endif</td>
                                            </tr>
                                            <tr>
                                                <td>25</td>
                                                <td>Job Description</td>
                                                <td>@if(@empty($employee->emp_jobs)){{$employee->emp_jobs->description}}@endif</td>
                                            </tr>
                                            @if($employee->emp_econ)
                                            <tr>
                                                <td>26</td>
                                                <td>Next of Kin Contact Name</td>
                                                <td>{{$employee->emp_econ->emg_name}}</td>
                                            </tr>
                                            <tr>
                                                <td>27</td>
                                                <td>Next of Kin Contact Relationship</td>
                                                <td>{{$employee->emp_econ->relation}}</td>
                                            </tr>
                                            <tr>
                                                <td>28</td>
                                                <td>Next of Kin Contact Email</td>
                                                <td>{{$employee->emp_econ->emg_email}}</td>
                                            </tr>
                                            <tr>
                                                <td>29</td>
                                                <td>Next of Kin Contact Number</td>
                                                <td>{{$employee->emp_econ->emg_phone}}</td>
                                            </tr>
                                            <tr>
                                                <td>30</td>
                                                <td>Next of Kin Contact Address</td>
                                                <td>{{$employee->emp_econ->emg_address}}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td>31</td>
                                                <td>COS Number</td>
                                                <td>{{$employee->id}}</td>
                                            </tr>
                                            <tr>
                                                <td>32</td>
                                                <td>COS Number start date</td>
                                                <td>{{$employee->id}}</td>
                                            </tr>
                                            <tr>
                                                <td>33</td>
                                                <td>COS Number End date</td>
                                                <td>{{$employee->id}}</td>
                                            </tr>
                                            <tr>
                                                <td>34</td>
                                                <td>Present Address</td>
                                                <td>@if(!empty($employee->emp_coninfo)){{$employee->emp_coninfo->street_address}}@endif</td>
                                            </tr>
                                            <tr>
                                                <td>34</td>
                                                <td>Proof Of Present Address </td>
                                                <td>@if(!empty($employee->emp_coninfo))<a href="{{URL::to('storage/upload/'.$employee->emp_coninfo->add_proof)}}" download>{{$employee->emp_coninfo->add_proof}}</a>@endif</td>
                                            </tr>

                                            <tr>
                                                <td>35</td>
                                                <td>Passport No</td>
                                                <td>{{$employee->passport_no}}</td>
                                            </tr>
                                            <tr>
                                                <td>36</td>
                                                <td>Nationality</td>
                                                <td>{{$employee->nationality }}</td>
                                            </tr>
                                            <tr>
                                                <td>37</td>
                                                <td>Place of Birth</td>
                                                <td>{{$employee->bith_place}}</td>
                                            </tr>
                                            <tr>
                                                <td>38</td>
                                                <td>Passport Issued Date</td>
                                                <td>{{$employee->issued_by}}</td>
                                            </tr>
                                            <tr>
                                                <td>39</td>
                                                <td>Passport Expiry Date</td>
                                                <td>{{$employee->expiry_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>40</td>
                                                <td>Passport Eligible Review Date </td>
                                                <td>{{$employee->eligible_for}}</td>
                                            </tr>
                                            <tr>
                                                <td>41</td>
                                                <td>Passport Document</td>
                                                <td><a href="{{URL::to('storage/upload/'.$employee->emp_coninfo->add_proof)}}" download>{{$employee->add_proof}}</a></td>
                                            </tr>
                                            <tr>
                                                <td>42</td>
                                                <td>Is this your current passport? </td>
                                                <td>{{$employee->crn_passport}}</td>
                                            </tr>
                                            <tr>
                                                <td>43</td>
                                                <td>3 Passport Remarks </td>
                                                <td>{{$employee->passport_remarks}}</td>
                                            </tr>

                                            <tr>
                                                <td>44</td>
                                                <td>BRP/Visa Number</td>
                                                <td>{{$employee->visa_no}}</td>
                                            </tr>
                                            <tr>
                                                <td>45</td>
                                                <td>Nationality</td>
                                                <td>{{$employee->visa_nation }}</td>
                                            </tr>
                                            <tr>
                                                <td>46</td>
                                                <td>Country of Residence </td>
                                                <td>{{$employee->visa_resi}}</td>
                                            </tr>
                                            <tr>
                                                <td>47</td>
                                                <td>Visa Issued By</td>
                                                <td>{{$employee->v_issued_by}}</td>
                                            </tr>
                                            <tr>
                                                <td>48</td>
                                                <td>8 Visa Issued Date</td>
                                                <td>{{$employee->v_issued_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>49</td>
                                                <td>Visa Expiry Date </td>
                                                <td>{{$employee-> v_expiry_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>50</td>
                                                <td>Visa Eligible Review Date </td>
                                                <td>{{$employee->v_eligible_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>51</td>
                                                <td>Visa Document</td>
                                                <td>
                                                    @if($employee->vf_proof)
                                                    <a href="{{URL::to('storage/upload/'.$employee->vf_proof)}}" download>{{$employee->vf_proof}}</a>
                                                    @else
                                                    Not Uploaded
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>52</td>
                                                <td> Visa Proof </td>
                                                <td>{{$employee->vb_proof}}</td>
                                            </tr>
                                            <tr>
                                                <td>53</td>
                                                <td> Current Visa </td>
                                                <td>{{$employee->crn_visa}}</td>
                                            </tr>
                                            <tr>
                                                <td>54</td>
                                                <td> Visa Remarks </td>
                                                <td>{{$employee->visa_remarks}}</td>
                                            </tr>


                                            <tr>
                                                <td>55</td>
                                                <td> EUSS/Time limit Ref. No.</td>
                                                <td>{{$employee->euss_no}}</td>
                                            </tr>
                                            <tr>
                                                <td>56</td>
                                                <td>EUSS/Time limit Nationality</td>
                                                <td>{{$employee->euss_nation }}</td>
                                            </tr>
                                            <tr>
                                                <td>57</td>
                                                <td>EUSS/Time limit Issued BY</td>
                                                <td>{{$employee->e_issued_by}}</td>
                                            </tr>
                                            <tr>
                                                <td>58</td>
                                                <td>EUSS/Time limit Issued Date</td>
                                                <td>{{$employee->e_issued_date }}</td>
                                            </tr>
                                            <tr>
                                                <td>59</td>
                                                <td>EUSS/Time limit Expiry Date</td>
                                                <td>{{$employee->expiry_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>60</td>
                                                <td>EUSS/Time Eligible Review Date </td>
                                                <td>{{$employee->e_eligible_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>61</td>
                                                <td>EUSS/Time Document</td>
                                                <td><a href="{{URL::to('storage/upload/'.$employee->euss_proof)}}" download>{{$employee->euss_proof}}</a></td>
                                            </tr>
                                            <tr>
                                                <td>62</td>
                                                <td>Is this your current status? </td>
                                                <td>{{$employee->crn_status}}</td>
                                            </tr>
                                            <tr>
                                                <td>63</td>
                                                <td> EUSS/Time Remarks </td>
                                                <td>{{$employee->euss_remarks}}</td>
                                            </tr>

                                            <tr>
                                                <td>64</td>
                                                <td>DBS Type</td>
                                                <td>{{$employee->dbs_type}}</td>
                                            </tr>
                                            <tr>
                                                <td>65</td>
                                                <td>DBS Ref. No.</td>
                                                <td>{{$employee->dbs_no }}</td>
                                            </tr>
                                            <tr>
                                                <td>66</td>
                                                <td>DBS Nationality</td>
                                                <td>{{$employee->dbs_nation}}</td>

                                            </tr>
                                            <tr>
                                                <td>67</td>
                                                <td>DBS Issued By</td>
                                                <td>{{$employee->dbs_issued_by}}</td>
                                            </tr>
                                            <tr>
                                                <td>68</td>
                                                <td>DBS Issued Date</td>
                                                <td>{{$employee->dbs_issued_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>69</td>
                                                <td>DBS Expiry Date</td>
                                                <td>{{$employee->dbs_expiry_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>70</td>
                                                <td>DBS Eligible Review Date </td>
                                                <td>{{$employee->dbs_eligible_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>71</td>
                                                <td>DBS Document</td>
                                                <td><a href="{{URL::to('storage/upload/'.$employee->dbs_proof)}}" download>{{$employee->dbs_proof}}</a></td>
                                            </tr>
                                            <tr>
                                                <td>72</td>
                                                <td>Is this your current status? </td>
                                                <td>{{$employee->dbs_status}}</td>
                                            </tr>
                                            <tr>
                                                <td>73</td>
                                                <td>3 DBS Remarks </td>
                                                <td>{{$employee->dbs_remarks}}</td>
                                            </tr>

                                            @if(!empty($employee->emp_nid))
                                            <tr>
                                                <td>74</td>
                                                <td>National Id No</td>
                                                <td>{{$employee->emp_nid->nid}}</td>
                                            </tr>
                                            <tr>
                                                <td>75</td>
                                                <td>National Id Nationality</td>
                                                <td>{{$employee->emp_nid->nid_nation }}</td>
                                            </tr>
                                            <tr>
                                                <td>76</td>
                                                <td>National Id Country of Residence</td>
                                                <td>{{$employee->emp_nid->nid_resi}}</td>
                                            </tr>
                                            <tr>
                                                <td>77</td>
                                                <td>National Id Issued Date</td>
                                                <td>{{$employee->emp_nid->nid_issued_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>78</td>
                                                <td>National Id Expiry Date</td>
                                                <td>{{$employee->emp_nid->nid_expiry_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>79</td>
                                                <td>National Id Eligible Review Date </td>
                                                <td>{{$employee->emp_nid->nid_eligible_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>80</td>
                                                <td>National Id Document</td>
                                                <td><a href="{{URL::to('storage/upload/'.$employee->emp_nid->nid_proof)}}" download>{{$employee->emp_nid->nid_proof}}</a></td>
                                            </tr>
                                            <tr>
                                                <td>81</td>
                                                <td>Is this your current National Id? </td>
                                                <td>{{$employee->emp_nid->nid_status}}</td>
                                            </tr>
                                            <tr>
                                                <td>82</td>
                                                <td> National Id Remarks </td>
                                                <td>{{$employee->emp_nid->nid_remarks}}</td>
                                            </tr>
                                            @endif
                                            @if(!empty($employee->emp_pay))
                                            <tr>
                                                <td>83</td>
                                                <td>Bank Name</td>
                                                <td>{{$employee->emp_pay->emp_bank_name}}</td>
                                            </tr>
                                            <tr>
                                                <td>84</td>
                                                <td>Branch Name</td>
                                                <td>{{$employee->emp_pay->bank_branch_id }}</td>
                                            </tr>
                                            <tr>
                                                <td>85</td>
                                                <td>short code</td>
                                                <td>{{$employee->emp_pay->emp_sort_code }}</td>
                                            </tr>
                                            <tr>
                                                <td>86</td>
                                                <td>Account Number</td>
                                                <td>{{$employee->emp_pay->emp_account_no}}</td>
                                            </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div><!-- end page content -->

    @endsection