<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UsersRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(UsersDataTable $dataTable): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|JsonResponse
    {
        $this->authorize('view users');

        return $dataTable->render('users.list');
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('add users');

        return view('users.create', [
            'item' => null,
            'roles' => Role::all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(User $user): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('edit users');

        return view('users.update', [
            'item' => $user,
            'roles' => Role::all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(UsersRequest $request): RedirectResponse
    {
        $this->authorize('add users');

        $this->handleSave($request);

        return redirect()->back()->with('success', true);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(User $user, UsersRequest $request): RedirectResponse
    {
        $this->authorize('edit users');

        $this->handleSave($request, $user);

        return redirect()->back()->with('success', true);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete users');

        $user->delete();

        return redirect()->back();
    }

    private function handleSave(UsersRequest $request, User $user = null): void
    {
        $data = [
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
        ];

        if (!empty($request->validated('password'))) {
            $data['password'] = Hash::make($request->validated('password'));
        }

        if (null !== $user) {
            $user->update($data);
        } else {
            /** @var User $user */
            $user = User::query()->create($data);
        }

        $user->syncRoles($request->validated('roles'));
    }
}
