<?php

namespace App\Sections\Analytics\Scopes;

use AwesIO\Repository\Scopes\ScopeAbstract;

class PeriodScope extends ScopeAbstract
{
    public function scope($builder, $value, $scope)
    {
        return $builder->whereDate('created_at', '>', now()->subDays($value));
    }
}