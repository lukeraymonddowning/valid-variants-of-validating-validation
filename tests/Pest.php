<?php

declare(strict_types=1);

use App\Models\User;

uses(Tests\TestCase::class)
    ->in('Feature');

function login()
{
    return test()->actingAs(User::factory()->create());
}
