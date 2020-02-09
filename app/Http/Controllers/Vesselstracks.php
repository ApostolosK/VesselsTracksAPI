<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class Vesselstracks
 * @package App\Classes\Vesselstracks
 * @author Apostolos Kourmatzoglou
 * @date 2020-02-08
 */

class Vesselstracks extends Controller
{
     /**
     * Add Tracks
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request) {
        return VesseltracksFacade::add($request);
    }

    public function get(Request $request) {
        return VesseltracksFacade::get($request);
    }

 
}
