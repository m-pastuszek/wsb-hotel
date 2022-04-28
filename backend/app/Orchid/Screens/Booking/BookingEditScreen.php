<?php

namespace App\Orchid\Screens\Booking;

use App\Models\Booking;
use App\Models\BookingStatus;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class BookingEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name;

    /**
     * Display header description.
     *
     * @var string
     */
    public $description;

    /**
     * Query data.
     *
     * @param Booking $booking
     *
     * @return array
     */
    public function query(Booking $booking): array
    {
        $this->exists = $booking->exists;

        if($this->exists){
            $this->name = 'Edycja rezerwacji';
            $this->description = "Edycja rezerwacji hotelowej";
        } else {
            $this->name = 'Dodawanie rezerwacji';
            $this->description = 'Dodawanie nowej rezerwacji hotelowej';
        }

        return [
            'booking' => $booking
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
                ->confirm(__('Czy na pewno chcesz usunąć tą rezerwację?'))
                ->method('remove')
                ->canSee($this->exists)
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
            Layout::rows([
                DateTimer::make('booking.time_from')
                    ->title('Data zameldowania')
                    ->allowInput()
                    ->required()
                    ->placeholder('Wybierz datę...')
                    ->format('d-m-Y'),

                DateTimer::make('booking.time_to')
                    ->title('Data wymeldowania')
                    ->allowInput()
                    ->required()
                    ->placeholder('Wybierz datę...')
                    ->format('d-m-Y'),

                // TODO: Zmienić na koszt rezerwacji.
                Input::make('booking.amount')
                    ->title('Liczba zameldowanych osób')
                    ->placeholder('np. 1')
                    ->help('Wprowadź liczbę zameldowanych osób')
                    ->type('number')
                    ->mask([
                        'integerDigits' => 1,
                        'allowMinus' => false,
                        // 'max' => 4
                        'numericInput' => true
                    ])
                    ->required(),

                Select::make('booking.booking_status_id')
                    ->title('Status rezerwacji')
                    ->help('Wybierz aktualny status rezerwacji.')
                    ->fromModel(BookingStatus::class, 'name'),

                Quill::make('booking.additional_information')
                    ->title('Dodatkowe informacje')

                // TODO: Brakuje pola klient - customer_id
            ])
        ];
    }

    /**
     * @param Booking $booking
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(Booking $booking, Request $request): RedirectResponse
    {
        $booking->fill($request->get('booking'))->save();

        Alert::success('Rezerwacja została pomyślnie dodana.');

        return redirect()->route('platform.booking.list');
    }

    /**
     * @param Booking $booking
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function remove (Booking $booking): RedirectResponse
    {
        $booking->delete();

        Alert::success('Rezerwacja została usunięta.');

        return redirect()->route('platform.booking.list');
    }
}
