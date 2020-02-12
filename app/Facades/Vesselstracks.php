<?php

namespace App\Facades;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Classes\VesseltracksActions as VesseltracksActions;
use App\Facades\RequestValidator as Validator;

class VesselstracksFacade
{
    /**
     * add data to the database
     * @param  json request
     * 
     * @return json
     */
    public static function add(Request $request) {
        $validator = new Validator();
        $validate = $validator->validateRequestJson($request);

        Log::debug("The Request : " . date('d/M/Y H:m:i') . print_r($request, true));

        if (isset($validate['errors'])) {
             return $validator->validationCheck($validate['errors']);
        }

        $vesselactions = new VesseltracksActions();
        $vesseltrack_data = $vesselactions->parseRequest($request);
        $vesselactions->set_action_type($vesselactions->ADD_DATA);
        
        try {
            $vesselactions->saveData(vesseltrack_data);
            $vesselactions->set_http_status($vesselactions->HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error("Error Unable to Save to the DB : " . $e->get_message());
            $vesselactions->addErrorResponse($e);
            $vesselactions->set_http_status($vesselactions->HTTP_NOT_ACCEPTABLE);
        }
    
        //Get the total execution time
        $vesselactions->finishTimer();

        Log::info("The Finish Time of Add Data : " . $vesselactions->finish_time);
        return  $vesselactions->getResponseJson();
    }

    /**
     * get data from the database
     * @param  json request
     * 
     * @return json
     */
    public static function get(Request $request) {
        $validator = new Validator();
        $validate = $validator->validateRequestJson($request);

        Log::debug("The Request : " . date('d/M/Y H:m:i') . print_r($request, true));

        if (isset($validate['errors'])) {
             return $validator->validationCheck($validate['errors']);
        }

        $vesselactions = new VesseltracksActions();
        $vesselactions->set_action_type($vesselactions->GET_DATA);

        $validate_get =  $validator->validateTimeUserRequest();

        if( $validate_get === false) {
            Log::error("To meny request " . print_r($_SERVER, true));
            $vesselactions->set_http_status($vesselactions->HTTP_BAD_REQUEST);
            return  $vesselactions->getResponseJson();
        }

        try {
            $results_from_db = $vesselactions->getdata(vesseltrack_data);
            $vesselactions->set_response_data($results_from_db);
            $vesselactions->set_http_status($vesselactions->HTTP_OK);
        } catch (\Exception $e) {
            Log::error("Error Unable to retrieve from the DB : " . $e->get_message());
            $vesselactions->addErrorResponse($e);
            $vesselactions->set_http_status($vesselactions->HTTP_BAD_REQUEST);
        }

        //Get the total execution time
        $vesselactions->finishTimer();

        Log::info("The Finish Time of Retrieve Data  : " . $vesselactions->finish_time);
        return  $vesselactions->getResponseJson();
        
    }
}
