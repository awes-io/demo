<?php

namespace App\Sections\Leads\Repositories;

use App\Sections\Leads\Models\Lead;
use AwesIO\Repository\Eloquent\BaseRepository;

class LeadRepository extends BaseRepository
{
    protected $searchable = [
        'name' => 'like',
        'is_premium',
    ];

    public function entity()
    {
        return Lead::class;
    }
}
