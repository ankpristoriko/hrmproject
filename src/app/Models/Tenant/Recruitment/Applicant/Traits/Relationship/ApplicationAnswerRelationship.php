<?php

namespace App\Models\Tenant\Recruitment\Applicant\Traits\Relationship;

use App\Models\Tenant\Recruitment\Applicant\JobApplicant;

trait ApplicationAnswerRelationship
{
    public function jobApplicant()
    {
        return $this->belongsTo(JobApplicant::class, 'job_applicant_id');
    }
}