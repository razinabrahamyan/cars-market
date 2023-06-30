<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Wmi extends Model
{
    use HasFactory;

    protected $fillable = ['wmi', 'brand_id', 'country', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function brand() : HasOne
    {
        return $this->hasOne(Brand::class, 'id','brand_id');
    }
}
