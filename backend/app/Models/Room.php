<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Room extends Model
{
    use HasFactory, AsSource, Attachable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_number',
        'floor',
        'description',
        'images',
        'price_per_night',
        'room_type_id',
        'bed_type_id',
        'room_status_id'
    ];

    /**
     * Name of columns to which http sorting can be applied
     *
     * @var array
     */
    protected $allowedSorts = [
        'room_number',
        'created_at',
        'updated_at'
    ];


    /**
     * Sprawdzenie, czy pokój jest zarezerwowany w podanych dniach.
     * @param $start_date
     * @param $end_date
     * @return bool
     */
    public function isBooked($start_date, $end_date): bool
    {
        $booking = Booking::where('room_id', $this->id)
                        ->whereBetween('time_from', [$start_date, $end_date])
                        ->orWhereBetween('time_to', [$start_date, $end_date])
                        ->get();

        // Jeśli jest zwracany element ($booking nie jest "pusty")
        if($booking->isNotEmpty()) {
            return true;
        } else
            return false;
    }

    /**
     * Sprawdzenie, czy pokój jest wyłączony z użytkowania.
     * Jeśli pokój jest wyłączony z użytkowania, zwraca false.
     * @return bool
     */
    public function isOperatable(): bool
    {
        if ($this->status->id == 4)
            return false;
        else
            return true;
    }

    /**
     * Room - Status relationship
     * @return HasOne
     */
    public function status(): HasOne
    {
        return $this->hasOne(RoomStatus::class, 'id', 'room_status_id');
    }

    /**
     * Room - RoomType relationship
     * @return BelongsTo
     */
    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    /**
     * Room - Status relationship
     * @return HasOne
     */
    public function bedType(): HasOne
    {
        return $this->hasOne(RoomBedType::class, 'id', 'bed_type_id');
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
