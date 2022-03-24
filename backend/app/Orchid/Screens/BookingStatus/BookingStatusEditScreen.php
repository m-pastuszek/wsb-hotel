<?php

namespace App\Orchid\Screens\BookingStatus;

use App\Models\Booking;
use App\Models\BookingStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class BookingStatusEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name;

    /**
     * Query data.
     *
     * @param BookingStatus $bookingStatus
     * @return array
     */
    public function query(BookingStatus $bookingStatus): array
    {
        $this->exists = $bookingStatus->exists;

        if($this->exists) {
            $this->name = 'Edycja statusu rezerwacji';
        } else {
            $this->name = 'Dodawanie statusu rezerwacji';
        }
        return [
            'booking-status' => $bookingStatus
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
                ->confirm(__('Czy na pewno chcesz usunąć ten status rezerwacji?'))
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
        // TODO: Uzupełnić layout BookingStatusEditScreen.
        // Częściowo uzupełnione - P
        return [
            Layout::rows([
                Input::make('booking-status.name')
                    ->title('Nazwa statusu')
                    ->placeholder('np. Dostępny')
                    ->help('Wprowadź nazwę statusu pokoju')
                    ->type('text')
                    ->required(),

                Quill::make('booking-status.description')
                    ->title('Opis statusu pokoju')
                    ->placeholder('Opis statusu pokoju hotelowego'),

                Upload::make('images')
                    ->title('Ikona statusu')
                    ->acceptedFiles('image/*')
            ])
        ];
    }

    /**
     * @param BookingStatus $bookingStatus
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(BookingStatus $bookingStatus, Request $request)
    {
        $bookingStatus->fill($request->get('booking-status'))->save();

        Alert::info('Pomyślnie dodany nowy status pokoju do bazy danych');

        return redirect()->route('platform.booking-status.list');
    }

    /**
     * @param BookingStatus $bookingStatus
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function remove(BookingStatus $bookingStatus)
    {
        $bookingStatus->delete();

        Alert::info('Pomyślnie usunięto status pokoju');

        return redirect()->route('platform.booking-status.list');
    }
}
