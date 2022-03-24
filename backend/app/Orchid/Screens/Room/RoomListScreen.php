<?php

namespace App\Orchid\Screens\Room;

use App\Models\Room;
use App\Orchid\Layouts\RoomListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class RoomListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Lista pokoi';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Lista wszystkich pokoi w hotelu.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'rooms' => Room::filters()->defaultSort('room_number')->paginate()
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
            Link::make('Dodaj nowy pokój')
                ->icon('plus')
                ->route('platform.room.edit')
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
            RoomListLayout::class
        ];
    }
}
