<?php

namespace App\Export;

use App\Helpers\Traits\DateRangeHelper;
use App\Helpers\Traits\DateTimeHelper;
use App\Models\Tenant\Attendance\Attendance;
use App\Models\Tenant\Attendance\AttendanceDetails;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromArray, WithHeadings
{
    use Exportable, DateTimeHelper, DateRangeHelper;


    private Collection $attendances;
    private bool $daily_log;

    public function __construct(Collection $attendances, $daily_log = false)
    {
        $this->attendances = $attendances;
        $this->daily_log = $daily_log;
    }

    public function headings(): array
    {
        return $this->daily_log ? [
            __t('name'),
            __t('department'),
            __t('punch_in'),
            __t('punch_out'),
            __t('total_hours'),
            __t('behavior'),
            __t('type'),
        ] : [
            __t('date'),
            __t('punch_in'),
            __t('punch_out'),
            __t('total_hours'),
            __t('behavior'),
            __t('type'),
        ];
    }

    public function array(): array
    {
        return $this->attendances->map(function (Attendance $attendance) {
            return $this->makeAttendanceRow($attendance);
        })->flatten(1)->toArray();
    }

    public function makeAttendanceRow($attendance): array
    {
        return $attendance->details->map(function (AttendanceDetails $attendanceDetails) use ($attendance) {
            $in_time = $this->carbon($attendanceDetails->in_time)->parse()->setTimezone(request('timeZone'))->toTimeString();
            $out_time = $attendanceDetails->out_time ?
                $this->carbon($attendanceDetails->out_time)->parse()->setTimezone(request('timeZone'))->toTimeString()
                : __t('not_yet');
            $total_hours = $attendanceDetails->out_time ?
                $this->convertSecondsToHoursMinutes(
                    $this->carbon($attendanceDetails->in_time)->parse()->diffInSeconds($attendanceDetails->out_time)
                )
                : '00:00';
            return $this->daily_log ? [
                $attendance->user->full_name,
                $attendance->user->department->name,
                $in_time,
                $out_time,
                $total_hours,
                $attendance->behavior,
                $attendanceDetails->review_by || $attendanceDetails->added_by ? __t('manual') : __t('auto')
            ] : [
                $this->carbon($attendance->in_date)->parse()->setTimezone(request('timeZone'))->format('d-m-Y'),
                $in_time,
                $out_time,
                $total_hours,
                $attendance->behavior,
                $attendanceDetails->review_by || $attendanceDetails->added_by ? __t('manual') : __t('auto')
            ];
        })->toArray();

    }
}