<?php

namespace App\Orchid\Screens\Booking;

use App\Models\Booking;
use App\Orchid\Layouts\BookingListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class BookingListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Rezerwacje';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Lista rezerwacji hotelowych';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'bookings' => Booking::filters()->defaultSort('id')->paginate()
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
                ->route('platform.booking.edit')
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
            BookingListLayout::class
        ];
    }
}
