<?php


namespace App\Http\Composer\Helper;


use App\Helpers\Core\Traits\InstanceCreator;

class TrainingPermissions
{
    use InstanceCreator;

    public function permissions()
    {
        return [
            [
                'name' => __t('training_institution'),
                'url' => route('support.trainings.training-institution',optional(tenant())->is_single ? '' : ['tenant_parameter' => tenant()->short_name ]),
                'permission' => authorize_any(['view_training_institution'])
            ],
        ];
    }

    public function canVisit()
    {
        return authorize_any([
            'view_training_dashboard',
            'view_training_institution'
        ]);
    }
}
