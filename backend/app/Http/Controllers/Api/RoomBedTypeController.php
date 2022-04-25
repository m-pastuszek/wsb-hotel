<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomBedTypeResource;
use App\Models\RoomBedType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoomBedTypeController extends Controller
{
    /**
     * Zwraca wszystkie typy łóżek.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return RoomBedTypeResource::collection(RoomBedType::paginate());
    }

    /**
     * Zwraca jeden typ pokoju po ID.
     * @param $id
     * @return RoomBedTypeResource
     */
    public function show($id): RoomBedTypeResource
    {
        return new RoomBedTypeResource(RoomBedType::findOrFail($id));
    }
}
