<?php

namespace App\Models\Tenant\Recruitment;

use App\Models\Tenant\TenantModel;
use App\Models\Tenant\Recruitment\Traits\Relationship\HiringTeamRelationship;
use App\Models\Tenant\Recruitment\Traits\Rules\HiringTeamRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HiringTeam extends TenantModel
{
    use HasFactory, HiringTeamRules, HiringTeamRelationship;

    protected $fillable = ['job_post_id', 'recruiter_id'];

    protected $casts = [
        'job_post_id' => 'integer',
        'recruiter_id' => 'integer'
    ];
}