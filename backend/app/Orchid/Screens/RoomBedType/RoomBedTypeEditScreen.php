<?php

namespace App\Orchid\Screens\RoomBedType;

use App\Models\Amenity;
use App\Models\RoomBedType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class RoomBedTypeEditScreen extends Screen
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
     * @param RoomBedType $roomBedType
     * @return array
     */
    public function query(RoomBedType $roomBedType): array
    {
        $this->exists = $roomBedType->exists;

        if($this->exists){
            $this->name = __('Edycja typu łóżka');
            $this->description = __('Edycja typu łóżka w pokoju.');
        } else {
            $this->name = __('Dodawanie typu łóżka');
            $this->description = __('Dodawanie typu łóżka w pokoju.');
        }

        return [
            'room-bed-type' => $roomBedType
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
                ->confirm(__('Czy na pewno chcesz usunąć ten typ łóżka?'))
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
                Input::make('room-bed-type.name')
                    ->title('Nazwa')
                    ->help('Wprowadź nazwę typu łóżka.')
                    ->required(),

                TextArea::make('room-bed-type.description')
                    ->title('Opis')
                    ->help('Wprowadź opis typu łóżka.')
                    ->required()
                    ->rows(3),

            ])
        ];
    }

    /**
     * @param RoomBedType $roomBedType
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(RoomBedType $roomBedType, Request $request): RedirectResponse
    {
        $roomBedType->fill($request->get('room-bed-type'))->save();

        Alert::success('Pomyślnie dodano nowy typ łóżka do bazy danych.');

        return redirect()->route('platform.room-bed-type.list');
    }

    /**
     * @param RoomBedType $roomBedType
     * @return RedirectResponse
     */
    public function remove(RoomBedType $roomBedType): RedirectResponse
    {
        $roomBedType->delete();

        Alert::success('Typ łóżka został pomyślnie usunięty.');

        return redirect()->route('platform.room-bed-type.list');
    }
}
