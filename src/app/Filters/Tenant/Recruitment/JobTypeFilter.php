<?php

namespace App\Filters\Tenant\Recruitment;

use App\Filters\Core\traits\NameFilter;
use App\Filters\Core\traits\SearchFilterTrait;
use App\Filters\FilterBuilder;
use App\Filters\Traits\DateRangeFilter;

class JobTypeFilter extends FilterBuilder
{
    use DateRangeFilter, NameFilter, SearchFilterTrait;
}
