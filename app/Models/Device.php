<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand',
        'model',
        'description',
        'status',
        'expected_price',
        'images'
    ];
    public function images()
    {
        return $this->hasMany(DeviceImage::class);
    }
}
