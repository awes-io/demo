<?php

namespace App\Sections\Sales\Repositories;

use App\Sections\Sales\Models\Sale;
use AwesIO\Repository\Eloquent\BaseRepository;

class SaleRepository extends BaseRepository
{
    protected $searchable = [];

    public function entity()
    {
        return Sale::class;
    }
}
