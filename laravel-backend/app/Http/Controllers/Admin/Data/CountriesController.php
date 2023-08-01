<?php

namespace App\Http\Controllers\Admin\Data;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function index()
    {
        return view('data.countries.list', [
            'items' => Country::all(),
        ]);
    }

    public function create()
    {
        return view('data.countries.form', [
            'item' => null,
        ]);
    }

    public function update(Country $country)
    {
        return view('data.countries.form', [
            'item' => $country,
        ]);
    }

    public function upsertPost(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|required',
        ]);

        if ($request->has('id')) {
            $country = Country::query()->findOrFail($request->input('id'));
            $country->update($validated);
        } else {
            Country::create($validated);
        }

        return redirect()->back()->with('success', true);
    }

    public function delete(Country $country): RedirectResponse
    {
        $country->delete();

        return redirect()->back();
    }
}
