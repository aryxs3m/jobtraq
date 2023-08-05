<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

class ArticleService
{
    /**
     * @return Collection|Article[]
     */
    public function getList(int $limit): Collection|array
    {
        return Article::query()
            ->where('published', '=', true)
            ->orderBy('id', 'DESC')
            ->limit($limit)
            ->get([
                'id',
                'slug',
                'title',
                'introduction',
                'image_url',
                'published_at',
                'user_id',
            ]);
    }
}
