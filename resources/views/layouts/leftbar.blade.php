<!-- Left Sidenav -->
@inject('request', 'Illuminate\Http\Request')
<div class="left-sidenav">
    <ul class="metismenu left-sidenav-menu" id="side-nav">

        @can('dashboard')
        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}"><a href="{{URL::to('/hrm/home')}}"><i class="mdi mdi-speedometer"></i><span>Dashboards</span></a></li>
        @endcan

        @can('Authentication')
        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Authentication</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level" aria-expanded="false">

                @can('role-list')
                <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}"><a href="{{ route('hrm.roles.index') }}">Roles </a></li>
                @endcan
                @can('user-list')
                <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}"><a href="{{ route('hrm.users.index') }}">Users </a></li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('organization-list')
        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Organization</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(2) == 'organizations' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.organizations.index') }}"> Organization Profile </a>
                </li>
                @can('employee-list')
                <li class="{{ $request->segment(2) == 'employees' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.employees.index') }}"> Employee Creation Link </a>
                </li>
                @endcan
                @can('checklist-list')
                <li class="{{ $request->segment(2) == 'checklists' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.checklists.index') }}"> Checklists </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('setting-list')
        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Settings</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>

            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(2) == 'payment_types' ? 'active' : '' }} ">
                    <a href="#appInvoice" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> HCM
                        Master <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg> </a>
                    <ul class="collapse list-unstyled sub-submenu {{ $request->segment(1) == 'payment_types' ? 'show' : '' }}" id="appInvoice" data-parent="#app">
                        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                            <a href="{{route('hrm.departments.index')}}"> Department </a>
                        </li>
                        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                            <a href="{{ route('hrm.designations.index') }}"> Designation </a>
                        </li>
                        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                            <a href="{{ route('hrm.employee_types.index') }}"> Employment Type </a>
                        </li>
                        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                            <a href="{{ route('hrm.paygroups.index') }}"> Pay Group </a>
                        </li>
                        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                            <a href="{{ route('hrm.annual_pays.index') }}">Annual Pay</a>
                        </li>
                        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                            <a href="{{ route('hrm.banks.index') }}"> Bank Master </a>
                        </li>
                        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                            <a href="{{ route('hrm.bankcodes.index') }}"> Bank Shortcode </a>
                        </li>
                        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                            <a href="{{ route('hrm.taxes.index') }}"> Tax Master </a>
                        </li>
                        <li class="{{ $request->segment(3) == 'payment_types' ? 'active' : '' }} ">
                            <a href="{{ route('hrm.payment_types.index') }}"> Payment Type </a>
                        </li>
                        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                            <a href="{{ route('hrm.wedges_pay_modes.index') }}"> Wedges Pay Mode </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                    <a href="#"> Payrole </a>
                    <ul class="collapse list-unstyled sub-submenu" id="appInvoice" data-parent="#app">
                        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                            <a href="#"> Pay Item </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        @endcan
        @can('requitment-list')

        <li class="{{ $request->segment(1) == 'requitment' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Requitment</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>

            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(1) == 'jobs' ? 'active' : '' }}">
                    <a href="{{route('hrm.jobs.index')}}"> Job List </a>
                </li>
                <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                    <a href="{{route('hrm.job_posts.index')}}"> Job Posting </a>
                </li>
                <li class="{{ $request->segment(1) == 'job_publisheds' ? 'active' : '' }}">
                    <a href="{{route('hrm.job_publisheds.index')}}"> Job Published </a>
                </li>
                <li class="{{ $request->segment(1) == 'job_applieds' ? 'active' : '' }}">
                    <a href="{{route('hrm.job_applieds.index')}}"> Job Applied </a>
                </li>
                <li class="{{ $request->segment(1) == 'job_shortlist' ? 'active' : '' }}">
                    <a href="{{route('hrm.job_shortlist')}}">Short Listing</a>
                </li>
                <li class="{{ $request->segment(1) == 'interviews' ? 'active' : '' }}">
                    <a href="{{route('hrm.interview')}}"> Interview </a>
                </li>
                <li class="{{ $request->segment(1) == 'hired' ? 'active' : '' }}">
                    <a href="{{route('hrm.hired')}}"> Hired </a>
                </li>
                <li class="{{ $request->segment(1) == 'offer_letter' ? 'active' : '' }}">
                    <a href="{{route('hrm.offer_letter')}}"> Generate Offer Letter </a>
                </li>
                <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                    <a href="{{route('hrm.job_applieds.index')}}"> Search </a>
                </li>
                <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                    <a href="{{route('hrm.job_applieds.index')}}"> Status Search </a>
                </li>
                <li class="{{ $request->segment(1) == 'rejectted' ? 'active' : '' }}">
                    <a href="{{route('hrm.rejectted')}}"> Rejectted </a>
                </li>
                <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                    <a href="{{route('hrm.message_centers.index')}}"> Massage Center </a>
                </li>
            </ul>
        </li>
        @endcan
        @can('mockinterview-list')
        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Mock Interview</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>

            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                    <a href="#"> Interview Forms </a>
                </li>
                <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                    <a href="#"> Interviews </a>
                </li>
                <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                    <a href="#"> Capstone Assessment Report </a>
                </li>
                <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
                    <a href="#"> Cognitive Ability Assessment Report </a>
                </li>
            </ul>
        </li>
        @endcan
        @can('employee-list')
        <li class="{{ $request->segment(1) == 'employees.index' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Employees</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>

            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(1) == 'employees' ? 'active' : '' }}">
                    <a href="{{route('hrm.employees.index')}}"> Employees </a>
                </li>
                @can('cercumastances')
                <li class="{{ $request->segment(1) == 'cercumastances' ? 'active' : '' }}">
                    <a href="{{route('hrm.cercumastances')}}"> Change Of Circumstances view </a>
                </li>
                @endcan
                @can('contract_agreement')
                <li class="{{ $request->segment(1) == 'contract_agreement' ? 'active' : '' }}">
                    <a href="{{route('hrm.employees.contract_agreement')}}"> Contract Agreement </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('holiday-list')
        <li class="{{ $request->segment(1) == 'holiday_types' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Holiday Management</span>
                <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
            </a>

            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(1) == 'holiday_types' ? 'active' : '' }}">
                    <a href="{{route('hrm.holiday_types.index')}}"> Holiday Type </a>
                </li>
                <li class="{{ $request->segment(1) == 'holidays' ? 'active' : '' }}">
                    <a href="{{route('hrm.holidays.index')}}"> Holiday list </a>
                </li>
                <li class="{{ $request->segment(1) == 'holidays' ? 'active' : '' }}">
                    <a href="https://www.gov.uk/calculate-your-holiday-entitlement" target="_blank"> Pro Rata Holiday(Calculator) </a>
                </li>
            </ul>
        </li>
        @endcan
        @can('leave-list')
        <li class="{{ $request->segment(1) == 'leave_types' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Leave Management</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(1) == 'leave_types' ? 'active' : '' }}">
                    <a href="{{route('hrm.leave_types.index')}}"> Leave Type </a>
                </li>
                <li class="{{ $request->segment(1) == 'leave_rules' ? 'active' : '' }}">
                    <a href="{{route('hrm.leave_rules.index')}}"> Leave Rule </a>
                </li>
                <li class="{{ $request->segment(1) == 'leave_allocations' ? 'active' : '' }}">
                    <a href="{{route('hrm.leave_allocations.index')}}"> Leave Allocation </a>
                </li>
                <li class="{{ $request->segment(1) == 'leave_balance.index' ? 'active' : '' }}">
                    <a href="{{route('hrm.leave_balance.index')}}"> Leave Balance </a>
                </li>
                <li class="{{ $request->segment(1) == 'leave_report.index' ? 'active' : '' }}">
                    <a href="{{route('hrm.leave_report.index')}}"> Leave Report </a>
                </li>
                <li class="{{ $request->segment(1) == 'leave_report.employee' ? 'active' : '' }}">
                    <a href="{{route('hrm.leave_report.employee')}}"> Employee Wise report </a>
                </li>

            </ul>
        </li>
        @endcan
        @can('rota-list')
        <li class="{{ $request->segment(1) == 'shifts' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Rota( Time Shift)</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(1) == 'shifts' ? 'active' : '' }}">
                    <a href="{{route('hrm.shifts.index')}}"> Shift Manage </a>
                </li>
                <li class="{{ $request->segment(1) == 'late_policies' ? 'active' : '' }}">
                    <a href="{{route('hrm.late_policies.index')}}"> late policies </a>
                </li>
                <li class="{{ $request->segment(1) == 'dayoffs' ? 'active' : '' }}">
                    <a href="{{route('hrm.dayoffs.index')}}"> Day off </a>
                </li>
                <li class="{{ $request->segment(1) == 'grace_periods' ? 'active' : '' }}">
                    <a href="{{route('hrm.grace_periods.index')}}"> Grace piriod </a>
                </li>
                <li class="{{ $request->segment(1) == 'duty_rosters' ? 'active' : '' }}">
                    <a href="{{route('hrm.duty_rosters.index')}}"> Duty roster </a>
                </li>
                <li class="{{ $request->segment(1) == 'visitor' ? 'active' : '' }}">
                    <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Visitor </span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="{{ $request->segment(1) == 'visitor_register' ? 'active' : '' }}">
                            <a href="#"> Visitor register link </a>
                        </li>
                        <li class="{{ $request->segment(1) == 'visitor_register' ? 'active' : '' }}">
                            <a href="#"> Visitor list </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        @endcan
        @can('attendance-list')
        <li class="{{ $request->segment(1) == 'job_posts' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Attendance</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level" aria-expanded="false">
            @can('attendance-csv-upload')
                <li class="{{ $request->segment(1) == 'attendance_file_upload' ? 'active' : '' }}">
                    <a href="{{route('hrm.attendance_file_upload')}}"> Attendance upload csv </a>
                </li>
                @endcan
                @can('attendance-create')
                <li class="{{ $request->segment(1) == 'attendances.create' ? 'active' : '' }}">
                    <a href="{{route('hrm.attendances.create')}}">Add Attendance </a>
                </li>
                @endcan
                @can('attendance-list')
                <li class="{{ $request->segment(1) == 'attendances.daily' ? 'active' : '' }}">
                    <a href="{{ route('hrm.attendances.daily') }}">Daily Attendance </a>
                </li>
                @endcan
                @can('attendance-report')
                <li class="{{ $request->segment(1) == 'attendances.daily' ? 'active' : '' }}">
                    <a href="{{route('hrm.attendances.index')}}"> Attendance History </a>
                </li>
                @endcan
                @can('attendance-report')
                <li class="{{ $request->segment(1) == 'attendances.process' ? 'active' : '' }}">
                    <a href="{{route('hrm.attendance.process')}}"> Attendance Process </a>
                </li>
                @endcan
                @can('attendance-report')
                <li class="{{ $request->segment(1) == 'attendances.report' ? 'active' : '' }}">
                    <a href="{{route('hrm.attendance.report')}}"> Absent Report </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('organogram-list')

        <li class="{{ $request->segment(1) == 'organogram' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Organogram Charts</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>

            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(1) == 'label' ? 'active' : '' }}">
                    <a href="#"> Label </a>
                </li>
                <li class="{{ $request->segment(1) == ' organisation-hierarchy' ? 'active' : '' }}">
                    <a href="#">  Organisation Hierarchy </a>
                </li>
             
            </ul>
        </li>
        @endcan
        @can('leave-approval-list')

        <li class="{{ $request->segment(1) == 'leave_request_approver' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Leave Approval</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>

            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(1) == 'leave_request_approver' ? 'active' : '' }}">
                    <a href="{{route('hrm.leave_request_approver')}}"> Leave Request list </a>
                </li>
            </ul>
        </li>
        @endcan
        @can('payroll-list')
        <li class="{{ $request->segment(1) == 'payroll' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Payroll</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>

            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(1) == 'payroll' ? 'active' : '' }}">
                    <a href="#"> Blank Page </a>
                </li>
            </ul>
        </li>
        @endcan
        @can('bill-list')
        <li class="{{ $request->segment(1) == 'invoices' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Billing</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>

            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(1) == 'invoices' ? 'active' : '' }}">
                    <a href="{{route('hrm.invoices.index')}}"> Billing </a>
                </li>
            </ul>
        </li>
        @endcan
        @can('document-list')
        <li class="{{ $request->segment(1) == 'organization_doc' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Document</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>

            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(1) == 'organization_doc' ? 'active' : '' }}">
                    <a href="{{route('hrm.organization_doc')}}"> Organization Document </a>
                </li>
                <li class="{{ $request->segment(1) == 'employee_doc' ? 'active' : '' }}">
                    <a href="{{route('hrm.employee_doc')}}"> Employee Document </a>
                </li>
            </ul>
        </li>
        @endcan
        @can('sponsor-list')
        <li class="{{ $request->segment(1) == 'org_view' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Sponsor Compliance</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(2) == 'org_view' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.org_view', Auth::user()->slug) }}"> Organization Profile </a>
                </li>
                <li class="{{ $request->segment(2) == 'employees.index' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.employees.index') }}"> Employee List </a>
                </li>
                <li class="{{ $request->segment(2) == 'hrm.emp_migrant' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.emp_migrant') }}"> Migrant Employee </a>
                </li>
                <li class="{{ $request->segment(2) == 'right_works.index' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.right_works.index') }}">Right to Work check </a>
                </li>
            </ul>
        </li>
        @endcan
        @can('employee-list')
        <li class="{{ $request->segment(1) == 'employees' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Employee Corner</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>

            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(1) == 'employees' ? 'active' : '' }}">
                    <a href="#"> Blank Page </a>
                </li>
            </ul>
        </li>
        @endcan
        @can('task-list')
        <li class="{{ $request->segment(1) == 'tasks' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Task</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="{{ $request->segment(1) == 'tasks' ? 'active' : '' }}">
                    <a href="#"> Blank Page </a>
                </li>
            </ul>
        </li>
        @endcan
        <!-- <span class="text-white">Website content: </span> -->
        @can('website-settings')
        <li class="{{ $request->segment(1) == 'menus','services' ? 'active' : '' }}">
            <a href="javascript: void(0);"><i class="mdi mdi-account-location"></i><span>Website Settings</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
            <li class="{{ $request->segment(2) == 'hrm.services.create' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.services.create') }}"> Service Add </a>
                </li>
                <li class="{{ $request->segment(2) == 'hrm.services.index' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.services.index') }}"> Service List </a>
                </li>
                <li class="{{ $request->segment(2) == 'hrm.menus.create' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.menus.create') }}"> Menu Add </a>
                </li>
                <li class="{{ $request->segment(2) == 'menus' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.menus.index') }}"> Menu List </a>
                </li>
                <li class="{{ $request->segment(2) == 'hrm.submenus.create' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.submenus.create') }}"> SubMenu Add </a>
                </li>
                <li class="{{ $request->segment(2) == 'submenus' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.submenus.index') }}"> SubMenu list </a>
                </li>
                <li class="{{ $request->segment(2) == 'hrm.contents.create' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.contents.create') }}"> Content Add </a>
                </li>
                <li class="{{ $request->segment(2) == 'contents' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.contents.index') }}"> Content List </a>
                </li>
                <li class="{{ $request->segment(2) == 'hrm.galleries.create' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.galleries.create') }}"> Galleries Add </a>
                </li>
                <li class="{{ $request->segment(2) == 'galleries' ? 'active' : '' }} ">
                    <a href="{{ route('hrm.galleries.index') }}"> Galleries list </a>
                </li>
            </ul>
        </li>
        @endcan

    </ul>
</div><!-- end left-sidenav-->