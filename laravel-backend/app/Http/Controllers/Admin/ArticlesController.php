<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ArticlesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ArticlesDataTable $dataTable): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|JsonResponse
    {
        return $dataTable->render('articles.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('articles.create', [
            'item' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request): RedirectResponse
    {
        $this->handleSave($request);

        return redirect()->back()->with('success', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('articles.update', [
            'item' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $this->handleSave($request, $article);

        return redirect()->back()->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()->back();
    }

    private function handleSave(ArticleRequest $request, Article $article = null): void
    {
        if (null !== $article) {
            $article->update($request->validated());

            if ($article->published && null === $article->published_at) {
                $article->published_at = Carbon::now();
            }
        } else {
            $article = Article::query()->make($request->validated());
            $article->slug = Str::slug($article->title);
            $article->user_id = Auth::user()->id;

            if ($article->published) {
                $article->published_at = Carbon::now();
            }

            $article->save();
        }
    }
}
