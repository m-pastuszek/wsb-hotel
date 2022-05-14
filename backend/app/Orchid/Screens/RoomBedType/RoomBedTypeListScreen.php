<?php

namespace App\Orchid\Screens\RoomBedType;

use App\Models\RoomBedType;
use App\Orchid\Layouts\RoomBedTypeListLayout;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::user()->hasAccess('platform.systems.management')) return [
            Link::make('Dodaj nowy typ łóżka')
                ->icon('plus')
                ->route('platform.room-bed-type.edit')
        ];
        else return [];
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
