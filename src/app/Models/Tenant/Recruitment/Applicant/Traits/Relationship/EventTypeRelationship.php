<?php

namespace App\Models\Tenant\Recruitment\Applicant\Traits\Relationship;

use App\Models\Tenant\Recruitment\Applicant\Event;

trait EventTypeRelationship
{
    public function events()
    {
        return $this->hasMany(Event::class, 'event_type_id');
    }
}