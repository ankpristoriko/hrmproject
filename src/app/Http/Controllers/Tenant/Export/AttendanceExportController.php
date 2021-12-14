<?php

namespace App\Http\Controllers\Tenant\Export;

use App\Export\AttendanceExport;
use App\Filters\Tenant\AttendanceSummaryFilter;
use App\Helpers\Traits\DateRangeHelper;
use App\Helpers\Traits\SettingKeyHelper;
use App\Http\Controllers\Controller;
use App\Models\Core\Auth\User;
use App\Models\Tenant\Attendance\Attendance;
use App\Models\Tenant\Attendance\AttendanceDetails;
use App\Repositories\Core\Status\StatusRepository;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel;

class AttendanceExportController extends Controller
{
    use DateRangeHelper, SettingKeyHelper;

    public function __construct(AttendanceSummaryFilter $filter)
    {
        $this->filter = $filter;
    }

    public function exportEmployeeAttendance(User $employee)
    {

        $within = request()->get('within');
        $month = $within ?: request('month_number') + 1;
        $ranges = $this->getStartAndEndOf($month, request()->get('year'));

        $attendanceApprove = resolve(StatusRepository::class)->attendanceApprove();

        $attendances = Attendance::filters($this->filter)
            ->select(['id', 'in_date', 'user_id', 'behavior'])
            ->where('user_id', $employee->id)
            ->where('status_id', $attendanceApprove)
            ->with([
                'details' => fn(HasMany $hasMany) => $hasMany
                    ->select('id', 'in_time', 'out_time', 'attendance_id', 'status_id', 'review_by', 'added_by', 'attendance_details_id')
                    ->orderBy('in_time', 'DESC')
                    ->where('status_id', $attendanceApprove),
                'details.comments' => fn(MorphMany $morphMany) => $morphMany->orderBy('parent_id', 'DESC')
                    ->select('id', 'commentable_type', 'commentable_id', 'user_id', 'type', 'comment', 'parent_id')
            ])
            ->whereBetween(DB::raw('DATE(in_date)'), $this->convertRangesToStringFormat(count($ranges) == 1 ? [$ranges[0], $ranges[0]] : $ranges))
            ->get();

        $file_name = Str::of($employee->full_name)->kebab() . '-attendances-' . Str::of($within ?: \request('month'))->kebab() . '.xlsx';

        return (new AttendanceExport($attendances))->download($file_name, Excel::XLSX);

    }

    public function exportDailyLogAttendance()
    {
        $attendanceApprove = resolve(StatusRepository::class)->attendanceApprove();

        $attendances = Attendance::filters($this->filter)
            ->with([
                'user:id,first_name,last_name,status_id',
                'user.department:id,name',
                'details.status:name,id',
                'details' => fn(HasMany $hasMany) => $hasMany
                    ->select('id', 'in_time', 'out_time', 'attendance_id', 'status_id', 'review_by', 'added_by', 'attendance_details_id')
                    ->where('status_id', $attendanceApprove)
                    ->orderBy('in_time', 'DESC'),
                'details.comments' => fn(MorphMany $many) => $many->orderBy('parent_id', 'DESC')
                    ->select('id', 'commentable_type', 'commentable_id', 'user_id', 'type', 'comment', 'parent_id')
            ])->where('status_id', $attendanceApprove)
            ->get();

        $file_name = \request('date') . '-attendances.xlsx';

        return (new AttendanceExport($attendances, true))->download($file_name, Excel::XLSX);
    }
}
