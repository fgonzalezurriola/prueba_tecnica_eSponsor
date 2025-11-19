<?php

it('redirects root to demo public page', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('public.page', ['slug' => 'demo-creator']));
});
