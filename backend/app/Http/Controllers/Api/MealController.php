<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MealResource;
use App\Models\Meal;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MealController extends Controller
{
    /**
     * Zwraca wszystkie wyżywienia.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return MealResource::collection(Meal::paginate());
    }

    /**
     * Zwraca jeden typ wyżywienia.
     * @param $id
     * @return MealResource
     */
    public function show($id): MealResource
    {
        return new MealResource(Meal::findOrFail($id));
    }
}
