<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Http\Resources\RoomResource;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomBedType;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookingController extends Controller
{
    /**
     * Zwraca wszystkie rezerwacje.
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return BookingResource::collection(Booking::paginate());
    }

    /**
     * Zwraca wybraną rezerwację.
     * @param $id
     * @return BookingResource
     */
    public function show($id): BookingResource
    {
        return new BookingResource(Booking::findOrFail($id));
    }

    /**
     * Zwraca dostępne pokoje według filtrowanych danych.
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function availableRooms(Request $request)
    {
        try {
            $query = RoomType::query(); // rozpoczęcie filtrowania

            if ($request->has('occupancy'))
                $query->where('max_occupancy', '>=', $request->occupancy)->get();

            if ($request->has('room_type'))
                $query->where('name', $request->room_type)->get();

            $roomTypes = $query->get();
            $availableRoomsIds = array(); // tablica pod wolne pokoje

            foreach ($roomTypes as $roomType) {

                foreach ($roomType->rooms as $room) {

                    if ($request->has('bed_type')) {
                        $bedType = RoomBedType::where('name', $request->bed_type)->first();
                        /*
                         * Zwróć null, jeśli wszystko różne od "pokój ma ten typ łóżka".
                         * W przypadku, jeśli pokój ma ten typ łóżka, kod przechodzi do następnego ifa.
                         */
                        if (!$room->bed_type_id == $bedType->id)
                            $room = null;
                    }

                    if ($request->has(['start_date', 'end_date'])) {

                        // Jeśli pokój jest zarezerwowany, nie wrzuca go do tablicy.
                        if ($room->isBooked($request->start_date, $request->end_date)) {
                            $room = null;
                        } /*else {
                            // TODO: Kalkulacja ceny w zależności od ilości dni na backendzie?
                            $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date);
                            $end_date = Carbon::createFromFormat('Y-m-d', $request->end_date);

                            $daysRequested = $end_date->diffInDays($start_date);

                            $CENA_ZA_REZERWACJE = $room->price_per_night * $daysRequested;
                        }*/
                    }

                    // Jeżeli pokój nie jest null i nie jest wyłączony z użytkowania, dodaj ID do tablicy.
                    if ($room && $room->isOperatable())
                        $availableRoomsIds[] = $room->id;
                }
            }

            return RoomResource::collection(Room::whereIn('id', $availableRoomsIds)->paginate());
        } catch (\Exception $e) {
            return response()->json(null, 400);
        }
    }
}
