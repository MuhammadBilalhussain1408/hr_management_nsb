<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RightWorkController;
/*Settings*/
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeTypeController;
use App\Http\Controllers\PayGroupController;
use App\Http\Controllers\AnnualPayController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BankCodeController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\WedgesPayModeController;
/* requitment*/
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\JobPublishedController;
use App\Http\Controllers\OfferLetterController;
use App\Http\Controllers\JobAppliedController;
use App\Http\Controllers\MessageCenterController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HolidayTypeController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\LeaveRuleController;
use App\Http\Controllers\LeaveAllocationController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\LatePolicyController;
use App\Http\Controllers\DayOffController;
use App\Http\Controllers\GracePeriodController;
use App\Http\Controllers\DutyRosterController;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubmenuController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\FromController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\InvoiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/key', function(){
    \Artisan::call('storage:link');

});
Route::get('/unzip', [WelcomeController::class, 'index'])->name('index');

Route::get('/', [WelcomeController::class, 'index'])->name('index');
Route::get('/{slug}', [WelcomeController::class, 'page'])->name('page');
Route::get('/service/{slug}', [WelcomeController::class, 'service'])->name('service');
Route::get('/view/{slug}', [WelcomeController::class, 'view'])->name('view');
Route::get('/career/{slug}', [WelcomeController::class, 'career'])->name('career');
Route::get('/career/application/{slug}', [WelcomeController::class, 'application'])->name('application.career');
Route::post('/post_application', [FromController::class, 'post_application'])->name('post_application');
Route::get('/about', [WelcomeController::class, 'about'])->name('about');
//Route::get('/faq', [WelcomeController::class, 'index'])->name('faq');
Route::get('/contact', [WelcomeController::class, 'contact_us'])->name('contact');
Route::post('/conatct_post',[WelcomeController::class, 'conatct_post'])->name('conatct_post');
Route::get('/admin/login', [WelcomeController::class, 'login'])->name('admin.login');
Route::get('/admin/register', [WelcomeController::class, 'register'])->name('admin.register');
Route::get('/404', [WelcomeController::class, 'errors'])->name('404');


