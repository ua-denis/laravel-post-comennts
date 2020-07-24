<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class PostCommentsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_showAllComments()
    {
        $response = $this->post(route('allComments'), ['post_id' => 1]);
        $response->assertStatus(200);
    }
}
