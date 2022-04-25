<?php

namespace App\Orchid\Screens\Meal;

use App\Models\Meal;
use App\Orchid\Layouts\MealListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class MealListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Wyżywienia';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Typy wyżywienia dostępne do wykupienia w hotelu.';


    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'meals' => Meal::filters()->defaultSort('id')->paginate()
        ];

    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Dodaj nowe wyżywienie')
                ->icon('plus')
                ->route('platform.meal.edit')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            MealListLayout::class
        ];
    }
}
