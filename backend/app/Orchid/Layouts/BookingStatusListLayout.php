<?php

namespace App\Orchid\Layouts;

use App\Models\BookingStatus;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BookingStatusListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'booking_statuses';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->render(function (BookingStatus $bookingStatus) {
                    return Link::make($bookingStatus->id)
                        ->route('platform.booking-status.edit', $bookingStatus);
                })->sort()->width('100px'),
            TD::make('name', 'Nazwa')->sort(),
            TD::make('description', 'Opis'),
            TD::make('icon', 'Ikona'),
            TD::make('created_at', 'Data dodania')->render(function ($bookingStatus) {
                return view('components.columns.date-time', ['datetime' => $bookingStatus->created_at]);
            })->sort(),
            TD::make('updated_at', 'Ostatnia aktualizacja')->render(function ($bookingStatus) {
                return view('components.columns.date-time', ['datetime' => $bookingStatus->updated_at]);
            })->sort(),
        ];
    }
}
