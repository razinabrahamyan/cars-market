<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['residual_values', 'money_factor', 'default_money_factor', 'min_mile_residual_value'];

    protected $casts = [
        'residual_values' => 'array',
        'money_factor'    => 'array',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
