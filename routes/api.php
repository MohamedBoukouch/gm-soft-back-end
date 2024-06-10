<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Director_Services_Controller;
use App\Http\Controllers\Emplyee_Services_Controller;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\TimeTrackingController;
use App\Http\Controllers\OrderDeplacmentController;
use App\Http\Controllers\SentFeuilleController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\DashboardController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/test', [AuthController::class, 'test']);

//Authe
Route::post('/createCompte', [AuthController::class, 'createCompte']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/profile', [AuthController::class, 'profile']);
Route::post('/checkEmail', [AuthController::class, 'checkEmail']);
Route::post('/checkCompanyName', [AuthController::class, 'checkCompanyName']);
Route::post('/changePassword', [AuthController::class, 'changePassword']);
Route::post('/sendVerificationCode', [AuthController::class, 'sendVerificationCode']);



//Services Dericture
Route::post('/AddEmployee', [Director_Services_Controller::class, 'AddEmployee']);
Route::post('/DropEmployee', [Director_Services_Controller::class, 'DropEmployee']);
Route::post('/FetchEmployee', [Director_Services_Controller::class, 'FetchEmployee']);
Route::post('/uploadimage', [Director_Services_Controller::class, 'uploadimage']);
Route::post('/getEmployeesNotClockedIn', [Director_Services_Controller::class, 'getEmployeesNotClockedIn']);
Route::post('/getEmployeesWithTimeEntry', [Director_Services_Controller::class, 'getEmployeesWithTimeEntry']);
Route::post('/getEmploiyeesTakebreak', [Director_Services_Controller::class, 'getEmploiyeesTakebreak']);
Route::post('/getEmploiyeesAfterBreak', [Director_Services_Controller::class, 'getEmploiyeesAfterBreak']);
Route::post('/getEmployeeLeave', [Director_Services_Controller::class, 'getEmployeeLeave']);
Route::post('/AddProject', [Director_Services_Controller::class, 'AddProject']);
Route::post('/fetchProjects', [Director_Services_Controller::class, 'fetchProjects']);
Route::post('/DeleteProject', [Director_Services_Controller::class, 'DeleteProject']);
Route::post('/getMostActiveEmployees', [Director_Services_Controller::class, 'getMostActiveEmployees']);

//Pointage
Route::post('/pointage', [Emplyee_Services_Controller::class, 'pointage']);
Route::post('/updatePauseExit', [Emplyee_Services_Controller::class, 'updatePauseExit']);
Route::post('/updatePauseEntry', [Emplyee_Services_Controller::class, 'updatePauseEntry']);
Route::post('/TimeExite', [Emplyee_Services_Controller::class, 'TimeExite']);



Route::post('/AddVacation', [VacationController::class, 'AddVacation']);
Route::post('/employeeVacations', [VacationController::class, 'employeeVacations']);
Route::post('/updateVacation', [VacationController::class, 'updateVacation']);





//Vacation
Route::post('/AddVacation', [VacationController::class, 'AddVacation']);
Route::post('/fetchVacationsDerictore', [VacationController::class, 'fetchVacationsDerictore']);
Route::post('/fetchVacationsEmployee', [VacationController::class, 'fetchVacationsEmployee']);
Route::post('/deleteVacation', [VacationController::class, 'deleteVacation']);

//the director manage the vactiosn
Route::post('/approveOrRejectVacation', [VacationController::class, 'approveOrRejectVacation']);
Route::get('/fetchEmployeeVacations', [VacationController::class, 'fetchEmployeeVacations']);
Route::get('/FetchUserByEmployeeId/{userId}', [VacationController::class, 'fetchUserByEmployeeId']);

// Route::get('/fetchUserByEmployeeId/{employeeId}', 'UserController@fetchUserByEmployeeId');

//OrderDeplacment
Route::post('/AddDeplacement', [OrderDeplacmentController::class, 'AddDeplacement']);
Route::post('/fetchOrderDeplacmentsForEmployee', [OrderDeplacmentController::class, 'fetchOrderDeplacmentsForEmployee']);
Route::post('/addCharges', [OrderDeplacmentController::class, 'addCharges']);
Route::post('/getAllCharges', [OrderDeplacmentController::class, 'getAllCharges']);
Route::post('/fetchOrderDeplacmentsForCompany', [OrderDeplacmentController::class, 'fetchOrderDeplacmentsForCompany']);
Route::post('/acceptOrderDeplacment', [OrderDeplacmentController::class, 'acceptOrderDeplacment']);
Route::post('/DeleteOrderDeplacment', [OrderDeplacmentController::class, 'DeleteOrderDeplacment']);
Route::post('/updateLocalisationVerify', [OrderDeplacmentController::class, 'updateLocalisationVerify']);
Route::post('/FineMession', [OrderDeplacmentController::class, 'FineMession']);
Route::post('/countPendingOrders', [OrderDeplacmentController::class, 'countPendingOrders']);
Route::post('/OrdersAccepter', [OrderDeplacmentController::class, 'OrdersAccepter']);
Route::post('/OrdersFini', [OrderDeplacmentController::class, 'OrdersFini']);
Route::post('/getOrderStatistics', [OrderDeplacmentController::class, 'getOrderStatistics']);




//handle profile
Route::get('/fetchAuthenticatedUserData/{userId}', [Director_Services_Controller::class, 'fetchAuthenticatedUserData']);



//paiment 
Route::post('/paymentsAdd', [ResourceController::class, 'addPayment']);
Route::get('/fetchPayments', [ResourceController::class, 'fetchPayments']);
Route::delete('/deletePayments/{paymentId}', [ResourceController::class, 'deletePayments']);
Route::put('/updatePaymentStatus/{paymentId}', [ResourceController::class, 'updatePaymentStatus']);


//paiemnt mode
Route::post('/addPayment_modes', [ResourceController::class, 'addPaymentMode']);
Route::get('/fetchPayment_modes', [ResourceController::class, 'fetchPaymentModes']);
// Route::post('/deletePayment_modes/delete/{id}', [ResourceController::class, 'deletePaymentMode']);
// Route::delete('/deletepayment_modes/{id}', [ResourceController::class, 'deletePaymentMode'])->name('payment_modes.delete');
// Route::post('/payment_modes/delete/{id}', 'PaymentModeController@deletePaymentMode');
Route::delete('/deletePayment_modes/{id}',[ResourceController::class, 'deletePaymentMode']);



//facture
Route::post('/addInvoices',[ResourceController::class, 'addInvoices']);
Route::get('/fetchInvoices',[ResourceController::class, 'fetchInvoices']);
Route::delete('/deleteInvoice/{id}', [ResourceController::class, 'deleteInvoice']);



//weklly Timesheet
Route::post('/save-time-data', [TimeTrackingController::class, 'saveTimeData']);
Route::get('/projects', [TimeTrackingController::class, 'getProjects']);
Route::get('/get-total-regular-time', [TimeTrackingController::class, 'getTotalRegularTime']);
Route::get('/sum_regular', [TimeTrackingController::class, 'TotalRegularTime']);
Route::delete('/delete_project', [TimeTrackingController::class, 'deleteProject']);
Route::post('/sent-feuille', [SentFeuilleController::class, 'store']);
Route::get('check-feuille', [SentFeuilleController::class, 'checkFeuille']);




//Daily Timesheet
Route::post('/savetimesheets', [TimesheetController::class, 'saveTimesheet']);
Route::post('/sentTimesheet', [TimesheetController::class, 'sentTimesheet']);
Route::post('/checksent', [TimesheetController::class, 'checkTimesheetStatus']);
Route::get('/checksentRH', [TimesheetController::class, 'checkTimesheetStatus']);
Route::post('/fetchTimesheetDetail', [TimesheetController::class, 'fetchTimesheetDetail']);


//dashboard
Route::get('/projects', [DashboardController::class, 'getProjects']);
Route::get('/vacation-requests', [DashboardController::class, 'getPendingVacationRequests']);
Route::post('/vacation-requests/{id}/approve', [DashboardController::class, 'approveVacationRequest']);
Route::post('/vacation-requests/{id}/reject', [DashboardController::class, 'rejectVacationRequest']);
Route::get('/vacation-counts', [DashboardController::class, 'getVacationCounts']);
Route::get('/employee-stats', [DashboardController::class, 'getEmployeeStats']);
Route::get('/employees-by-role/{role}', [DashboardController::class, 'getEmployeesByRole']);
Route::get('/order-stats', [DashboardController::class, 'getOrderStats']);
Route::get('/tracking/employees-by-status', [DashboardController::class, 'getEmployeesByStatus']);


//for new Tracking 2


// use App\Http\Controllers\TrackingController;

Route::post('/startTracking', [TrackingController::class, 'startTracking']);
Route::post('/pauseTracking/{trackingId}', [TrackingController::class, 'pauseTracking']);
Route::post('/resumeTracking/{trackingId}', [TrackingController::class, 'resumeTracking']);
Route::post('/stopTracking/{trackingId}', [TrackingController::class, 'stopTracking']);
Route::post('/updateTrackingRemarks/{trackingId}', [TrackingController::class, 'updateTrackingRemarks']);
Route::post('/updateTrackingStatus/{trackingId}', [TrackingController::class, 'updateTrackingStatus']);
// Route::post('/fetchProjects', [TrackingController::class, 'fetchProjects']);
Route::post('/completeTracking/{trackingId}', [TrackingController::class, 'completeTracking']);
// Route::post('/fetchProjects', [TrackingController::class, 'fetchProjects']);
