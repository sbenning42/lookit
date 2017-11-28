<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Log;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UploadTest extends TestCase
{
    public function testPictureUpload()
    {
        $productId = 1;
        $order = 0;
        $dir = 'pictures' . '/' . 'REF-' . $productId;
        Storage::fake($dir);

        $response = $this->json('POST', '/api/product-pictures', [
            'product_id' => $productId,
            'order' => $order,
            'picture' => UploadedFile::fake()->image('picture.jpg')
        ]);

        Log::warning(json_encode($response));

        $response
            ->assertStatus(200)
            ->assertJson([
                'origin_name' => true,
            ]);
    }
}