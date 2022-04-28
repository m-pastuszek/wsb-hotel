<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingStatusResource;
use App\Models\BookingStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookingStatusController extends Controller
{
    /**
     * Zwraca wszystkie statusy rezerwacji.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return BookingStatusResource::collection(BookingStatus::paginate());
    }

    /**
     * Zwraca wybrany status rezerwacji.
     * @param $id
     * @return BookingStatusResource
     */
    public function show($id): BookingStatusResource
    {
        return new BookingStatusResource(BookingStatus::findOrFail($id));
    }
}
