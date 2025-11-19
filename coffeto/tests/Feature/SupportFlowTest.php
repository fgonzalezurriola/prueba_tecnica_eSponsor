<?php

use App\Models\Page;
use App\Models\Support;
use App\Models\User;

it('allows visitors to support a page by slug', function () {
    $user = User::factory()->create();

    $page = Page::create([
        'user_id' => $user->id,
        'slug' => 'coffee-lover',
        'title' => 'Coffee Lover',
        'bio' => 'Buy me a coffee.',
    ]);

    $response = $this->post(route('supports.store'), [
        'slug' => $page->slug,
        'supporter_name' => 'Generous Fan',
        'message' => 'Keep up the great work!',
        'amount' => 500,
    ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('supports', [
        'page_id' => $page->id,
        'supporter_name' => 'Generous Fan',
        'amount' => 500,
    ]);

    expect($page->supports)->toHaveCount(1);
});

it('validates support input', function () {
    $response = $this->post(route('supports.store'), [
        'slug' => 'non-existent-slug',
        'supporter_name' => '',
        'amount' => -100,
    ]);

    $response->assertSessionHasErrors(['slug', 'supporter_name', 'amount']);
});
