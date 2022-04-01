<?php

namespace App\Models\Tenant\Recruitment\Applicant;

use App\Models\Tenant\Recruitment\Applicant\Traits\Rules\ApplicationAnswerRules;
use App\Models\Tenant\TenantModel;
use App\Models\Tenant\Recruitment\JobPost\Traits\Relationship\JobApplicationSettingRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationAnswer extends TenantModel
{
    use HasFactory, ApplicationAnswerRules, JobApplicationSettingRelationship;

    protected $fillable = ['job_applicant_id', 'question'];

    protected $casts = [
        'job_applicant_id' => 'integer'
    ];
}
