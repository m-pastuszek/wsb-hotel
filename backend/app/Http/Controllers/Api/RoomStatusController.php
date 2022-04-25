<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomStatusResource;
use App\Models\RoomStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoomStatusController extends Controller
{
    /**
     * Zwraca wszystkie statusy pokoi.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return RoomStatusResource::collection(RoomStatus::paginate());
    }

    /**
     * Zwraca jeden status pokoju.
     * @param $id
     * @return RoomStatusResource
     */
    public function show($id): RoomStatusResource
    {
        return new RoomStatusResource(RoomStatus::findOrFail($id));
    }
}
