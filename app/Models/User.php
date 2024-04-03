<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fk_role_id',
        'name',
        'email',
        'password',
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

    // * Relations
    public function products()
    {
        return $this->hasMany(Product::class, "fk_user_id");
    }

    public function purchases()
    {
        return $this->hasMany(ProductSale::class, "fk_user_id");
    }

    public function reports()
    {
        return $this->hasMany(SaleReport::class, "fk_user_id");
    }

    // * Methods 
    public function isAdmin()
    {
        return $this->fk_role_id === Role::ADMIN;
    }
}
