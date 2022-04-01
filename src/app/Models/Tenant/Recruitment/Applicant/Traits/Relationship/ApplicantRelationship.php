<?php

namespace App\Models\Tenant\Recruitment\Applicant\Traits\Relationship;

use App\Models\Tenant\Recruitment\Applicant\JobApplicant;

trait ApplicantRelationship
{
    public function jobApplicants()
    {
        return $this->hasMany(JobApplicant::class, 'applicant_id');
    }

    public function totalApplication()
    {
        return $this->jobApplicants()
            ->selectRaw('applicant_id, count(*) as count')
            ->groupBy('applicant_id');
    }
}
