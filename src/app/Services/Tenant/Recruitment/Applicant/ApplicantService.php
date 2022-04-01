<?php

namespace App\Services\Tenant\Recruitment\Applicant;

use App\Models\Tenant\Recruitment\Applicant\Applicant;
use App\Services\Tenant\TenantService;

class ApplicantService extends TenantService
{
    public function __construct(Applicant $applicant)
    {
        $this->model = $applicant;
    }
}
