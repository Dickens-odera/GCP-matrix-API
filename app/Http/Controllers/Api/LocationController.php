<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\LocationRequest;
use Exception;
use App\Traits\ValidatesApiRequests;
class LocationController extends Controller
{
    use ValidatesApiRequests;
    /**
     * Calculate the distance covered by a lead from origin to destination
     * 
     * @param Illuminate\Http\Request $reguest
     * @return Illuminate\Http\Response
     */
    public function getDistance(LocationRequest $reguest)
    {
        //$this->payload = $request->only('origin','destination');
        $api_key = config('services.google_maps.api_key');
        $origin = $reguest->origin;
        $destination = $reguest->destination;
        $headers = ['Accept' => 'application/json'];

        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$origin.'&destinations='.$destination.'&key='.$api_key;
        try{
            $response = Http::withHeaders($headers)->post($url);
            return $response->body();
        }catch(Exception $e){
            return json_decode($e->getMessage());
        }
        /*
        //return $response['rows'];
        if(!$response)
        {
            return response()->json(['error' => '','message' => 'Unauthenticated'], 500);
        }
        return $response->body();
        **/
    }
}
