<?php

namespace App\Http\Composer;

use App\Helpers\Settings\SettingParser;
use App\Http\Composer\Helper\LogoIcon;
use Illuminate\Support\Facades\Cache;
use App\Http\Composer\Helper\LeavePermissions;
use Illuminate\View\View;

class TenantMainMenuComposer
{
    public function compose(View $view)
    {
        ['logo' => $logo, 'icon' => $icon] = LogoIcon::new(true)
            ->logoIcon();

        if(request()->segment(1) == 'employee') {
            $view->with([
                'permissions' => [
                    [
                        'name' => __t('main_menu'),
                        'icon' => 'home',
                        'url' => route('tenant.menu', optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name]),
                        'permission' => true,
                    ],
                    [
                        'name' => __t('dashboard'),
                        'icon' => 'pie-chart',
                        'url' => route('support.employee.dashboard',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
                        'permission' => true
                    ],
                    [
                        'name' => __t('all_employees'),
                        'icon' => 'users',
                        'url' => route('support.employee.lists',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
                        'permission' => true
                    ],
                    [
                        'name' => __t('designation'),
                        'icon' => 'user',
                        'url' => route('support.employee.designations',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
                        'permission' => authorize_any(['view_designations'])
                    ],
                    [
                        'name' => __t('employment_status'),
                        'icon' => 'user-check',
                        'url' => route('support.employee.employment-statuses',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
                        'permission' => authorize_any(['view_employment_statuses'])
                    ],
                ],
                'settings' => SettingParser::new(true)->getSettings(),
                'top_bar_menu' => [
                    [
                        'optionName' => __t('my_profile'),
                        'optionIcon' => 'user',
                        'url' => route('tenant.user.profile', optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name])
                    ],
                    [
                        'optionName' => __t('notifications'),
                        'optionIcon' => 'bell',
                        'url' => route("support.tenant.notifications", optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name])
                    ],
                    auth()->user()->can('view_settings') ?
                        [
                            'optionName' => __t('settings'),
                            'optionIcon' => 'settings',
                            'url' => authorize_any([
                                'view_settings',
                                'view_corn_job_settings',
                                'view_delivery_settings',
                                'view_notification_settings'
                            ]) ? route("support.tenant.settings", optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name]) : '#'
                        ] : [],
                    [
                        'optionName' => __t('log_out'),
                        'optionIcon' => 'log-out',
                        'url' => request()->root() . '/admin/log-out'
                    ],
                ],
                'logo' => $logo,
                'logo_icon' => $icon,
                'hasDefaultWorkShift' => Cache::get('has_default_work_shift')
            ]);
        } elseif (request()->segment(1) == 'leave') {
            $view->with([
                'permissions' => [
                    [
                        'name' => __t('main_menu'),
                        'icon' => 'home',
                        'url' => route('tenant.menu', optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name]),
                        'permission' => true,
                    ],
                    [
                        'name' => __t('dashboard'),
                        'icon' => 'pie-chart',
                        // 'url' => route('support.leave.dashboard',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
                        // 'permission' => true
                        'url' => route('support.leave.dashboard',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
                        'permission' => authorize_any(['view_leave_summaries'])
                    ],
                    [
                        'name' => __t('leave'),
                        'icon' => 'clock',
                        'id' => 'leave',
                        'permission' => LeavePermissions::new(true)->canVisit(),
                        'subMenu' => LeavePermissions::new(true)->permissions(),
                    ],
                ],
                'settings' => SettingParser::new(true)->getSettings(),
                'top_bar_menu' => [
                    [
                        'optionName' => __t('my_profile'),
                        'optionIcon' => 'user',
                        'url' => route('tenant.user.profile', optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name])
                    ],
                    [
                        'optionName' => __t('notifications'),
                        'optionIcon' => 'bell',
                        'url' => route("support.tenant.notifications", optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name])
                    ],
                    auth()->user()->can('view_settings') ?
                        [
                            'optionName' => __t('settings'),
                            'optionIcon' => 'settings',
                            'url' => authorize_any([
                                'view_settings',
                                'view_corn_job_settings',
                                'view_delivery_settings',
                                'view_notification_settings'
                            ]) ? route("support.tenant.settings", optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name]) : '#'
                        ] : [],
                    [
                        'optionName' => __t('log_out'),
                        'optionIcon' => 'log-out',
                        'url' => request()->root() . '/admin/log-out'
                    ],
                ],
                'logo' => $logo,
                'logo_icon' => $icon,
                'hasDefaultWorkShift' => Cache::get('has_default_work_shift')
            ]);
        } else {

            $view->with([
                'permissions' => [
                    [
                        'name' => __t('main_menu'),
                        'icon' => 'home',
                        'url' => route('tenant.menu', optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name]),
                        'permission' => true,
                    ],
                ],
                'settings' => SettingParser::new(true)->getSettings(),
                'top_bar_menu' => [
                    [
                        'optionName' => __t('my_profile'),
                        'optionIcon' => 'user',
                        'url' => route('tenant.user.profile', optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name])
                    ],
                    [
                        'optionName' => __t('notifications'),
                        'optionIcon' => 'bell',
                        'url' => route("support.tenant.notifications", optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name])
                    ],
                    auth()->user()->can('view_settings') ?
                        [
                            'optionName' => __t('settings'),
                            'optionIcon' => 'settings',
                            'url' => authorize_any([
                                'view_settings',
                                'view_corn_job_settings',
                                'view_delivery_settings',
                                'view_notification_settings'
                            ]) ? route("support.tenant.settings", optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name]) : '#'
                        ] : [],
                    [
                        'optionName' => __t('log_out'),
                        'optionIcon' => 'log-out',
                        'url' => request()->root() . '/admin/log-out'
                    ],
                ],
                'logo' => $logo,
                'logo_icon' => $icon,
                'hasDefaultWorkShift' => Cache::get('has_default_work_shift')
            ]);
        }
    }
}
