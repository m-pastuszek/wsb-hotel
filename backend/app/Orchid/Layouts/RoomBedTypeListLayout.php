<?php

namespace App\Orchid\Layouts;

use App\Models\RoomBedType;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class RoomBedTypeListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'room_bed_types';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->render(function (RoomBedType $roomBedType) {
                    return Link::make($roomBedType->id)
                        ->route('platform.room-bed-type.edit', $roomBedType);
                })->sort()->width('100px'),
            TD::make('name', 'Nazwa')->sort(),
            TD::make('description', 'Opis'),
            TD::make('created_at', 'Data dodania')->render(function ($roomBedType) {
                return view('components.columns.date-time', ['datetime' => $roomBedType->created_at]);
            })->sort(),
            TD::make('updated_at', 'Ostatnia aktualizacja')->render(function ($roomBedType) {
                return view('components.columns.date-time', ['datetime' => $roomBedType->updated_at]);
            })->sort(),
        ];
    }
}
