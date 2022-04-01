<?php

namespace App\Models\Tenant\Recruitment\Applicant\Traits\Relationship;

use App\Models\Tenant\Recruitment\Applicant\Attendee;
use App\Models\Tenant\Recruitment\Applicant\EventType;
use App\Models\Tenant\Recruitment\Applicant\JobApplicant;

trait EventRelationship
{
    public function eventType()
    {
        return $this->belongsTo(EventType::class, 'event_type_id');
    }

    public function jobApplicant()
    {
        return $this->belongsTo(JobApplicant::class, 'job_applicant_id');
    }

    public function attendees()
    {
        return $this->hasMany(Attendee::class, 'event_id');
    }
}
