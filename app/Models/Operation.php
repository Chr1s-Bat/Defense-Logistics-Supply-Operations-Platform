<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model {
    protected $table = 'operations';

    protected $fillable = [
        'operation_code',
        'personnel_id',
        'logistics_item_id',
        'quantity_allocated',
        'status',
        'mission_notes'
    ];

    // Belongs to Personnel[cite: 4, 10]
    public function personnel() {
        return $this->belongsTo(Personnel::class);
    }

    // Belongs to a Logistics Item[cite: 4, 10]
    public function item() {
        return $this->belongsTo(LogisticsItem::class, 'logistics_item_id');
    }
}
