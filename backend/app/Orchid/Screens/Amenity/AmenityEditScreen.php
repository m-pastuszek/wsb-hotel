<?php

namespace App\Orchid\Screens\Amenity;

use App\Models\Amenity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class AmenityEditScreen extends Screen
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
     * @param Amenity $amenity
     * @return array
     */
    public function query(Amenity $amenity): array
    {
        $this->exists = $amenity->exists;

        if($this->exists){
            $this->name = 'Edycja udogodnienia';
        } else {
            $this->name = 'Dodawanie udogodnienia';
        }

        return [
            'amenity' => $amenity
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
                ->confirm(__('Czy na pewno chcesz usunąć to udogodnienie?'))
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
                Input::make('amenity.name')
                    ->title('Nazwa')
                    ->help('Wprowadź nazwę udogodnienia.')
                    ->required(),

                // TODO: Jakich ikon będziemy używać na frontendzie?
                Input::make('amenity.icon')
                    ->title('Ikona')
                    ->help('Wybierz ikonę reprezentującą udogodnienie.')
                    ->required(),

                TextArea::make('amenity.description')
                    ->title('Opis')
                    ->help('Wprowadź opis udogodnienia.')
                    ->required()
                    ->rows(3),

            ])
        ];
    }

    /**
     * @param Amenity $amenity
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(Amenity $amenity, Request $request): RedirectResponse
    {
        $amenity->fill($request->get('amenity'))->save();

        Alert::success('Pomyślnie dodano nowe udogodnienie do bazy danych.');

        return redirect()->route('platform.amenity.list');
    }

    /**
     * @param Amenity $amenity
     * @return RedirectResponse
     */
    public function remove(Amenity $amenity): RedirectResponse
    {
        $amenity->delete();

        Alert::success('Udogodnienie zostało pomyślnie usunięte.');

        return redirect()->route('platform.amenity.list');
    }
}
