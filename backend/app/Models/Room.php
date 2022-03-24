<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
     * Room - Status relationship
     * @return HasOne
     */
    public function status(): HasOne
    {
        return $this->hasOne(RoomStatus::class, 'id', 'room_status_id');
    }

    /**
     * Room - RoomType relationship
     * @return HasOne
     */
    public function type(): HasOne
    {
        return $this->hasOne(RoomType::class, 'id', 'room_type_id');
    }

    /**
     * Room - Status relationship
     * @return HasOne
     */
    public function bedType(): HasOne
    {
        return $this->hasOne(RoomBedType::class, 'id', 'bed_type_id');
    }
}
