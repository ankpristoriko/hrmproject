<?php


namespace App\Http\Composer\Helper;


use App\Helpers\Core\Traits\InstanceCreator;

class CoreHrPermissions
{
    use InstanceCreator;

    public function permissions()
    {
        return [
            [
                'name' => __t('promotions'),
                'url' => $this->promotionUrl(),
                'permission' => authorize_any(['view_promotions'])
            ],
        ];
    }

    public function canVisit()
    {
        return authorize_any(['view_promotions']);
    }

    public function promotionUrl()
    {
        return route(
            'support.core_hr.promotions',
            optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]
        );
    }
}
