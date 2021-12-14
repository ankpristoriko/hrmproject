<?php

use App\Http\Controllers\Tenant\Export\AttendanceExportController;
use Illuminate\Routing\Router;

Route::group(['prefix' => 'app', ], function (Router $router) {

    $router->get('export/{employee}/attendance',[AttendanceExportController::class,'exportEmployeeAttendance'])->name('attendance-summery.export');

    $router->get('export/attendance/daily-log',[AttendanceExportController::class,'exportDailyLogAttendance'])->name('attendance-daily-log.export');

});