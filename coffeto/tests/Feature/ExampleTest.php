<?php

it('displays welcome page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
