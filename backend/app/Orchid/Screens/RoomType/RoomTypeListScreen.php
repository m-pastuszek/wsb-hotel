<?php

namespace App\Orchid\Screens\RoomType;

use App\Models\RoomType;
use App\Orchid\Layouts\RoomTypeListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class RoomTypeListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Typy pokoi';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Typy pokoi hotelowych.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'room_types' => RoomType::filters()->defaultSort('id')->paginate()
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
            Link::make('Dodaj nowy typ')
                ->icon('plus')
                ->route('platform.room-type.edit')
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
            RoomTypeListLayout::class
        ];
    }
}
