<?php

namespace App\Models\Tenant\Recruitment\Applicant;

use App\Models\Tenant\Recruitment\Applicant\Traits\Relationship\ApplicantRelationship;
use App\Models\Tenant\Recruitment\Applicant\Traits\Rules\ApplicantRules;
use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends TenantModel
{
    use HasFactory, ApplicantRules, ApplicantRelationship;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'gender',
        'date_of_birth'
    ];

    protected $casts = [
        'date_of_birth' => 'datetime:Y-m-d'
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return $this->last_name
            ? $this->first_name . ' ' . $this->last_name
            : $this->first_name;
    }

    public function getNameAttribute()
    {
        return $this->full_name;
    }

}