Auth::routes();


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/hrm/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth'], 'prefix' => 'hrm', 'as' => 'hrm.'], function () {
// Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('organizations', OrganizationController::class);
    Route::get('/organizations/{empid}', [OrganizationController::class, 'get_org'] )->name('get_org');
    Route::get('/org_view/{slug}', [OrganizationController::class, 'org_view'] )->name('org_view');
    Route::get('/organization_doc', [OrganizationController::class, 'organization_doc'] )->name('organization_doc');
    Route::post('/doc_search', [OrganizationController::class, 'doc_search'] )->name('doc_search');

    Route::resource('checklists', ChecklistController::class);
    Route::resource('employees', EmployeeController::class);
    Route::post( '/emp_update/{employee}', [EmployeeController::class, 'emp_update'] )->name('emp_update');
    Route::get('/employee_doc', [EmployeeController::class, 'employee_doc'] )->name('employee_doc');
    Route::post('/empdoc_search', [EmployeeController::class, 'empdoc_search'] )->name('empdoc_search');
    Route::post('/search/contract_agreement', [EmployeeController::class, 'search_contract_agreement'] )->name('search.contract_agreement');
    Route::get('/contract_agreement', [EmployeeController::class, 'contract_agreement'] )->name('employees.contract_agreement');
    Route::get('/agreement/{employee}', [EmployeeController::class, 'agreement'] )->name('employees.agreement');
    Route::get('/change_cercumastances/{employee}', [EmployeeController::class, 'change_cercumastances'] )->name('employees.change_cercumastances');
    Route::post('/change_cercumastances_emp/{employee}', [EmployeeController::class, 'change_cercumastances_emp'] )->name('change_cercumastances_emp');
    Route::get('/cercumastances', [EmployeeController::class, 'cercumastances'] )->name('cercumastances');
    Route::get('/cercumastances_view{employee}', [EmployeeController::class, 'cercumastances_view'] )->name('view_cercumastances');


    Route::get( '/get_designation/{empid}', [EmployeeController::class, 'get_designation'] )->name('get_designation');
    Route::get( '/emp_excel/{id}', [EmployeeController::class, 'emp_excel'] )->name('emp_excel');
    Route::get( '/emp_migrant', [EmployeeController::class, 'emp_migrant'] )->name('emp_migrant');
    Route::get( '/migrant_letter/{emp_code}/{letter}', [EmployeeController::class, 'migrant_letter'] )->name('migrant_letter');
    Route::post('/letter_sent', [EmployeeController::class, 'letter_sent'] )->name('letter_sent');
    Route::get( '/get_emp/{empid}', [EmployeeController::class, 'get_emp'] )->name('get_emp');
    Route::get( '/get_emp_doc/{empid}/{val}', [EmployeeController::class, 'get_emp_doc'] )->name('get_emp_doc');
    Route::get('/get_employee', [EmployeeController::class, 'get_employee'] )->name('get_employee');


    Route::resource('right_works', RightWorkController::class);
    Route::get( '/rightwork_excel/{id}', [RightWorkController::class, 'rightwork_excel'] )->name('rightwork_excel');

    /*Settings*/
    Route::resource('departments', DepartmentController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('employee_types', EmployeeTypeController::class);
    Route::get( '/get_emp_ytpe/{empid}', [EmployeeController::class, 'get_emp_ytpe'] )->name('get_emp_ytpe');

    Route::resource('paygroups', PayGroupController::class);
    Route::resource('annual_pays', AnnualPayController::class);
    Route::resource('banks', BankController::class);
    Route::resource('bankcodes', BankCodeController::class);
    Route::get('/bank_code/{bank_id}', [BankCodeController::class, 'bank_code'] )->name('bank_code');

    Route::resource('taxes', TaxController::class);
    Route::resource('payment_types', PaymentTypeController::class);
    Route::resource('wedges_pay_modes', WedgesPayModeController::class);

    Route::resource('jobs', JobController::class);
    Route::resource('job_posts', JobPostController::class);
    Route::resource('job_publisheds', JobPublishedController::class);
    Route::resource('job_applieds', JobAppliedController::class);
    Route::get('/job_shortlist', [JobAppliedController::class, 'job_shortlist'] )->name('job_shortlist');
    Route::get('/interview', [JobAppliedController::class, 'interview'] )->name('interview');
    Route::get('/hired', [JobAppliedController::class, 'hired'] )->name('hired');
    Route::get('/offer_letter', [JobAppliedController::class, 'offer_letter'] )->name('offer_letter');
    Route::get('/rejectted', [JobAppliedController::class, 'rejectted'] )->name('rejectted');

    Route::resource('offer_letters', OfferLetterController::class);
    Route::resource('message_centers', MessageCenterController::class);

    Route::get( '/job_code/{empid}', [JobPostController::class, 'job_code'] )->name('job_code');
    Route::get( '/job_empid/{empid}/{soc}', [JobPostController::class, 'job_empid'] )->name('job_empid');

    Route::resource('holiday_types', HolidayTypeController::class);
    Route::resource('holidays', HolidayController::class);

    Route::resource('leave_types', LeaveTypeController::class);
    Route::resource('leave_rules', LeaveRuleController::class);
    Route::resource('leave_allocations', LeaveAllocationController::class);
    Route::post( 'leave_allocations/search', [LeaveAllocationController::class, 'leave_allocations_search'] )->name('leave_allocations.search');
    Route::get('leave_balance', [LeaveAllocationController::class, 'leave_balance'] )->name('leave_balance.index');
    Route::get('leave_report', [LeaveAllocationController::class, 'leave_report'] )->name('leave_report.index');
    Route::get('leave_report/employee', [LeaveAllocationController::class, 'leave_report_employee'] )->name('leave_report.employee');
    Route::post('leave_report/search', [LeaveAllocationController::class, 'leave_report_search'] )->name('leave_report/search');
    Route::post( 'leave_report_excell', [LeaveAllocationController::class,'leave_report_excell'] )->name('leave_report_excell');
    Route::get( 'leave_request_approver', [LeaveAllocationController::class,'leave_request_approver'] )->name('leave_request_approver');
    Route::post( 'approved/{id}', [LeaveAllocationController::class,'approved'] )->name('approved');

    Route::resource('shifts', ShiftController::class);
    Route::get('/shift_code/{empid}/{des_id}', [ShiftController::class, 'shift_code'] )->name('shift_code');

    Route::resource('late_policies', LatePolicyController::class);

    Route::resource('dayoffs', DayOffController::class);
    Route::resource('grace_periods', GracePeriodController::class);
    Route::resource('duty_rosters', DutyRosterController::class);
    Route::resource('attendances', AttendanceController::class);

   // Route::get('/attendances/daily', [AttendanceController::class, 'ShowDailyAtt'])->name('attendances.daily');
    Route::get('/attendances/allreport', [AttendanceController::class, 'index'] )->name('attendances.index');
    Route::get('/attendances/daily', [AttendanceController::class, 'attendance_daily'] )->name('attendances.daily');
    Route::get('/attendances-bulk_attendance', [AttendanceController::class, 'bulk_attendance'] )->name('attendances.bulk_attendance');

    Route::post('/attendances/store', [AttendanceController::class, 'store'])->name('attendances.store');

    //Route::get('/attendances/calenderatt', [AttendanceController::class, 'calenderatt'] )->name('attendances.calenderatt');
    Route::post('/attendances/search', [AttendanceController::class, 'attendance_search'] )->name('attendances.search');
    Route::get('/attendance/process', [AttendanceController::class, 'attendance_process'] )->name('attendance.process');
    Route::post('/attendance/process_save', [AttendanceController::class, 'attendance_process_save'] )->name('attendance.process_save');
    Route::get('/attendance/report', [AttendanceController::class, 'attendance_report'] )->name('attendance.report');
    Route::post('/attendance/report_save', [AttendanceController::class, 'attendance_report_save'] )->name('attendance.report_save');
    Route::get('/leave_request', [LeaveAllocationController::class, 'leave_request'] )->name('leave_request');
    Route::get('/attendances/record/{code}/{year}', [AttendanceController::class, 'attendance_record'] )->name('attendances.record');
    Route::get('/attendance-calendar/{code}/{year}', [AttendanceController::class, 'generateCalendar'] )->name('attendance.calendar');
    Route::get('/attendance_file_upload', [AttendanceController::class, 'attendance_file_upload'] )->name('attendance_file_upload');
    Route::post('/file_upload', [AttendanceController::class, 'file_upload'] )->name('file_upload');
    Route::get('/attendance_emp_status', [AttendanceController::class, 'attendance_emp_status'] )->name('attendance_emp_status');
    
    Route::get('/get_emp_attendance/{id}', [AttendanceController::class, 'get_emp_attendance'] )->name('get_emp_attendance');

    Route::resource('services', ServiceController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::get('/get_ser/{id}', [ServiceController::class, 'get_ser'] )->name('get_ser');


    Route::resource('menus', MenuController::class);
    Route::resource('submenus', SubmenuController::class);
    Route::resource('contents', ContentController::class);
    Route::get('/get_submenu/{id}', [SubmenuController::class, 'get_submenu'] )->name('get_submenu');

    Route::resource('galleries', GalleryController::class);

});
