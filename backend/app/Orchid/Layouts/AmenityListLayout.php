<?php

namespace App\Orchid\Layouts;

use App\Models\Amenity;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AmenityListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'amenities';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->render(function (Amenity $amenity) {
                    return Link::make($amenity->id)
                        ->route('platform.amenity.edit', $amenity);
                })->sort()->width('100px'),
            TD::make('name', 'Nazwa')->sort(),
            TD::make('description', 'Opis'),
            TD::make('icon', 'Ikona'),
            TD::make('created_at', 'Data dodania')->render(function ($amenity) {
                return view('components.columns.date-time', ['datetime' => $amenity->created_at]);
            })->sort(),
            TD::make('updated_at', 'Ostatnia aktualizacja')->render(function ($amenity) {
                return view('components.columns.date-time', ['datetime' => $amenity->updated_at]);
            })->sort(),
            TD::make(__('Akcje'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Amenity $amenity) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edytuj'))
                                ->route('platform.amenity.edit', $amenity->id)
                                ->icon('pencil'),


                            Button::make(__('Usuń'))
                                ->icon('trash')
                                ->confirm(__('Czy na pewno chcesz usunąć to udogodnienie?'))
                                ->method('remove', [
                                    'id' => $amenity->id,
                                ]),
                        ]);
                }),
        ];
    }
}
