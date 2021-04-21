<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrustedCompany extends Model
{
    use HasFactory;

    protected $table = 'trusted_companies';

    protected $fillable = [
        'company',
        'image'
    ];
}
