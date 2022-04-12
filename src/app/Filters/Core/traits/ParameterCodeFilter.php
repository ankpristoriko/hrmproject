<?php


namespace App\Filters\Core\traits;


trait ParameterCodeFilter
{
    public function parameter_code($parameter_code = null)
    {
        $this->whereClause('parameter_code', "%{$parameter_code}%", "LIKE");
    }
}
