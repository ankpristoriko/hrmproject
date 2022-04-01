<?php

namespace App\Models\Tenant\Recruitment\JobPost\Traits\Relationship;

use App\Models\Tenant\Recruitment\JobPost\JobPost;

trait JobTypeRelationship
{
    public function jobs()
    {
        return $this->hasMany(JobPost::class, 'applicant_id');
    }
}