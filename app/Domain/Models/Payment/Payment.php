<?php

namespace App\Domain\Models\Payment;

use App\Domain\Models\Payment\Enum\PaymentStatusEnum;
use App\Domain\Models\Ticket\Ticket;
use App\Domain\Models\User\User;
use Database\Factories\PaymentFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property int $ticket_id
 * @property PaymentStatusEnum $status
 * @property string $amount
 */
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'status',
        'amount'
    ];

    protected $casts = [
        'status' => PaymentStatusEnum::class
    ];

    protected static function booted(): void
    {
        static::creating(function ($payment) {
            $payment->uuid = Str::uuid();
        });
    }

    protected static function newFactory(): PaymentFactory
    {
        return PaymentFactory::new();
    }

    public function amount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: function($value) {
                if (is_numeric($value)) {
                    return $value;
                } else {
                    throw new \Exception('Amount must be numeric');
                }
            }
        );
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
