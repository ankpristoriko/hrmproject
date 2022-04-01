<?php

namespace App\Models\Tenant\Recruitment\Applicant;

use App\Models\Tenant\Recruitment\Applicant\Traits\Relationship\AttendeeRelationship;
use App\Models\Tenant\Recruitment\Applicant\Traits\Rules\AttendeeRules;
use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendee extends TenantModel
{
    use HasFactory, AttendeeRules, AttendeeRelationship;

    protected $fillable = ['event_id', 'hiring_team_id'];

    protected $casts = [
        'event_id' => 'int',
        'hiring_team_id' => 'int'
    ];

    public $timestamps = false;
}
