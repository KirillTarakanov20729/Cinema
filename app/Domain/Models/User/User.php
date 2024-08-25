<?php

namespace App\Domain\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $name,
 * @property string $email,
 * @property string $password
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function email(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: function($value) {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception('Invalid email address');
                }
                return strtolower($value);
            },
        );
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
