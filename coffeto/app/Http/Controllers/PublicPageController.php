<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicPageController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::with(['user', 'links', 'supports'])->where('slug', $slug)->firstOrFail();

        return Inertia::render('Public/Show', [
            'page' => [
                'id' => $page->id,
                'title' => $page->title,
                'slug' => $page->slug,
                'bio' => $page->bio,
                'avatar_path' => $page->avatar_path,
                'links' => $page->links->map(function ($link) {
                    return [
                        'id' => $link->id,
                        'title' => $link->title,
                        'url' => $link->url,
                    ];
                }),
                'supports_count' => $page->supports->count(),
            ],
        ]);
    }
}
