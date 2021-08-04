<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_id', 'city_id', 'name'
    ];
    
    public function user() {
        return $this->hasMany(User::class, 'city_id', 'city_id');
    }

    public function bootcampApplications() {
        return $this->hasMany(BootcampApplication::class, 'city_id', 'city_id');
    }
}
