<?php

namespace App\Models\Tenant\Recruitment\Applicant;

use App\Models\Tenant\Recruitment\Applicant\Traits\Relationship\NoteRelationship;
use App\Models\Tenant\Recruitment\Applicant\Traits\Rules\NoteRules;
use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends TenantModel
{
    use HasFactory, NoteRules, NoteRelationship;

    protected $fillable = ['job_applicant_id', 'noted_by', 'description'];

    protected $casts = [
        'job_applicant_id' => "integer",
        'noted_by' => "integer"
    ];
}
