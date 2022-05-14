<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Role;

use App\Orchid\Layouts\Role\RoleEditLayout;
use App\Orchid\Layouts\Role\RolePermissionLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class RoleEditScreen extends Screen
{
    // TODO: Dokończyć
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Zarządzanie rolami';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Zarządzanie prawami dostępu do systemu zarządzania rezerwacjami';

    /**
     * @var bool
     */
    private $exist = false;

    /**
     * Query data.
     *
     * @param Role $role
     *
     * @return array
     */
    public function query(Role $role): array
    {
        $this->exist = $role->exists;

        return [
            'role'       => $role,
            'permission' => $role->getStatusPermission(),
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
            Button::make(__('Zapisz'))
                ->icon('check')
                ->method('save'),

            Button::make(__('Usuń'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exist),
        ];
    }

    /**
     * Views.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::block([
                RoleEditLayout::class,
            ])
                ->title('Rola')
                ->description('Rola jest zestawem uprawnień, które dają użytkownikom z tą rolą możliwość wykonywania określonych zadań'),

            Layout::block([
                RolePermissionLayout::class,
            ])
                ->title('Uprawnienie')
                ->description('Uprawnienie jest konieczne do wykonywania określonych zadań'),
        ];
    }

    /**
     * @param Role    $role
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function save(Role $role, Request $request)
    {
        $request->validate([
            'role.slug' => [
                'required',
                Rule::unique(Role::class, 'slug')->ignore($role),
            ],
        ]);

        $role->fill($request->get('role'));

        $role->permissions = collect($request->get('permissions'))
            ->map(function ($value, $key) {
                return [base64_decode($key) => $value];
            })
            ->collapse()
            ->toArray();

        $role->save();

        Toast::info(__('Rola została zapisana'));

        return redirect()->route('platform.systems.roles');
    }

    /**
     * @param Role $role
     *
     * @throws \Exception
     *
     * @return RedirectResponse
     */
    public function remove(Role $role)
    {
        $role->delete();

        Toast::info(__('Rola została usunięta'));

        return redirect()->route('platform.systems.roles');
    }
}
