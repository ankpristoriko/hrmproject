<?php

namespace App\Filters\Tenant;

use App\Filters\FilterBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PromotionFilter extends FilterBuilder
{
    public function search($search = null)
    {
        $this->singleSearch($search, 'promotion_title');
    }

    public function filterByCompany($search = null)
    {
        if ($search) {
            $this->whereInClause('company_id', array_values(explode(',', $search)));
        }
    }

    public function searchSelectEmployee($search = null)
    {
        $this->singleSearch($search, 'employee_id');
    }

    public function date($date = null)
    {
        $date = json_decode(htmlspecialchars_decode($date), true);
        $this->builder->when($date, function (Builder $builder) use ($date){
            $builder->whereBetween(DB::raw('DATE(promotion_date)'), array_values($date));
        });
    }
}
