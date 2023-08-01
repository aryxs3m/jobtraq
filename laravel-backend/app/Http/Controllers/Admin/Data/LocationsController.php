<?php

namespace App\Http\Controllers\Admin\Data;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function index()
    {
        return view('data.locations.list', [
            'items' => Location::all(),
        ]);
    }

    public function create()
    {
        return view('data.locations.form', [
            'item' => null,
            'countries' => Country::all(),
        ]);
    }

    public function update(Location $location)
    {
        return view('data.locations.form', [
            'item' => $location,
            'countries' => Country::all(),
        ]);
    }

    public function upsertPost(Request $request)
    {
        $validated = $request->validate([
            'location' => 'string|required',
            'country' => 'integer|exists:countries,id',
        ]);

        $data = [
            'location' => $validated['location'],
            'country_id' => $validated['country'],
        ];

        if ($request->has('id')) {
            $location = Location::query()->findOrFail($request->input('id'));
            $location->update($data);
        } else {
            Location::create($data);
        }

        return redirect()->back()->with('success', true);
    }

    public function delete(Location $location): RedirectResponse
    {
        $location->delete();

        return redirect()->back();
    }
}
