<?php

use App\Models\User;
use App\Models\Page;
use App\Models\Link;
use App\Models\Support;

test('user can have a page', function () {
    $user = User::factory()->create();
    
    $page = Page::create([
        'user_id' => $user->id,
        'slug' => 'test-slug',
        'title' => 'Test Page',
        'bio' => 'This is a test bio',
    ]);

    expect($user->page->id)->toBe($page->id);
    expect($page->user->id)->toBe($user->id);
});

test('page can have links', function () {
    $user = User::factory()->create();
    $page = Page::create([
        'user_id' => $user->id,
        'slug' => 'test-slug-links',
        'title' => 'Test Page Links',
    ]);

    $link1 = Link::create([
        'page_id' => $page->id,
        'title' => 'Link 1',
        'url' => 'https://example.com/1',
        'sort_order' => 1,
    ]);

    $link2 = Link::create([
        'page_id' => $page->id,
        'title' => 'Link 2',
        'url' => 'https://example.com/2',
        'sort_order' => 2,
    ]);

    expect($page->links)->toHaveCount(2);
    expect($page->links->first()->title)->toBe('Link 1');
});

test('page can have supports', function () {
    $user = User::factory()->create();
    $page = Page::create([
        'user_id' => $user->id,
        'slug' => 'test-slug-supports',
        'title' => 'Test Page Supports',
    ]);

    Support::create([
        'page_id' => $page->id,
        'supporter_name' => 'Fan 1',
        'message' => 'Great job!',
        'amount' => 500,
    ]);

    expect($page->supports)->toHaveCount(1);
    expect($page->supports->first()->supporter_name)->toBe('Fan 1');
    expect($page->supports->first()->amount)->toBe(500);
});
