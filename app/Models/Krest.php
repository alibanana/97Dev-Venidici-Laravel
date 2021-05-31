<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'telephone',
        'company',
        'program_id',
        'subject',
        'message'
    ];

    public function krestProgram() {
        return $this->hasOne(KrestProgram::class);
    }
}
