<?php

namespace App\Orchid\Layouts;

use App\Models\Meal;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MealListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'meals';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->render(function (Meal $meal) {
                    return Link::make($meal->id)
                        ->route('platform.meal.edit', $meal);
                })->sort()->width('100px'),
            TD::make('name', 'Nazwa')->sort(),
            TD::make('description', 'Opis'),
            TD::make('cost', 'Koszt')->render(function ($meal) {
                return $meal->cost . ' zł';
            }),
        ];
    }
}
