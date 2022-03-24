<?php

namespace App\Orchid\Screens\RoomType;

use App\Models\RoomType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class RoomTypeEditScreen extends Screen
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
     * @param RoomType $roomType
     *
     * @return array
     */
    public function query(RoomType $roomType): array
    {
        $this->exists = $roomType->exists;

        if($this->exists){
            $this->name = 'Edycja typu pokoju';
            $this->description = "Edycja typu pokoju hotelowego";
        } else {
            $this->name = 'Dodawanie typu pokoju';
            $this->description = 'Dodawanie nowego typu pokoju hotelowego.';
        }

        return [
            'room-type' => $roomType
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
                ->confirm(__('Czy na pewno chcesz usunąć ten typ pokoju?'))
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
                Input::make('room-type.name')
                    ->title('Nazwa')
                    ->help('Wprowadź nazwę typu pokoju.')
                    ->required(),

                TextArea::make('room-type.description')
                    ->title('Opis')
                    ->help('Wprowadź opis typu pokoju.')
                    ->required()
                    ->rows(5),

            ])
        ];
    }

    /**
     * @param RoomType $roomType
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(RoomType $roomType, Request $request): RedirectResponse
    {
        $roomType->fill($request->get('room-type'))->save();

        Alert::success('Pomyślnie dodano nowy typ pokoju do bazy danych.');

        return redirect()->route('platform.room-type.list');
    }

    /**
     * @param RoomType $roomType
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function remove(RoomType $roomType): RedirectResponse
    {
        $roomType->delete();

        Alert::success('Typ pokoju został pomyślnie usunięty.');

        return redirect()->route('platform.room-type.list');
    }

}
