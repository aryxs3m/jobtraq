<?php

namespace App\Http\Controllers\Admin\Data;

use App\DataTables\CountriesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Models\Country;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class CountriesController extends Controller
{
    public function index(CountriesDataTable $dataTable): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|JsonResponse
    {
        return $dataTable->render('data.countries.list');
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('data.countries.create', [
            'item' => null,
        ]);
    }

    public function edit(Country $country): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('data.countries.update', [
            'item' => $country,
        ]);
    }

    public function store(CountryRequest $request): RedirectResponse
    {
        $this->handleSave($request);

        return redirect()->back()->with('success', true);
    }

    public function update(CountryRequest $request, Country $country)
    {
        $this->handleSave($request, $country);

        return redirect()->back()->with('success', true);
    }

    public function destroy(Country $country): RedirectResponse
    {
        $country->delete();

        return redirect()->back();
    }

    private function handleSave(CountryRequest $request, Country $country = null): void
    {
        if (null !== $country) {
            $country->update($request->validated());
        } else {
            Country::query()->create($request->validated());
        }
    }
}
