<?php

namespace App\Orchid\Screens\Customer;

use App\Orchid\Layouts\CustomerListLayout;
use App\Models\Customer;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

class CustomerListScreen extends Screen
{

    // TODO: Uzupełnić - P
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Lista klientów';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Lista wszystkich klientów hotelu.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'customers' => Customer::paginate(),
        ];
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Dodaj nowego klienta')
                ->icon('plus')
                ->route('platform.customer.edit')
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            CustomerListLayout::class
        ];
    }
}
