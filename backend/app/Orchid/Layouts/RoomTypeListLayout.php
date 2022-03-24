<?php

namespace App\Orchid\Layouts;

use App\Models\RoomType;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class RoomTypeListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'room_types';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->render(function (RoomType $roomType) {
                    return Link::make($roomType->id)
                        ->route('platform.room-type.edit', $roomType);
                })->sort()->width('100px'),
            TD::make('name', 'Nazwa')->sort(),
            TD::make('description', 'Opis'),
            TD::make('created_at', 'Data dodania')->render(function ($roomType) {
                return view('components.columns.date-time', ['datetime' => $roomType->created_at]);
            })->sort(),
            TD::make('updated_at', 'Ostatnia aktualizacja')->render(function ($roomType) {
                return view('components.columns.date-time', ['datetime' => $roomType->updated_at]);
            })->sort(),
        ];
    }
}
