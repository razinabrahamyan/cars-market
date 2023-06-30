<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vin extends Model
{
    use HasFactory;

    protected $fillable = ["vin", "msrp", "brand", "model", "clear_model", "year", "options", "program_checked", "is_api"];

    protected $casts = [
        "options" => Json::class,
    ];
}
