<?php


namespace App\Filters\Core\traits;


trait SearchParameterFilterTrait
{
    public function search($search = null)
    {
        $this->parameter_code($search);
    }
}
