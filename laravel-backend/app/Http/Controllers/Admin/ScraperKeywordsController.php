<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ScraperKeywordsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ScraperKeywordsRequest;
use App\Models\CrawlerKeyword;
use App\Services\Scraper\ScraperManager;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ScraperKeywordsController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(ScraperKeywordsDataTable $dataTable): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|JsonResponse
    {
        $this->authorize('view scraper-keywords');

        return $dataTable->render('crawler-keywords.list');
    }

    /**
     * @throws AuthorizationException
     */
    public function create(ScraperManager $crawlManager): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('add scraper-keywords');

        return view('crawler-keywords.create', [
            'services' => $crawlManager->getServices(),
            'item' => null,
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(CrawlerKeyword $scraperKeyword, ScraperManager $crawlManager): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('edit scraper-keywords');

        return view('crawler-keywords.update', [
            'services' => $crawlManager->getServices(),
            'item' => $scraperKeyword,
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(ScraperKeywordsRequest $request): RedirectResponse
    {
        $this->authorize('add scraper-keywords');

        $this->handleSave($request);

        return redirect()->back()->with('success', true);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(CrawlerKeyword $scraperKeyword, ScraperKeywordsRequest $request): RedirectResponse
    {
        $this->authorize('edit scraper-keywords');

        $this->handleSave($request, $scraperKeyword);

        return redirect()->back()->with('success', true);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(CrawlerKeyword $scraperKeyword): RedirectResponse
    {
        $this->authorize('delete scraper-keywords');

        $scraperKeyword->delete();

        return redirect()->back();
    }

    private function handleSave(ScraperKeywordsRequest $request, CrawlerKeyword $scraperKeyword = null): void
    {
        $request = [
            'crawler' => $request->validated('crawler'),
            'keywords' => explode(',', $request->validated('keywords')),
        ];

        if (null !== $scraperKeyword) {
            $scraperKeyword->update($request);
        } else {
            CrawlerKeyword::query()->create($request);
        }
    }
}
