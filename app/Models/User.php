<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_role_id',
        'name',
        'email',
        'provider_id',
        'password',
        'status',
        'club',
        'isProfileUpdated',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userDetail() {
        return $this->hasOne(UserDetail::class);
    }

    public function userRole() {
        return $this->belongsTo(UserRole::class);
    }

    public function hashtags() {
        return $this->belongsToMany(Hashtag::class, 'user_hashtag')->withTimestamps();
    }

    public function courses() {
        return $this->belongsToMany(Course::class, 'user_course')
            ->withPivot(
                'status'
            )->withTimestamps();
    }

    public function assessments() {
        return $this->belongsToMany(Assessment::class, 'user_assessment')
            ->withPivot(
                'user_data', // nullable
                'status', // default -> pending
                'time_taken', // nullable
                'score' // nullable
            )->withTimestamps();
    }
    
    public function carts() {
        return $this->hasMany(Cart::class);
    }

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

    public function notifications() {
        return $this->hasMany(Notification::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function promotions() {
        return $this->hasMany(Promotion::class);
    }

    public function stars() {
        return $this->hasMany(Star::class);
    }
}
