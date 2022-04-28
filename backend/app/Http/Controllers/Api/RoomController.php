<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Meal;
use App\Models\Room;
use App\Models\RoomBedType;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoomController extends Controller
{

    /**
     * Zwraca wszystkie pokoje.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return RoomResource::collection(Room::paginate());
    }

    /**
     * Zwraca jeden pokój po ID.
     * Jeśli nie znajdzie, zwraca 404.
     * @param $id
     * @return RoomResource
     */
    public function show($id): RoomResource
    {
        return new RoomResource(Room::findOrFail($id));
    }

}
