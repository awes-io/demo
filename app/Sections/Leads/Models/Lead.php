<?php

namespace App\Sections\Leads\Models;

use App\Sections\Sales\Models\Sale;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    public $fillable = ['name', 'email', 'phone'];

    public $orderable = ['created_at', 'name', 'sales_count'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
