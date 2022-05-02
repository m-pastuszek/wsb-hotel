<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Pokoje')
                ->icon('module')
                ->route('platform.room.list')
                ->title('Ogólne'),

            Menu::make('Rezerwacje')
                ->icon('directions')
                ->route('platform.booking.list'),

            Menu::make('Klienci')
                ->icon('people')
                ->route('platform.customer.list'),
            /**
             * Menu dropdown
             */
            /*Menu::make('Rezerwacje')
                ->icon('directions')
                ->list([
                    Menu::make('Sub element item 1')->icon('bag'),
                    Menu::make('Sub element item 2')->icon('heart'),
                ]),*/

            Menu::make('Typy pokoi')
                ->title('Zarządzanie danymi')
                ->icon('modules')
                ->route('platform.room-type.list')
                ->permission('platform.systems.admin'),

            Menu::make('Statusy pokoi')
                ->icon('start')
                ->route('platform.room-status.list')
                ->permission('platform.systems.admin'),

            Menu::make('Udogodnienia')
                ->icon('equalizer')
                ->route('platform.amenity.list')
                ->permission('platform.systems.admin'),

            Menu::make('Typy łóżek')
                ->icon('fa.bed')
                ->route('platform.room-bed-type.list')
                ->permission('platform.systems.admin'),

            Menu::make('Statusy rezerwacji')
                ->icon('number-list')
                ->route('platform.booking-status.list')
                ->permission('platform.systems.admin'),

            Menu::make('Wyżywienie')
                ->icon('cup')
                ->route('platform.meal.list')
                ->permission('platform.systems.admin'),


            /* Menu::make('Changelog')
                 ->icon('shuffle')
                 ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
                 ->target('_blank')
                 ->badge(function () {
                     return Dashboard::version();
                 }, Color::DARK()),*/

            Menu::make(__('Użytkownicy'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Bezpieczeństwo')),

            Menu::make(__('Role'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profil')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users'))
                ->addPermission('platform.systems.admin', __('Admin')),
        ];
    }
}
