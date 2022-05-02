<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Http\Resources\RoomResource;
use App\Models\Amenity;
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
                         * Jeśli pokój ma ten sam typ łóżka, co w zapytaniu zostawia go w tablicy.
                         * Jeśli ma inny, przechodzi do następnego elementu pętli foreach.
                         */
                        if ($room->bed_type_id === $bedType->id)
                            $room = $room;
                        else
                            continue;
                    }

                    if ($request->has(['start_date', 'end_date'])) {

                        // Jeśli pokój jest zarezerwowany, nie wrzuca go do tablicy.
                        if ($room->isBooked($request->start_date, $request->end_date)) {
                            continue;
                        } /*else {
                            // TODO: Kalkulacja ceny w zależności od ilości dni na backendzie?
                            $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date);
                            $end_date = Carbon::createFromFormat('Y-m-d', $request->end_date);

                            $daysRequested = $end_date->diffInDays($start_date);

                            $CENA_ZA_REZERWACJE = $room->price_per_night * $daysRequested;
                        }*/
                    }

                    // Jeśli zaznaczono "Widok na morze"
                    if ($request->has('sea_view') and $request->get('sea_view') == true) {
                        $amenity = Amenity::find(1);
                        if ($room->amenities()->where('amenity_id', $amenity->id)->exists())
                            $room = $room;
                        else
                            continue;
                    }

                    // Jeśli zaznaczono "Balkon"
                    if ($request->has('balcony') and $request->get('balcony') == true) {
                        $amenity = Amenity::find(2);
                        if ($room->amenities()->where('amenity_id', $amenity->id)->exists())
                            $room = $room;
                        else
                            continue;
                    }

                    // Jeśli zaznaczono "Taras"
                    if ($request->has('terrace') and $request->get('terrace') == true) {
                        $amenity = Amenity::find(3);
                        if ($room->amenities()->where('amenity_id', $amenity->id)->exists())
                            $room = $room;
                        else
                            continue;
                    }

                    // Jeśli zaznaczono "Klimatyzacja"
                    if ($request->has('air_conditioning') and $request->get('air_conditioning') == true) {
                        $amenity = Amenity::find(4);
                        if ($room->amenities()->where('amenity_id', $amenity->id)->exists())
                            $room = $room;
                        else
                            continue;
                    }

                    // Jeśli zaznaczono "Przystosowany dla niepełnosprawnych"
                    if ($request->has('adapted_for_disabled') and $request->get('adapted_for_disabled') == true) {
                        $amenity = Amenity::find(5);
                        if ($room->amenities()->where('amenity_id', $amenity->id)->exists())
                            $room = $room;
                        else
                            continue;
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
