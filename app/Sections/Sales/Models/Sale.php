<?php

namespace App\Sections\Sales\Models;

use App\Sections\Leads\Models\Lead;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public $fillable = ['lead_id', 'total'];

    public $orderable = [];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
