<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebLoadTest extends TestCase
{
    /**
     * @dataProvider providePathWithSuccessResponse
     * @param string $path
     * @return void
     */
    public function test_the_application_returns_a_successful_response(string $path): void
    {
        $response = $this->get($path);
        $response->assertStatus(200);
    }

    public function test_get_sorted_array()
    {
        $response = $this->getJson('/api/array/?array_size=4&array_sort=Diagonal');
        $response->assertJson([
                "data" => [
                    "outputArray" => [[1, 3, 6, 10], [2, 5, 9, 13], [4, 8, 12, 15], [7, 11, 14, 16]]
                ]
            ]);
    }

    public function test_download_sorted_array()
    {
        $response = $this->getJson('/api/array/download/?array_size=4&array_sort=Diagonal');
        $response->assertDownload('arrays.txt');
    }

    public function providePathWithSuccessResponse(): \Generator
    {
        yield "Root path" => [
            "/"
        ];
        yield "Sort with valid params" => [
            "/api/array/?array_size=4&array_sort=Diagonal"
        ];
        yield "Write with valid params" => [
            "/api/array/write/?array_size=4&array_sort=Diagonal"
        ];
        yield "Download path" => [
            "/api/array/download/?array_size=4&array_sort=Diagonal"
        ];
    }
}
