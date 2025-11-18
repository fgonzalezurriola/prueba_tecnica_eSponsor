<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function edit(Request $request)
    {
        $page = $request->user()->page ?? $request->user()->page()->create([
            'slug' => $request->user()->id . '-' . time(), // Temporary slug
            'title' => $request->user()->name,
        ]);

        return Inertia::render('Page/Edit', [
            'page' => $page,
        ]);
    }

    public function update(UpdatePageRequest $request)
    {
        $page = $request->user()->page;

        $page->update($request->validated());

        return back()->with('success', 'Page updated successfully.');
    }
}
