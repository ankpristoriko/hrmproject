<?php


namespace App\Http\Composer\Helper;


use App\Helpers\Core\Traits\InstanceCreator;

class RecruitmentPermissions
{
    use InstanceCreator;

    public function permissions()
    {
        return [
            // [
            //     'name' => __t('career_page'),
            //     'url' => route('support.recruitments.career-page',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
            //     'permission' => authorize_any(['view_career_page'])
            // ],
            [
                'name' => __t('job_settings'),
                'url' => route('support.recruitment.job-setting',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
                'permission' => authorize_any(['can_view_job_setting'])
            ],
            //Recruitment - Job Settings
            // [
            //     'name' => __t('can_manage_global_application_form'),
            //     'url' => route('support.recruitment.application-form',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
            //     'permission' => authorize_any(['can_manage_global_application_form'])
            // ],
            // [
            //     'name' => __t('can_view_event_type'),
            //     'url' => route('support.recruitment.event-type',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
            //     'permission' => authorize_any([
            //         'can_view_event_type',
            //         'can_create_event_type',
            //         'can_update_event_type',
            //         'can_delete_event_type'
            //     ])
            // ],
            // [
            //     'name' => 'can_view_job_type',
            //     'type_id' => $tenant,
            //     'group_name' => 'job_settings'
            // ],
            // [
            //     'name' => 'can_create_job_type',
            //     'type_id' => $tenant,
            //     'group_name' => 'job_settings'
            // ],
            // [
            //     'name' => 'can_update_job_type',
            //     'type_id' => $tenant,
            //     'group_name' => 'job_settings'
            // ],
            // [
            //     'name' => 'can_delete_job_type',
            //     'type_id' => $tenant,
            //     'group_name' => 'job_settings'
            // ],
            // [
            //     'name' => 'can_view_stage',
            //     'type_id' => $tenant,
            //     'group_name' => 'job_settings',
            // ],
            // [
            //     'name' => 'can_create_stage',
            //     'type_id' => $tenant,
            //     'group_name' => 'job_settings',
            // ],
            // [
            //     'name' => 'can_update_stage',
            //     'type_id' => $tenant,
            //     'group_name' => 'job_settings',
            // ],
            // [
            //     'name' => 'can_delete_stage',
            //     'type_id' => $tenant,
            //     'group_name' => 'job_settings',
            // ],
        ];
    }

    public function canVisit()
    {
        return authorize_any([
            'view_job_settings'
        ]);
    }
}
