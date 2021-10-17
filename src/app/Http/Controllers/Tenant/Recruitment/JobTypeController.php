<?php

namespace App\Http\Controllers\Tenant\Recruitment;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Recruitment\JobType;
use App\Filters\Tenant\Recruitment\JobTypeFilter;
use App\Services\Tenant\Recruitment\JobTypeService;

class JobTypeController extends Controller
{
    public function __construct(JobTypeService $service, JobTypeFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return JobType::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(JobType $jobType)
    {
        return $jobType;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name','brief'))
            ->validate()
            ->save();

        return created_responses('job_type');
    }

    public function update(Request $request, JobType $jobType)
    {
        $this->service
            ->setModel($jobType)
            ->setAttributes($request->only('name','brief'))
            ->validate()
            ->validateJobTypes()
            ->save();

        return updated_responses('job_type');
    }

    public function destroy(JobType $jobType)
    {
        try {
            $jobType->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_job_type'));
        }

        return deleted_responses('job_type');       
    }
}