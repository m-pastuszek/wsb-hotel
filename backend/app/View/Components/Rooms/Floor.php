<?php

namespace App\View\Components\Rooms;

use App\Models\Room;
use Illuminate\View\Component;

class Floor extends Component
{
    /**
     * @var Room $room
     */
    public $room;

    /**
     * Create a new component instance.
     *
     * @param Room $room
     * @return void
     */
    public function __construct(Room $room)
    {
        $this->room = $room;
    }

    /**
     * Return floor name by its number.
     *
     * @return mixed|string
     */
    public function floor() {
        $floors = [
            0 => __('Parter'),
            1 => __('I piętro'),
            2 => __('II piętro'),
            3 => __('III piętro'),
            4 => __('IV piętro'),
            5 => __('V piętro')
        ];

        if (array_key_exists($this->room->floor, $floors)) {
            return $floors[$this->room->floor];
        } else
            return 'Nieznane';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rooms.floor');
    }
}
