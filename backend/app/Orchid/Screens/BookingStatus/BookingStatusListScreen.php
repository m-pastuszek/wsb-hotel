<?php

namespace App\Orchid\Screens\BookingStatus;

use App\Models\BookingStatus;
use App\Orchid\Layouts\BookingStatusListLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class BookingStatusListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Statusy rezerwacji';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'booking_statuses' => BookingStatus::filters()->defaultSort('id')->paginate()
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
            Link::make('Dodaj nowy status')
                ->icon('plus')
                ->route('platform.booking-status.edit')
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
            BookingStatusListLayout::class
        ];
    }
}
