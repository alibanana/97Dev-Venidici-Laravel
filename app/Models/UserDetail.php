<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_details';

    protected $fillable = [
        'telephone',
        'refferal_code',
        'birthdate',
        'gender',
        'address',
        'company',
        'occupancy',
        'interest',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    public function Users() {
        return $this->hasOne(User::class);
    }
}
