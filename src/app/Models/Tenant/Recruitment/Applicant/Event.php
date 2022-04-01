<?php

namespace App\Models\Tenant\Recruitment\Applicant;

use App\Models\Tenant\Recruitment\Applicant\Traits\Relationship\EventRelationship;
use App\Models\Tenant\Recruitment\Applicant\Traits\Rules\EventRules;
use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends TenantModel
{
    use HasFactory, EventRules, EventRelationship;

    protected $fillable = ['event_type_id', 'job_applicant_id', 'location', 'start_at', 'end_at', 'description'];

    protected $casts = [
        'event_type_id' => "integer",
        'job_applicant_id' => "integer",
    ];
}
