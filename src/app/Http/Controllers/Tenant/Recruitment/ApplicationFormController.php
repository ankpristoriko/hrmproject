<?php

namespace App\Http\Controllers\Tenant\Recruitment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Recruitment\ApplicationFormRequest;
use App\Models\Core\Setting\Setting;
use App\Services\Tenant\Setting\SettingService;

class ApplicationFormController extends Controller
{
    public function __construct(SettingService $service)
    {
        $this->service = $service;
        $this->setting = "";
    }

    private function __setJobSettingsData()
    {
        $this->setting = Setting::where('name', 'application_form')->first();
    }

    public function show()
    {
        $this->__setJobSettingsData();
        return array($this->setting->name => json_decode($this->setting->value));
    }

    public function update(ApplicationFormRequest $request)
    {
        $this->__setJobSettingsData();
        $this->setting->value = json_encode($request->application_form);
        $this->setting->save();
        return updated_responses('global_application_form');
    }
}
