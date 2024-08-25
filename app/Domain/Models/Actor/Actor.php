<?php

namespace App\Domain\Models\Actor;

use App\Domain\Models\Film\Film;
use Database\Factories\ActorFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Actor extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value),
        );
    }

    protected static function newFactory(): ActorFactory
    {
        return ActorFactory::new();
    }

    public function films(): BelongsToMany
    {
        return $this->belongsToMany(Film::class, 'actor_film', 'actor_id', 'film_id');
    }
}
