<?php

namespace App\Domain\Models\Ticket;

use App\Domain\Models\Film\Film;
use App\Domain\Models\Ticket\Enum\TicketStatusEnum;
use Database\Factories\TicketFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $uuid,
 * @property string $price,
 * @property string $seat,
 * @property string $status,
 * @property int $film_id
 */
class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'seat',
        'status',
        'film_id'
    ];

    protected $casts = [
        'status' => TicketStatusEnum::class
    ];

    protected static function booted(): void
    {
        static::creating(function ($ticket) {
            $ticket->uuid = Str::uuid();
        });
    }


    public function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: function($value) {
                if (is_numeric($value)) {
                    return $value;
                } else {
                    throw new \Exception('Price must be numeric');
                }
            }
        );
    }

    public function seat(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: function($value) {
                if (preg_match('/^[A-Z]\d+$/', $value)) {
                    return $value;
                } else {
                    throw new \Exception('Invalid seat format. It should be in the format A2, B22, C16, etc.');
                }
            }
        );
    }
    protected static function newFactory(): TicketFactory
    {
        return TicketFactory::new();
    }

    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class);
    }
}
