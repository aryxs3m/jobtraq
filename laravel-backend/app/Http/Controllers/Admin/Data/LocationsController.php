<?php

namespace App\Http\Controllers\Admin\Data;

use App\DataTables\LocationsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LocationRequest;
use App\Models\Country;
use App\Models\Location;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class LocationsController extends Controller
{
    public function index(LocationsDataTable $dataTable): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|JsonResponse
    {
        return $dataTable->render('data.locations.list');
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('data.locations.create', [
            'item' => null,
            'countries' => Country::all(),
        ]);
    }

    public function edit(Location $location): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('data.locations.update', [
            'item' => $location,
            'countries' => Country::all(),
        ]);
    }

    public function store(LocationRequest $request): RedirectResponse
    {
        $this->handleSave($request);

        return redirect()->back()->with('success', true);
    }

    public function update(LocationRequest $request, Location $location): RedirectResponse
    {
        $this->handleSave($request, $location);

        return redirect()->back()->with('success', true);
    }

    public function destroy(Location $location): RedirectResponse
    {
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
