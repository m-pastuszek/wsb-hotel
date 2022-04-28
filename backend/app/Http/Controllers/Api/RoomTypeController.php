<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomTypeResource;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoomTypeController extends Controller
{
    /**
     * Zwraca wszystkie typy pokoi.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return RoomTypeResource::collection(RoomType::paginate());
    }

    /**
     * Zwraca jeden typ pokoju po ID.
     * @param $id
     * @return RoomTypeResource
     */
    public function show($id): RoomTypeResource
    {
        return new RoomTypeResource(RoomType::findOrFail($id));
    }
}
