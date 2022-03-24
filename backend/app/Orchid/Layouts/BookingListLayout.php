<?php

namespace App\Orchid\Layouts;

use App\Models\Booking;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BookingListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'bookings';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->render(function (Booking $booking) {
                    return Link::make($booking->id)
                        ->route('platform.booking.edit', $booking);
                })->sort()->width('100px'),
            TD::make('time_from', 'Od')->sort(),
            TD::make('time_to', 'Do'),
            TD::make('amount', 'Koszt rezerwacji'),
            TD::make('created_at', 'Data dodania')->render(function ($booking) {
                return view('components.columns.date', ['date' => $booking->created_at]);
            })->sort(),
            TD::make('updated_at', 'Ostatnia aktualizacja')->render(function ($booking) {
                return view('components.columns.date-time', ['date' => $booking->updated_at]);
            })->sort(),
        ];
    }
}
