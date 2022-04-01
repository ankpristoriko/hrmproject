<?php

namespace App\Services\Tenant\Recruitment\Applicant;

use App\Models\Tenant\Recruitment\Applicant\EventType;
use App\Services\Tenant\TenantService;

class EventTypeService extends TenantService
{
    public function __construct(EventType $eventType)
    {
        $this->model = $eventType;
    }
}
