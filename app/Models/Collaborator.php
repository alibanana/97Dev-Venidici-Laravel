<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'institution',
        'institution_socmed',
        'collaborator_partnership',
        'email',
        'whatsapp',
        'notes'
    ];
}
