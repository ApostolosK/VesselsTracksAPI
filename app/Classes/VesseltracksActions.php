<?php

namespace App\Classes\VesseltracksActions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Traits\ExecutionTimer;
use App\Models\VesselTracks as VesselTracks;

use Carbon\Carbon;

class VesseltracksActions {
    
    use ExecutionTimer;

    CONST ADD_DATA = 'add_data';
    CONST GET_DATA = 'get_data';

    CONST HTTP_NOT_ACCEPTABLE = 406;
    CONST HTTP_BAD_REQUEST    = 400;
    CONST HTTP_CREATED        = 201;
    CONST HTTP_OK             = 200;

    public
       $response_data,
       $actiontype,
       $http_status,
       $mmsi,
       $status,
       $station,
       $speed,
       $lon,
       $lat,
       $course,
       $heading,
       $rot,
       $timestamp;

    private
       $response;

     /**
     * Parse Request
     * Set params from request
     * @param Request $request
     * 
     * @return null
     */
    public function parseRequest(Request $request) {
        $this->request = $request;
        $this->mmsi = $request->input('mmsi');
        $this->status = $request->input('status');
        $this->station = $request->input('station');
        $this->lon = $request->input('lon');
        $this->lat = $request->input('lat');
        $this->course = $request->input('course');
        $this->heading = $request->input('heading');
        $this->rot = $request->input('rot');
        $this->timestamp = $request->input('timestamp');
    }

    /**
     * Save the data to the DB
     * @param array $data
     */
    public function saveData($data)
    {
        $vasseltracks_model = new VesselTracks();
        $vasseltracks_model->save($data);
    }

    /**
     * Retrieve the data from the DB
     * @param array $data 
     * 
     * @return json
     */
    public function getdata($data)
    {
        $vasseltracks_model = new VesselTracks();
        return  $vasseltracks_model->getdata($data);
    }

    /**
     * Set the http status
     * @param string $status
     */
    public function set_http_status($status)
    {
        $this->http_status = $status;
    }

    /**
     * Set the action type
     * @param string $actiontype
     * 
    */
    public function set_action_type($actiontype)
    {
        $this->actiontype = $actiontype;
    }

    /** 
    * Set the response data
    * @param array $data
    *
    */
    public function set_response_data($data)
    {
        $this->response_data = $data;
    }

    /**
     * Add Error Response
     *  Unsuccessful Action
     * @param $message
     * 
     * @return void
     */
    public function addErrorResponse(\Exception $exception): void{
        $this->errors[] = [
            'error' => self::getErrors($exception),
        ];
    }

    /**
     * Return response
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResponseJson(): JsonResponse {
        'errors' => $this->errors ? $this->errors : [] ,
        'data' => $this->data ? $this->data : [],
        'actiontype' => $this->actiontype,
        'http_status' => $this->http_status,
        'dateTime' => Carbon::now()->setTimezone('UTC')->toAtomString()
    }
}
