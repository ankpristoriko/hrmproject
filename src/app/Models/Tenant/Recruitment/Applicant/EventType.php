<?php

namespace App\Models\Tenant\Recruitment\Applicant;

use App\Models\Tenant\Recruitment\Applicant\Traits\Relationship\EventTypeRelationship;
use App\Models\Tenant\Recruitment\Applicant\Traits\Rules\EventTypeRules;
use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventType extends TenantModel
{
    use HasFactory, EventTypeRules, EventTypeRelationship;

    protected $fillable = ['name'];
}
