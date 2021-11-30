<?php

namespace App\Http\Composer;

use App\Helpers\Settings\SettingParser;
use App\Http\Composer\Helper\LogoIcon;
use Illuminate\Support\Facades\Cache;
use App\Http\Composer\Helper\LeavePermissions;
use App\Http\Composer\Helper\EmployeePermissions;
use App\Http\Composer\Helper\AttendancePermissions;
use App\Http\Composer\Helper\PayrollPermissions;
use App\Http\Composer\Helper\AdministrationPermissions;
use App\Http\Composer\Helper\SettingPermissions;
use Illuminate\View\View;

class TenantMainMenuComposer
{
    public function compose(View $view)
    {
        ['logo' => $logo, 'icon' => $icon] = LogoIcon::new(true)
            ->logoIcon();

        if(request()->segment(1) == 'employee' || request()->segment(1) == 'employees') {
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
                        'name' => __t('job_desk'),
                        'icon' => 'user',
                        'url' => EmployeePermissions::new(true)->profile(),
                        'permission' => true,
    
                    ],
                    EmployeePermissions::new(true)->canVisit() ?
                    [
                        'name' => __t('employee'),
                        'icon' => 'users',
                        'id' => 'employee',
                        'permission' => EmployeePermissions::new(true)->canVisit(),
                        'subMenu' => EmployeePermissions::new(true)->permissions(),
                    ] : [],
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
        } elseif (request()->segment(1) == 'attendance' || request()->segment(1) == 'attendances') {
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
                        'url' => route('support.attendances.dashboard',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
                        'permission' => authorize_any(['view_attendance_summary'])
                    ],
                    [
                        'name' => __t('attendance'),
                        'icon' => 'calendar',
                        'id' => 'attendance',
                        'permission' => AttendancePermissions::new(true)->canVisit(),
                        'subMenu' => AttendancePermissions::new(true)->permissions(),
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
        } elseif (request()->segment(1) == 'payroll') {
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
                        'url' => route('support.payroll.dashboard',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
                        'permission' => authorize_any(['view_payroll_summery'])
                    ],
                    [
                        'name' => __t('payroll'),
                        'icon' => 'credit-card',
                        'id' => 'payroll',
                        'permission' => PayrollPermissions::new(true)->canVisit(),
                        'subMenu' => PayrollPermissions::new(true)->permissions(),
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
        } elseif (request()->segment(1) == 'administration') {
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
                        'url' => route('support.administration.dashboard',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
                        'permission' => true
                    ],
                    AdministrationPermissions::new(true)->canVisit() ?
                    [
                        'name' => __t('administration'),
                        'icon' => 'briefcase',
                        'id' => 'administration',
                        'permission' => AdministrationPermissions::new(true)->canVisit(),
                        'subMenu' => AdministrationPermissions::new(true)->permissions()
                    ] :
                    [
                        'name' => __t('holiday'),
                        'icon' => 'calendar',
                        'url' => AdministrationPermissions::new(true)->holidayUrl(),
                        'permission' => authorize_any(['view_holidays'])
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
        } elseif (request()->segment(1) == 'settings' || request()->segment(1) == 'app') {
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
                        'url' => route('support.settings.dashboard',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
                        'permission' => true
                    ],
                    [
                        'name' => __t('settings'),
                        'id' => 'settings',
                        'icon' => 'settings',
                        'subMenu' => SettingPermissions::new(true)->permissions(),
                        'permission' => SettingPermissions::new(true)->canVisit()
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
