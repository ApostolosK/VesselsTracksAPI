<?php 

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Log;

class GetDataTest extends TestCase 
{
      /**
    * API Get Data Test
    *
    * @return void
    */
    public function testGetData()
    {
        $request = [
            "mmsi" => [247039300,247039400,247019300,247029300]
        ];

        $path = 'http://127.0.0.1/MarineTraffic/coordinates-api/vesselstracks/get';
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


    public function testGetDataMoreThan10()
    {
        for ($i=0; $i<12; $i++) {
            $request = [
                "mmsi" => [
                    247039300,247039400,247019300,
                247029300,247029300,247029300,247029500,
                247023600,247034300,247025300
                ]
            ];

            $path = 'http://127.0.0.1/MarineTraffic/coordinates-api/vesselstracks/get';
            $this->json('POST', $path, $request)
               ->seeJsonStructure([
                    'errors',
                    'data',
                    'actiontype',
                    'http_status',
                    'dateTime'
                ]);
        }

        $this->assertResponseStatus(400);
    }
}