<?php

namespace App\Filters\Tenant\Payroll;

use App\Filters\Core\traits\ParameterCodeFilter;
use App\Filters\Core\traits\SearchParameterFilterTrait;
use App\Filters\FilterBuilder;
use App\Filters\Traits\DateRangeFilter;

class BpjsParameterFilter extends FilterBuilder
{
    use DateRangeFilter, ParameterCodeFilter, SearchParameterFilterTrait;
}
