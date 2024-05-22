<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Director_Services_Controller;
use App\Http\Controllers\Emplyee_Services_Controller;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\OrderDeplacmentController;
use App\Http\Controllers\TimeTrackingController;
use App\Http\Controllers\SentFeuilleController;
use App\Http\Controllers\TimesheetController;

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

//Pointage
Route::post('/pointage', [Emplyee_Services_Controller::class, 'pointage']);
Route::post('/updatePauseExit', [Emplyee_Services_Controller::class, 'updatePauseExit']);
Route::post('/updatePauseEntry', [Emplyee_Services_Controller::class, 'updatePauseEntry']);
Route::post('/TimeExite', [Emplyee_Services_Controller::class, 'TimeExite']);

// Route::post('/AddVacation', [VacationController::class, 'AddVacation']);



//Vacation
Route::post('/AddVacation', [VacationController::class, 'AddVacation']);
Route::post('/fetchVacationsDerictore', [VacationController::class, 'fetchVacationsDerictore']);
Route::post('/fetchVacationsEmployee', [VacationController::class, 'fetchVacationsEmployee']);
Route::post('/deleteVacation', [VacationController::class, 'deleteVacation']);
Route::post('/updateVacationStatus', [VacationController::class, 'updateVacationStatus']);

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
