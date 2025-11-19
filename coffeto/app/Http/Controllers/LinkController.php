<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SaveLinkRequest;
use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function store(SaveLinkRequest $request): RedirectResponse
    {
        $page = $request->user()->page;

        abort_unless($page, 404);

        $page->links()->create($request->validated());

        return back()->with('success', 'Link added.');
    }

    public function update(SaveLinkRequest $request, Link $link): RedirectResponse
    {
        $this->authorizeLink($request, $link);

        $link->update($request->validated());

        return back()->with('success', 'Link updated.');
    }

    public function destroy(Request $request, Link $link): RedirectResponse
    {
        $this->authorizeLink($request, $link);

        $link->delete();

        return back()->with('success', 'Link removed.');
    }

    private function authorizeLink(Request $request, Link $link): void
    {
        abort_unless($link->page && $link->page->user_id === $request->user()->id, 403);
    }
}
