<?php

namespace App\Http\Controllers\Admin\Data;

use App\DataTables\LocationsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LocationRequest;
use App\Models\Country;
use App\Models\Location;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class LocationsController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(LocationsDataTable $dataTable): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|JsonResponse
    {
        $this->authorize('view locations');

        return $dataTable->render('data.locations.list');
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('add locations');

        return view('data.locations.create', [
            'item' => null,
            'countries' => Country::all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Location $location): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('edit locations');

        return view('data.locations.update', [
            'item' => $location,
            'countries' => Country::all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(LocationRequest $request): RedirectResponse
    {
        $this->authorize('add locations');

        $this->handleSave($request);

        return redirect()->back()->with('success', true);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(LocationRequest $request, Location $location): RedirectResponse
    {
        $this->authorize('edit locations');

        $this->handleSave($request, $location);

        return redirect()->back()->with('success', true);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Location $location): RedirectResponse
    {
        $this->authorize('delete locations');

        $location->delete();

        return redirect()->back();
    }

    private function handleSave(LocationRequest $request, Location $location = null): void
    {
        $data = [
            'location' => $request->validated('location'),
            'country_id' => $request->validated('country'),
        ];

        if (null !== $location) {
            $location->update($data);
        } else {
            Location::query()->create($data);
        }
    }
}
