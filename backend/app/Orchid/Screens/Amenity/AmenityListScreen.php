<?php

namespace App\Orchid\Screens\Amenity;

use App\Models\Amenity;
use App\Orchid\Layouts\AmenityListLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class AmenityListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Udogodnienia';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Lista dostępnych udogodnień, które są przypisywane do pokoi.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'amenities' => Amenity::filters()->defaultSort('id')->paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Dodaj nowe udogodnienie')
                ->icon('plus')
                ->route('platform.amenity.edit')
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            AmenityListLayout::class
        ];
    }
}
