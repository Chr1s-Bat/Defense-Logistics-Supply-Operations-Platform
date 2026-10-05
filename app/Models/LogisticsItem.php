<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogisticsItem extends Model {
    protected $table = 'logistics_items';

    protected $fillable = [
        'name',
        'category',
        'stock_quantity',
        'unit_cost'
    ];

    // Has many Operations[cite: 4, 10]
    public function operations() {
        return $this->hasMany(Operation::class, 'logistics_item_id');
    }
}
