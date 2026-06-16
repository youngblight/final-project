<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        
    ];

    // Angalia kama huyu ni Admin
public function isAdmin() {
    return $this->role === 'admin';
}

// Angalia kama huyu ni Fundi
public function isCraftsman() {
    return $this->role === 'craftsmen';
}

  // Uhusiano na Profile ya Fundi
  public function craftsmanProfile() {
    return $this->hasOne(Craftsmen::class);
  } 
   // Hii inavuta kazi zote za huyu fundi ambazo zimeshapewa rating
   public function receivedRatings() {
    return $this->hasMany(JobRequest::class, 'craftsman_id')->whereNotNull('rating');
  }

   // Hii inapiga hesabu ya wastani wa nyota
   public function averageRating() {
    return $this->receivedRatings()->avg('rating') ?: 0;
   }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
