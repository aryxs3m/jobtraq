<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ScraperKeywordsRequest;
use App\Models\CrawlerKeyword;
use App\Services\Scraper\ScraperManager;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ScraperKeywordsController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('crawler-keywords.list', [
            'items' => CrawlerKeyword::all(),
        ]);
    }

    public function create(ScraperManager $crawlManager): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('crawler-keywords.create', [
            'services' => $crawlManager->getServices(),
            'item' => null,
        ]);
    }

    /**
     * @param CrawlerKeyword $scraperKeyword
     * @param ScraperManager $crawlManager
     *
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(CrawlerKeyword $scraperKeyword, ScraperManager $crawlManager): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('crawler-keywords.update', [
            'services' => $crawlManager->getServices(),
            'item' => $scraperKeyword,
        ]);
    }

    public function store(ScraperKeywordsRequest $request): RedirectResponse
    {
        $this->handleSave($request);

        return redirect()->back()->with('success', true);
    }

    public function update(CrawlerKeyword $scraperKeyword, ScraperKeywordsRequest $request): RedirectResponse
    {
        $this->handleSave($request, $scraperKeyword);

        return redirect()->back()->with('success', true);
    }

    public function destroy(CrawlerKeyword $scraperKeyword): RedirectResponse
    {
        $scraperKeyword->delete();

        return redirect()->back();
    }

    private function handleSave(ScraperKeywordsRequest $request, ?CrawlerKeyword $scraperKeyword = null): void
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
