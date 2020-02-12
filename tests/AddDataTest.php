<?php 

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Log;

class AddDataTest extends TestCase 
{
    /**
    * API Add Data Test
    *
    * @return void
    */
    public function testAddData()
    {
        $request = [
            "mmsi" => 247039300,
            "status" => 0,
            "stationId" => 81,
            "speed" => 180,
            "lon" => 15.4415,
            "lat" => 42.75178,
            "course" => 144,
            "heading" => 144,
            "rot"=> "",
            "timestamp" => 1372683960
        ];

        $path = 'http://127.0.0.1/MarineTraffic/coordinates-api/vesselstracks/add';
        $this->json('POST', $path, $request)
            ->seeJsonStructure([
                'errors',
                'data',
                'actiontype',
                'http_status',
                'dateTime'
            ]);

        $this->assertResponseStatus(200);
    }
}
