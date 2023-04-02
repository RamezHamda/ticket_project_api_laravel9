<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $appends = ['user_type'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_code',
        'status',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    const TYPE = [
        'ADMIN' => 'admin',
        'AGENT' => 'agent',
        'USER' => 'user',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function catalogs(): BelongsToMany
    {
        return $this->belongsToMany(Catalog::class, 'pool');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function Atickets(): HasMany // agent take this tickets
    {
        return $this->hasMany(Ticket::class, 'agent_id');
    }

    public function fwthraads(): HasMany // agent fw ticket to another agent in thread table
    {
        return $this->hasMany(Thread::class, 'fw_user_id');
    }

    public function getUserTypeAttribute()
    {
        if ($this->type == 0){
            return 'Admin';
        }elseif ($this->type == 1){
            return 'Agent';
        }else{
            return 'User';
        }
    }

    public function password(): Attribute
    {
        return new Attribute(
            set: fn ($value) => bcrypt($value),
        );
    }

    // public function status()
    // {
    //     return $this->status == 0 ? 'inActive' : 'active';
    // }

    public function status(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value == 0 ? 'inActive' : 'active',
        );
    }
}
