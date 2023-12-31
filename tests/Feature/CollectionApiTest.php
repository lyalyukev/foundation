<?php

namespace Tests\Feature;

use App\Models\Contributor;
use App\Models\FundCollection;
use App\Models\Token;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CollectionApiTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateFundCollection()
    {
        Artisan::call('token:generate');

        $token = Token::latest()->pluck('token')->first();

        $fundCollectionData = FundCollection::factory()->create()->toArray();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/v1/collection/create/', $fundCollectionData);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'title',
                'description',
                'target_amount',
                'link'
            ],
        ]);
    }

    public function testGetAllCollections()
    {
        FundCollection::factory(3)->create();

        $response = $this->get('/api/v1/collections/');

        $response->assertStatus(200);

    }

    public function testGetDetailCollection()
    {
        $collection = FundCollection::factory()->create();

        $response = $this->get("/api/v1/collection/{$collection->id}/");

        $response->assertStatus(200);

    }

    public function testShowWithContributors()
    {
        $collection = FundCollection::factory()
            ->has(Contributor::factory(10), 'contributors')
            ->create();

        $response = $this->get("/api/v1/collection/{$collection->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'description',
                    'target_amount',
                    'link',
                    'contributors' => [
                        '*' => ['id', 'user_name','collection_id','amount'],
                    ],
                ],
            ]);
    }


    public function testShowNonExistentCollection()
    {
        $nonExistentId = 99999;

        $response = $this->get("/api/v1/collection/{$nonExistentId}");

        $response->assertStatus(404);
    }

    public function testGetListOfCollectionWithFilter()
    {
        FundCollection::factory(5)->create([
            'target_amount' => 250,
        ]);

        $filter = 'target_amount=>200';

        $response = $this->get("/api/v1/collections/filter/{$filter}/");

        $response->assertStatus(200);
    }

    public function testGetListOfCollectionWithIncorrectFilter()
    {
        FundCollection::factory(5)->create([
            'target_amount' => 250,
        ]);

        $filter = 'target_amount1=>200';

        $response = $this->get("/api/v1/collections/filter/{$filter}/");

        $response->assertStatus(400);
    }



}
