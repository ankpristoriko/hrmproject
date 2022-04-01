<?php

namespace App\Models\Tenant\Recruitment;

use App\Models\Tenant\TenantModel;
use App\Models\Tenant\Recruitment\Traits\Relationship\JobStageRelationship;
use App\Models\Tenant\Recruitment\Traits\Rules\JobStageRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobStage extends TenantModel
{
    use HasFactory, JobStageRules, JobStageRelationship;

    protected $fillable = ['name', 'job_post_id'];

    protected $casts = [
        'job_post_id' => 'int',
    ];
}