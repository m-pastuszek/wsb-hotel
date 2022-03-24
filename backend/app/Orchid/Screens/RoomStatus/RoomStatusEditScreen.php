<?php

namespace App\Orchid\Screens\RoomStatus;

use App\Models\RoomStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class RoomStatusEditScreen extends Screen
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
     * @param RoomStatus $roomStatus
     *
     * @return array
     */
    public function query(RoomStatus $roomStatus): array
    {
        $this->exists = $roomStatus->exists;

        if($this->exists){
            $this->name = 'Edycja statusu pokoju';
            $this->description = "Edycja statusu pokoju hotelowego";
        } else {
            $this->name = 'Dodawanie statusu pokoju';
            $this->description = 'Dodawanie nowego statusu pokoju hotelowego.';
        }

        return [
            'room-status' => $roomStatus
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
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
                ->confirm(__('Czy na pewno chcesz usunąć ten status pokoju?'))
                ->method('remove')
                ->canSee($this->exists),
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
            Layout::rows([
                Input::make('room-status.name')
                    ->title('Nazwa')
                    ->help('Wprowadź nazwę statusu pokoju.')
                    ->required(),

                Input::make('room-status.color')
                    ->title('Kolor')
                    ->help('Wpisz kolor reprezentujący status pokoju.')
                    ->required(),

                TextArea::make('room-status.description')
                    ->title('Opis')
                    ->help('Wprowadź opis statusu pokoju.')
                    ->required()
                    ->rows(5),

            ])
        ];
    }

    /**
     * @param RoomStatus $roomStatus
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(RoomStatus $roomStatus, Request $request): RedirectResponse
    {
        $roomStatus->fill($request->get('room-status'))->save();

        Alert::success('Pomyślnie dodano nowy status pokoju do bazy danych.');

        return redirect()->route('platform.room-status.list');
    }

    /**
     * @param RoomStatus $roomStatus
     * @return RedirectResponse
     */
    public function remove(RoomStatus $roomStatus): RedirectResponse
    {
        $roomStatus->delete();

        Alert::success('Status pokoju został pomyślnie usunięty.');

        return redirect()->route('platform.room-status.list');
    }
}
