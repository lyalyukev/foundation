<?php

namespace Tests\Feature;

use App\Models\Contributor;
use App\Models\FundCollection;
use App\Models\Token;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ContributorApiTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateContributor()
    {
        Artisan::call('token:generate');

        $token = Token::latest()->pluck('token')->first();

        $collection = FundCollection::factory()->create();
        $contributor = Contributor::factory()->create([
            'collection_id' => $collection->id
        ])->toArray();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/v1/'.$collection->id.'/contributor/create/', $contributor);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'collection_id',
                'user_name',
                'amount'
            ],
        ]);
    }

}
