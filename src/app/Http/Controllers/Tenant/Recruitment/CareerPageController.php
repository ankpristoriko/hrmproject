<?php

namespace App\Http\Controllers\Tenant\Recruitment;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Recruitment\JobPost\JobPost;
use App\Models\Core\Setting\Setting;
use App\Repositories\Core\Status\StatusRepository;
use App\Services\Core\Setting\SettingService;
use Illuminate\Http\Request;

class CareerPageController extends Controller
{
    private $setting = null;

    public function __construct(SettingService $service)
    {
        $this->service = $service;
    }

    public function show()
    {
        $setting = Setting::where('name', 'career_page')->first();
        return array($setting->name => json_decode($setting->value));
    }

    public function showCareerPage(JobPost $jobPost)
    {
        $setting = Setting::where('name', 'career_page')->first();
        $careerPage = json_decode($setting->value);
        $jobPosts = $jobPost
            ->select('id', 'name', 'job_type_id', 'slug', 'last_submission_date')
            ->with([
                'location:id,address',
                'jobType:id,name',
            ])
            ->where('status_id', resolve(StatusRepository::class)->getStatusId('job_post', 'status_open'))
            ->get();
        return view('tenant.recruitment.career-page.index', ['careerPage' => $careerPage, 'jobPosts' => $jobPosts]);
    }

    private function __setCareerSettingsData()
    {
        $this->setting = Setting::where('name', 'career_page')->first();
    }

    public function update(Request $request)
    {
        $request->validate([
            'career_page' => 'required|array'
        ]);

        $this->__setCareerSettingsData();

        $this->setting->value = json_encode($request->career_page);
        $this->setting->save();
        return updated_responses('career_page');
    }
}
