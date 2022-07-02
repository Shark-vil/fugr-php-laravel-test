<?php

namespace Tests\Feature\Api\v1\Notebook;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Notebook;

class RESTApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_rest_api()
    {
			$notebookCollection = Notebook::factory(10)->make();

			foreach ($notebookCollection as $notebook) {
				$notebookData = $notebook->toArray();

				$response = $this->postJson('/api/v1/notebook', $notebookData);
				$content = $response->decodeResponseJson();
        $response->assertStatus(201)->assertJson([
					'data' => $notebookData
				]);

				$response = $this->getJson('/api/v1/notebook/' . $content['data']['id']);
        $response->assertStatus(200)->assertJson([
					'data' => $notebookData
				]);

				$response = $this->deleteJson('/api/v1/notebook/' . $content['data']['id']);
        $response->assertStatus(204)->assertNoContent();
			}
    }
}
