<?php

namespace App\Models\Tenant\Recruitment\JobPost\Traits\Relationship;

use App\Models\Tenant\Recruitment\JobPost\JobPost;

trait JobApplicationSettingRelationship
{
    public function jobPost()
    {
        return $this->belongsTo(JobPost::class, 'job_post_id');
    }
}
