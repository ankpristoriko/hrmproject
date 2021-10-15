<?php

namespace App\Http\Requests\Tenant\CoreHR;

use App\Models\Tenant\CoreHR\Promotion;

class PromotionRequest extends CoreHRRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \App\Exceptions\GeneralException
     */
    public function rules()
    {
        return $this->initRules(new Promotion());
    }
}
