<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebCrawler extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'priority', 'brands', 'regexp', 'created_at', 'updated_at'];

    protected $casts = [
        'brands'       => Json::class,
        'regexp' => Json::class,
    ];
}
