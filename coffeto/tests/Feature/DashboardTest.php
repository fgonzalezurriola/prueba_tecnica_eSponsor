<?php

use App\Models\Page;
use App\Models\Support;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('dashboard displays received supports', function () {
    $user = User::factory()->create();
    $page = Page::create([
        'user_id' => $user->id,
        'slug' => 'my-page',
        'title' => 'My Page',
    ]);

    $s1 = Support::create([
        'page_id' => $page->id,
        'supporter_name' => 'Fan 1',
        'message' => 'Love it!',
        'amount' => 500,
    ]);
    $s1->created_at = now()->subHour();
    $s1->save();

    Support::create([
        'page_id' => $page->id,
        'supporter_name' => 'Fan 2',
        'message' => 'Keep going',
        'amount' => 1000,
    ]);

    $this->actingAs($user)
        ->get(route('page.edit'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Page/Edit')
            ->has('page.supports', 2)
            ->where('page.supports.0.supporter_name', 'Fan 2') // Checks order (latest first)
            ->where('page.supports.0.amount', 1000)
        );
});
