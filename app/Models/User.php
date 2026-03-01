<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
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
        'is_admin',
        'reputation_score',
        'banned_at'
    ];

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

    protected static function booted()
    {
        static::creating(function ($user) {
            if (self::count() === 0) {
                $user->is_admin = 1;
            } else {
                $user->is_admin = 0;
            }
        });
    }

    public function ownedColocations()
    {
        return $this->hasMany(Colocation::class, 'owner_id');
    }

    public function colocations()
    {
        return $this->belongsToMany(Colocation::class)
            ->withPivot('status', 'token', 'role', 'left_at')
            ->withTimestamps();
    }

    public function expenses()
    {
        return $this->belongsToMany(Expense::class)
                    ->withPivot('share')
                    ->withTimestamps();
    }

}
