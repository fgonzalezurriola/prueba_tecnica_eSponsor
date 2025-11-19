<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePageRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    /**
     * Lazily creates a page for the user if it does not exist.
     */
    public function edit(Request $request): Response
    {
        $user = $request->user();

        $page = $user->page ?? $user->page()->create([
            'slug' => $user->id . '-' . time(),
            'title' => $user->name,
        ]);

        return Inertia::render('Page/Edit', [
            'page' => $page->load(['links', 'supports']),
        ]);
    }

    public function update(UpdatePageRequest $request): RedirectResponse
    {
        $page = $request->user()->page;

        $page->update($request->validated());

        return back()->with('success', 'Page updated successfully.');
    }
}
