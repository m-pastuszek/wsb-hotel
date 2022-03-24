<?php

namespace App\Orchid\Screens\RoomBedType;

use App\Models\RoomBedType;
use App\Orchid\Layouts\RoomBedTypeListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class RoomBedTypeListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Typy łóżek';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Typy łóżek, które są przypisywalne do pokoi.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'room_bed_types' => RoomBedType::filters()->defaultSort('id')->paginate()
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
            Link::make('Dodaj nową rezerwację')
                ->icon('plus')
                ->route('platform.room-bed-type.edit')
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
            RoomBedTypeListLayout::class
        ];
    }
}
