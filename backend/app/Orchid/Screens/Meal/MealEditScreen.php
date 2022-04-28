<?php

namespace App\Orchid\Screens\Meal;

use App\Models\Meal;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class MealEditScreen extends Screen
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
     * @param Meal $meal
     * @return array
     */
    public function query(Meal $meal): array
    {
        $this->exists = $meal->exists;

        if($this->exists){
            $this->name = 'Edycja wyżywienia';
        } else {
            $this->name = 'Dodawanie wyżywienia';
        }

        return [
            'meal' => $meal
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
                ->confirm(__('Czy na pewno chcesz usunąć to wyżywienie?'))
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
                Input::make('meal.name')
                    ->title('Nazwa')
                    ->help('Wprowadź nazwę wyżywienia.')
                    ->required(),

                TextArea::make('meal.description')
                    ->title('Opis')
                    ->help('Wprowadź opis wyżywienia.')
                    ->rows(3),

                Input::make('meal.cost')
                    ->title('Koszt')
                    ->placeholder('np. 250 zł')
                    ->help('Kwota doliczona do opłaty za rezerwację.')
                    ->mask([
                        'alias' => 'currency',
                        'suffix' => ' zł',
                        'groupSeparator' => ' ',
                        'digitsOptional' => true,
                        'digits' => 2,
                        'removeMaskOnSubmit' => true,
                        'rightAlign' => false
                    ])->required(),

            ])
        ];
    }

    /**
     * @param Meal $meal
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Meal $meal, Request $request): \Illuminate\Http\RedirectResponse
    {
        $meal->fill($request->get('meal'))->save();

        Alert::success('Pomyślnie zapisano wyżywienie w bazie danych.');

        return redirect()->route('platform.meal.list');
    }

    /**
     * @param Amenity $amenity
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Meal $meal): \Illuminate\Http\RedirectResponse
    {
        $meal->delete();

        Alert::success('Wyżywienie zostało pomyślnie usunięte.');

        return redirect()->route('platform.meal.list');
    }
}
