<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrawlerKeyword;
use App\Services\Crawler\CrawlManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CrawlerKeywordsController extends Controller
{
    public function index()
    {
        return view('crawler-keywords.list', [
            'items' => CrawlerKeyword::all(),
        ]);
    }

    public function create(CrawlManager $crawlManager)
    {
        return view('crawler-keywords.form', [
            'services' => $crawlManager->getServices(),
            'item' => null,
        ]);
    }

    public function update(CrawlerKeyword $crawlerKeyword, CrawlManager $crawlManager)
    {
        return view('crawler-keywords.form', [
            'services' => $crawlManager->getServices(),
            'item' => $crawlerKeyword,
        ]);
    }

    public function upsertPost(Request $request)
    {
        $validated = $request->validate([
            'crawler' => 'string|required',
            'keywords' => 'string|required',
        ]);

        $data = [
            'crawler' => $validated['crawler'],
            'keywords' => explode(',', $validated['keywords']),
        ];

        if ($request->has('id')) {
            $crawlerKeyword = CrawlerKeyword::query()->findOrFail($request->input('id'));
            $crawlerKeyword->update($data);
        } else {
            CrawlerKeyword::create($data);
        }

        return redirect()->back()->with('success', true);
    }

    public function delete(CrawlerKeyword $crawlerKeyword): RedirectResponse
    {
        $crawlerKeyword->delete();

        return redirect()->back();
    }
}
