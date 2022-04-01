<?php

namespace App\Models\Tenant\Recruitment\Applicant;

use App\Models\Tenant\Recruitment\Applicant\Traits\Relationship\JobApplicantRelationship;
use App\Models\Tenant\Recruitment\Applicant\Traits\Rules\JobApplicantRules;
use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplicant extends TenantModel
{
    use HasFactory, JobApplicantRules, JobApplicantRelationship;

    protected $fillable = ['applicant_id', 'review', 'disqualification_reason',
        'job_post_id', 'slug',
        'current_stage_id', 'status_id', 'apply_form_setting'];

    protected $casts = [
        'applicant_id' => 'integer',
        'job_post_id' => 'integer',
        'current_stage_id' => 'integer',
        'status_id' => 'integer',
        'review' => 'string',
        'apply_form_setting' => 'object',
    ];
}
