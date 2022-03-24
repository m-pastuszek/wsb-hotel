<?php

namespace App\Orchid\Layouts;

use App\Models\RoomStatus;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class RoomStatusListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'room_statuses';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->render(function (RoomStatus $roomStatus) {
                    return Link::make($roomStatus->id)
                        ->route('platform.room-type.edit', $roomStatus);
                })->sort()->width('100px'),
            TD::make('name', 'Nazwa')->sort(),
            TD::make('description', 'Opis'),
            TD::make('color', 'Kolor'),
            TD::make('created_at', 'Data dodania')->render(function ($roomStatus) {
                return view('components.columns.date-time', ['datetime' => $roomStatus->created_at]);
            })->sort(),
            TD::make('updated_at', 'Ostatnia aktualizacja')->render(function ($roomStatus) {
                return view('components.columns.date-time', ['datetime' => $roomStatus->updated_at]);
            })->sort(),
        ];
    }
}
