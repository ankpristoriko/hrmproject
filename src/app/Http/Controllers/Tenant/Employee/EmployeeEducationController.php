<?php

namespace App\Http\Controllers\Tenant\Employee;

use App\Http\Controllers\Controller;
use App\Models\Core\Auth\User;
use App\Models\Tenant\Employee\UserEducation;
use App\Services\Tenant\Employee\EmployeeEducationService;
use App\Models\Core\File\File;
use App\Helpers\Core\Traits\FileHandler;

class EmployeeEducationController extends Controller
{
    use FileHandler;

    public function __construct(EmployeeEducationService $service)
    {
        $this->service = $service;
    }

    public function index(User $employee)
    {
        return $employee->educations->sortBy(function (UserEducation $education) {
            return $education->id;
        });
    }

    public function store() {
        $this->service
            ->setAttributes(request()->all())
            ->basicValidations()
            ->saveEmployeeEducation();

        return updated_responses('employee_educations');
    }

    public function show(User $employee, UserEducation $education)
    {
        return $education;
    }

    public function delete(User $employee, $educationId)
    {
        $userEducation = UserEducation::where('id', $educationId)->first();
        $educationFile = File::where('fileable_id', $educationId)->where('type', 'employee_education')->get();
        
        foreach ($educationFile as $attachment) {
            $this->deleteImage($attachment->path);
            $attachment->delete();
        }
        
        $userEducation->delete();

        return deleted_responses('employee_educations');
    }
}
