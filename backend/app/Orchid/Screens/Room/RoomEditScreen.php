<?php

namespace App\Orchid\Screens\Room;

use App\Models\Amenity;
use App\Models\Room;
use App\Models\RoomBedType;
use App\Models\RoomStatus;
use App\Models\RoomType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class RoomEditScreen extends Screen
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
     * @param Room $room
     *
     * @return array
     */
    public function query(Room $room): array
    {
        $this->exists = $room->exists;

        if($this->exists){
            $this->name = 'Edycja pokoju';
            $this->description = "Edycja pokoju hotelowego";
        } else {
            $this->name = 'Dodawanie pokoju';
            $this->description = 'Dodawanie nowego pokoju hotelowego.';
        }

        return [
            'room' => $room
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
            // TODO: Dodać sprawdzenie unikalności numeru pokoju (można skorzystać z UserEditScreen).
            Layout::rows([
                Input::make('room.room_number')
                    ->title('Numer pokoju')
                    ->placeholder('np. 32')
                    ->help('Wprowadź numer pokoju.')
                    ->type('number')
                    ->required(),

                Select::make('room.floor')
                    ->options([
                        '0' => 'Parter',
                        '1' => 'I piętro',
                        '2' => 'II piętro',
                        '3' => 'III piętro',
                        '4' => 'IV piętro',
                        '5' => 'V piętro'
                    ])
                    ->title('Piętro')
                    ->help('Piętro, na którym znajduje się pokój.')
                    ->required(),

                Select::make('room.room_type_id')
                    ->title('Typ pokoju')
                    ->help('Wybierz typ pokoju.')
                    ->fromModel(RoomType::class, 'name'),

                Select::make('room.bed_type_id')
                    ->title('Rodzaj łóżek')
                    ->help('Wybierz rodzaj łóżek w pokoju.')
                    ->fromModel(RoomBedType::class, 'name'),

                Relation::make('room.amenities.')
                    ->fromModel(Amenity::class, 'name')
                    ->multiple()
                    ->title('Wybierz udogodnienia w pokoju.')
                    ->required(),

                Select::make('room.room_status_id')
                    ->title('Status pokoju')
                    ->help('Wybierz aktualny status pokoju.')
                    ->fromModel(RoomStatus::class, 'name'),

                Input::make('room.price_per_night')
                    ->title('Cena za noc (zł)')
                    ->placeholder('np. 250 zł')
                    ->help('Wprowadź cenę za noc w pokoju hotelowym')
                    ->mask([
                        'alias' => 'currency',
                        'suffix' => ' zł',
                        'groupSeparator' => ' ',
                        'digitsOptional' => true,
                        'digits' => 2,
                        'removeMaskOnSubmit' => true,
                        'rightAlign' => false
                    ])->required(),

                Quill::make('room.description')
                    ->title('Opis pokoju')
                    ->placeholder('Opis pokoju hotelowego.'),

                // TODO: Czy zdjęcia się poprawnie podpinają?
                Upload::make('images')
                    ->title('Zdjęcia pokoju')
                    ->acceptedFiles('image/*')
            ])
        ];
    }

    /**
     * @param Room $room
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(Room $room, Request $request): RedirectResponse
    {
        $room->fill($request->get('room'))->save();

        $room->attachment()->syncWithoutDetaching(
            $request->input('images', [])
        );

        // Obsługa relacji many-to-many dla udogodnień.
        $room->amenities()->detach(); // Odłączenie wszystkich poprzednich
        $room->amenities()->attach($request->input('room.amenities')); // Dodanie wszystkich zaznaczonych w formularzu.

        Alert::success('Pomyślnie zapisano pokój w bazie danych.');

        return redirect()->route('platform.room.list');
    }

    /**
     * @param Room $room
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function remove(Room $room): RedirectResponse
    {
        $room->delete();

        Alert::success('Pomyślnie usunięto pokój.');

        return redirect()->route('platform.room.list');
    }
}
