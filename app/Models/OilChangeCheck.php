<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class OilChangeCheck extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'current_odometer',
        'previous_oil_change_date',
        'previous_oil_change_odometer',
        'kilometres_since_last_change',
        'due_to_distance',
        'due_to_time',
        'is_due',
    ];

    protected function casts(): array
    {
        return [
            'current_odometer' => 'integer',
            'previous_oil_change_date' => 'date',
            'previous_oil_change odometer' => 'integer',
            'kilometres_since_last_change' => 'integer',
            'due_to_distance' => 'boolean',
            'is_due' => 'boolean',
        ];
    }
}
