<?php

namespace App\Models\Tenant\Recruitment\JobPost;

use App\Models\Tenant\TenantModel;
use App\Models\Tenant\Recruitment\JobPost\Traits\Rules\JobPostRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Tenant\Recruitment\JobPost\Traits\Relationship\JobPostRelationship;

class JobPost extends TenantModel
{
    use HasFactory, JobPostRules, JobPostRelationship;

    protected $fillable = [
        'department_id',
        'job_type_id',
        'status_id',
        'stages',
        'posted_by',
        'name',
        'salary',
        'description',
        'responsibilities',
        'slug',
        'last_submission_date',
        'job_post_settings',
        'apply_form_settings',
    ];

    protected $casts = [
        'department_id' => 'integer',
        'job_type_id' => 'integer',
        'status_id' => 'integer',
        'posted_by' => 'integer',
        'last_submission_date' => 'datetime:Y-m-d',
        'job_post_settings' => 'object',
        'apply_form_settings' => 'object',
    ];
}