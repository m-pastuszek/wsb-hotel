<?php

namespace App\Orchid\Screens\Customer;

use App\Models\Customer;
use Cassandra\Custom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CustomerEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name;

    /**
     * Display header description.
     */
    public $description;

    /**
     * Query data.
     *
     * @param Customer $customer
     *
     * @return array
     */
    public function query(Customer $customer): array
    {
        $this->exists = $customer->exists;

        if($this->exists){
            $this->name = "Edycja klienta";
            $this->description = "Edycja danych klienta hotelu";
        } else{
            $this->name = "Dodawanie klienta";
            $this->description = "Dodawanie nowego klienta hotelu";
        }
        return [
            'customer' => $customer
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
            Button::make('Zapisz')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Aktualizuj')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Usuń')
                ->icon('trash')
                ->confirm(__('Czy na pewno chcesz usunąć ten pokój?'))
                ->method('remove')
                ->canSee($this->exists),
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
            // TODO: Sprawdzenie, czy klient nie jest zdublowany w bazie danych - P
            Layout::rows([
                Input::make('customer.first_name')
                    ->title('Imię klienta')
                    ->placeholder('Imię')
                    ->help('Wprowadź imię klienta')
                    ->type('text')
                    ->required(),

                Input::make('customer.last_name')
                    ->title('Nazwisko klienta')
                    ->placeholder('Nazwisko')
                    ->help('Wprowadź nazwisko klienta')
                    ->type('text')
                    ->required(),

                Input::make('customer.address')
                    ->title('Adres zamieszkania klienta')
                    ->placeholder('np. Sezamkowa 15') //Kod pocztowy+miasto+ulica?
                    ->help('Wprowadź adres zamieszkania klienta')
                    ->type('text')
                    ->required(),

                Input::make('customer.phone')
                    ->title('Numer telefonu klienta')
                    ->placeholder('np. 123 456 789')
                    ->help('Wprowadź numer telefonu klienta')
                    ->type('text') //tel?
                    ->mask('999 999 999')
                    ->required(),

                Input::make('customer.email')
                    ->title('Adres e-mail klienta')
                    ->placeholder('np. jannowak@mail.com')
                    ->help('Wprowadź adres e-mail klienta')
                    ->type('email')
                    ->required(),
            ])
        ];
    }

    /**
     * @param Customer $customer
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(Customer $customer, Request $request): RedirectResponse
    {
        $customer->fill($request->get('customer'))->save();

        Alert::success('Pomyślnie dodano nowego klienta do bazy danych.');

        return redirect()->route('platform.customer.list');
    }

    /**
     * @param Customer $customer
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function remove(Customer $customer): RedirectResponse
    {
        $customer->delete();

        Alert::success('Pomyślnie usunięto klienta.');

        return redirect()->route('platform.customer.list');
    }
}
