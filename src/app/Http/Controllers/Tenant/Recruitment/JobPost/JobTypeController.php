<?php

namespace App\Http\Controllers\Tenant\Recruitment\JobPost;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\JobPost\JobTypeRequest;
use App\Models\App\JobPost\JobType;
use App\Services\App\JobPost\JobTypeService;

class JobTypeController extends Controller
{
    public function __construct(JobTypeService $service)
    {
        $this->service = $service;
    }

    public function index(): object
    {
        return $this->service
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }

    public function store(JobTypeRequest $request): array
    {

        $this->service
            ->setAttributes($request->only('name', 'brief'))
            ->save();

        return created_responses('job_type');
    }

    public function show(JobType $jobType): object
    {
        return $jobType;
    }

    public function update(JobTypeRequest $request, JobType $jobType)
    {
        $this->service
            ->setModel($jobType)
            ->save(
                $request->only('name', 'brief')
            );

        return updated_responses('job_type');
    }

    public function destroy(JobType $jobType)
    {
        $jobType->delete();

        return deleted_responses('job_type');
    }

    public function getAllJobTypes(JobType $jobType)
    {
        return $jobType->all();
    }
}
