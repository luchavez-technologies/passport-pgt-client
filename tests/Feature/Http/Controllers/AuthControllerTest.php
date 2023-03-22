<?php

namespace Luchavez\PassportPgtClient\Feature\Http\Controllers;

use Tests\TestCase;

/**
 * Class AuthControllerTest
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class AuthControllerTest extends TestCase
{
    /**
     * Example Test
     *
     * @test
     */
    public function example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
