<?php

namespace App\Services\Tenant\Recruitment\Applicant;

use App\Models\Tenant\Recruitment\Applicant\ApplicationAnswer;
use App\Services\Tenant\TenantService;

class ApplicationAnswerService extends TenantService
{
    public function __construct(ApplicationAnswer $answers)
    {
        $this->model = $answers;
    }
}