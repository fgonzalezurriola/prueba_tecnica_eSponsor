<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\Page;
use App\Models\Support;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Base demo user with page, links and supports
        $user = User::factory()->create([
            'name' => 'Demo Creator',
            'email' => 'demo@coffeto.test',
        ]);

        $page = Page::create([
            'user_id' => $user->id,
            'slug' => 'demo-creator',
            'title' => 'Demo Creator',
            'bio' => 'I make things on the internet. Buy me a coffee.',
            'avatar_path' => 'https://avatars.githubusercontent.com/u/9919?s=200&v=4',
        ]);

        Link::create([
            'page_id' => $page->id,
            'title' => 'My Portfolio',
            'url' => 'https://example.com',
            'sort_order' => 1,
        ]);

        Link::create([
            'page_id' => $page->id,
            'title' => 'Twitter',
            'url' => 'https://twitter.com',
            'sort_order' => 2,
        ]);

        Support::create([
            'page_id' => $page->id,
            'supporter_name' => 'First Fan',
            'message' => 'Love your work!',
            'amount' => 500,
        ]);

        Support::create([
            'page_id' => $page->id,
            'supporter_name' => 'Second Fan',
            'message' => 'Here is another coffee.',
            'amount' => 900,
        ]);

    }
}
