<?php

namespace App\Services\Tenant\Recruitment\Applicant;

use App\Models\Tenant\Recruitment\Applicant\Attendee;
use App\Services\Tenant\TenantService;

class AttendeeService extends TenantService
{
    public function __construct(Attendee $attendee)
    {
        $this->model = $attendee;
    }
}
