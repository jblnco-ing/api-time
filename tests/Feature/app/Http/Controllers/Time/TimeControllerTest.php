<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TimeControllerTest extends TestCase
{
    /**
     * A test get time.
     *
     * @return void
     */
    /** @test */
    public function anyone_can_get_time_data()
    {
        $this->withoutExceptionHandling();
        $response = $this->postJson('api/time',['hour'=>'21:20:00','timezone'=>'-4']);

        $response->assertStatus(200);

        $response->assertSessionHasNoErrors();

        $response->assertJsonStructure(['response'=>['time','timezone']]);

    }
}
