<?php

namespace App\Sections\Leads\Repositories;

use App\Sections\Leads\Models\Lead;
use AwesIO\Repository\Eloquent\BaseRepository;
use App\Sections\Analytics\Scopes\StatisticScopes;

class LeadRepository extends BaseRepository
{
    protected $searchable = [
        'name' => 'like',
        'email' => 'like',
        'phone' => 'like',
        'is_premium',
    ];

    public function entity()
    {
        return Lead::class;
    }

    public function scope($request)
    {
        // apply build-in scopes
        parent::scope($request);

        // apply custom scopes
        $this->entity = (new StatisticScopes($request))->scope($this->entity);

        return $this;
    }

}
