<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\NotificationController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::controller(UserController::class)->group(function (){
    Route::post('/login','login')->name('user.login');
    Route::post('/register','register')->name('user.register');
    Route::get('/employees', 'showEmployee')->name('user.showEmployee');
    Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);
});

Route::controller(AttendanceController::class)->group(function (){
    Route::post('/attendance', 'store')->name('attendance.checkin');
    Route::patch('/attendance/{id}', 'update')->name('attendance.checkout');
    Route::get('/attendance-today/{date}', 'todayAttendance')->name('attendance.show');
    Route::get('/attendance/{id}', 'byEmployeeAttendance')->name('attendance.byemployee');
    Route::get('/attendance-month/{monthYear}', 'byMonth')->name('attendance.bymonth');
});

Route::controller(LeaveController::class)->group(function (){
    Route::post('/leave', 'store')->name('leave.store');
    Route::patch('/leave/{id}', 'update')->name('leave.update');
    Route::get('/leave', 'index')->name('leave.show');
    Route::get('/leave/employee/{id}', 'byEmployeeLeave')->name('leave.byemployee');
    Route::get('/leave/pending', 'pendingLeave')->name('leave.pending');


});

Route::controller(NotificationController::class)->group(function (){
   Route::post('/notification', 'createNotification')->name('notification.store');
   Route::get('/notification', 'index')->name('notification.index');
   Route::get('/notification/{id}', 'byEmployeeNotification')->name('notification.byemployee');
});
