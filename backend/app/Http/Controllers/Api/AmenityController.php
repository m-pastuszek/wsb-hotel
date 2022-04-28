<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AmenityResource;
use App\Models\Amenity;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection as AnonymousResourceCollectionAlias;

class AmenityController extends Controller
{
    /**
     * Zwraca wszystkie udogodnienia.
     * @return AnonymousResourceCollectionAlias
     */
    public function index(): AnonymousResourceCollectionAlias
    {
        return AmenityResource::collection(Amenity::paginate());
    }

    /**
     * Zwraca wybrane udogodnienie.
     * @param $id
     * @return AmenityResource
     */
    public function show($id): AmenityResource
    {
        return new AmenityResource(Amenity::findOrFail($id));
    }
}
