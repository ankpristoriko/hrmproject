<?php

namespace App\Filters\Tenant\Payroll;

use App\Filters\FilterBuilder;
use App\Filters\Traits\DateRangeFilter;

class SeverancePayTaxBracketFilter extends FilterBuilder
{
    use DateRangeFilter;
}
