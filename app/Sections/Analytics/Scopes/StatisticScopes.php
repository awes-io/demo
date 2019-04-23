<?php

namespace App\Sections\Analytics\Scopes;

use AwesIO\Repository\Scopes\ScopesAbstract;

class StatisticScopes extends ScopesAbstract
{
    protected $scopes = [
        'period' => PeriodScope::class,
    ];
}