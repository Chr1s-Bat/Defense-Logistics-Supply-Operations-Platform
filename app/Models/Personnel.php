<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model {
    protected $table = 'personnel';

    protected $fillable = [
        'user_id',
        'rank',
        'unit_code',
        'clearance_level'
    ];

    // Belongs to a User account[cite: 4, 10]
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Has many Operations[cite: 4, 10]
    public function operations() {
        return $this->hasMany(Operation::class);
    }
}
