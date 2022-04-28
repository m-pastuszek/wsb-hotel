<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CustomerListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'customers';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('full_name', 'Imię i nazwisko')->render(function($customer) {
                return Link::make($customer->first_name . ' ' . $customer->last_name)
                    ->route('platform.customer.edit', $customer);
            })->sort(),
            TD::make('address', 'Adres'),
            TD::make('phone', 'Numer telefonu'),
            TD::make('email', 'Adres e-mail'),
            TD::make('created_at', 'Data dodania')->render(function ($booking) {
                return view('components.columns.date-time', ['datetime' => $booking->created_at]);
            })->sort()
        ];
    }
}
