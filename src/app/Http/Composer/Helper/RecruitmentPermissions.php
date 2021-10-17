<?php


namespace App\Http\Composer\Helper;


use App\Helpers\Core\Traits\InstanceCreator;

class RecruitmentPermissions
{
    use InstanceCreator;

    public function permissions()
    {
        return [
            [
                'name' => __t('job_settings'),
                'url' => route('support.recruitments.job',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
                'permission' => authorize_any(['view_job_settings'])
            ],
        ];
    }

    public function canVisit()
    {
        return authorize_any([
            'view_job_settings'
        ]);
    }
}
