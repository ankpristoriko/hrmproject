<?php

namespace App\Services\Tenant\Employee;

use App\Helpers\Core\Traits\HasWhen;
use App\Models\Core\Auth\User;
use App\Models\Tenant\Employee\UserEducation;
use App\Services\Tenant\TenantService;
use App\Models\Core\File\File;
use App\Helpers\Core\Traits\FileHandler;

class EmployeeEducationService extends TenantService
{
    use HasWhen, FileHandler;

    public function __construct(User $employee)
    {
        $this->model = $employee;
    }

    public function basicValidations(): self
    {
        validator($this->getAttributes(), [
            'education_level' => 'required',
            'educational_institution' => 'required',
            'attachments.*' => 'mimes:png,pdf|max:2000'
        ],[
                'attachments.*.mimes' => 'Only png or pdf files are allowed. ',
                'attachments.*.max' => 'Maximum allowed size for an file is 2MB.',
            ]
        )->validate();

        return $this;
    }

    public function saveEmployeeEducation(): self
    {
        $this->buildNewEducation()
            ->saveAttachments();

        return $this;
    }

    public function buildNewEducation(): self
    {
        $this->userEducation = UserEducation::where('id', $this->getAttribute('education_id'))
                                    ->where('user_id', $this->getAttribute('employee_id'))
                                    ->where('key', $this->getAttribute('type'))
                                    ->first();

        if($this->userEducation) {
            $this->userEducation->update([
                'value' => json_encode($this->getAttrs('education_level', 'education_field', 'educational_institution', 'educational_institution_detail', 'location', 'start_year', 'end_year', 'grade_point_average', 'achievement', 'remark'))
            ]);
        } else {
            UserEducation::create([
                'user_id' => $this->getAttribute('employee_id'),
                'key' => $this->getAttribute('type'),
                'value' => json_encode($this->getAttrs('education_level', 'education_field', 'educational_institution', 'educational_institution_detail', 'location', 'start_year', 'end_year', 'grade_point_average', 'achievement', 'remark'))
            ]);
        }

        return $this;
    }

    public function saveAttachments(): self
    {
        if ($this->getAttr('attachments') && count($this->getAttr('attachments')) > 0) {
            foreach ($this->getAttr('attachments') as $attachment) {
                $this->userEducation->attachments()->save(new File([
                    'path' => $this->storeFile($attachment, 'employee-education'),
                    'type' => 'employee_education',
                ]));
            }
        }

        return $this;
    }
}
