<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupportRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class SupportController extends Controller
{
    public function store(StoreSupportRequest $request): RedirectResponse
    {
        $page = Page::where('slug', $request->input('slug'))->firstOrFail();

        $page->addSupport([
            'supporter_name' => $request->input('supporter_name'),
            'message' => $request->input('message'),
            'amount' => (int) $request->input('amount'),
        ]);

        return back()->with('success', 'Thank you for your support!');
    }
}
