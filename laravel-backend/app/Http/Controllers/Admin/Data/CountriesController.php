<?php

namespace App\Http\Controllers\Admin\Data;

use App\DataTables\CountriesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Models\Country;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class CountriesController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(CountriesDataTable $dataTable): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|JsonResponse
    {
        $this->authorize('view countries');

        return $dataTable->render('data.countries.list');
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('add countries');

        return view('data.countries.create', [
            'item' => null,
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Country $country): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('edit countries');

        return view('data.countries.update', [
            'item' => $country,
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(CountryRequest $request): RedirectResponse
    {
        $this->authorize('add countries');

        $this->handleSave($request);

        return redirect()->back()->with('success', true);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(CountryRequest $request, Country $country)
    {
        $this->authorize('edit countries');

        $this->handleSave($request, $country);

        return redirect()->back()->with('success', true);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Country $country): RedirectResponse
    {
        $this->authorize('delete countries');

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
