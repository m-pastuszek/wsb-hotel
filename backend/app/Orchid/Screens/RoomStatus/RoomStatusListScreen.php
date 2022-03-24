<?php

namespace App\Orchid\Screens\RoomStatus;

use App\Models\RoomStatus;
use App\Orchid\Layouts\RoomStatusListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class RoomStatusListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Statusy pokojów';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Lista statusów, które są przypisywane do pokoi.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'room_statuses' => RoomStatus::filters()->defaultSort('id')->paginate()
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
            Link::make('Dodaj nowy status')
                ->icon('plus')
                ->route('platform.room-status.edit')
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
            RoomStatusListLayout::class
        ];
    }
}
