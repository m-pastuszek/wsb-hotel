<?php

namespace App\Orchid\Layouts;

use App\Models\Room;
use App\View\Components\Rooms\Floor;
use Carbon\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class RoomListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'rooms';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('room_number', 'Numer pokoju')
                ->render(function (Room $room) {
                    return Link::make($room->room_number)
                        ->route('platform.room.edit', $room);
                })->sort()->width('100px'),
            TD::make('floor', 'Piętro')->component(Floor::class),
            TD::make('room_type_id', 'Typ pokoju')->render(function ($room) {
               return $room->type->name;
            }),
            TD::make('bed_type_id', 'Rodzaj łóżek')->render(function ($room) {
                return $room->bedType->name;
            }),
            TD::make('room_status_id', "Status pokoju")->render(function ($room) {
                return $room->status->name;
            }),
            TD::make('price_per_night', 'Cena za noc')->render(function ($room) {
                return $room->price_per_night . ' zł';
            }),
            TD::make('updated_at', 'Ostatnia aktualizacja')->render(function ($room) {
                return view('components.columns.date-time', ['datetime' => $room->updated_at]);
            })->sort(),
        ];
    }
}
