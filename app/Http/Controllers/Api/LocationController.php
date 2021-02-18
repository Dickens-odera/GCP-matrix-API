<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\LocationRequest;
class LocationController extends Controller
{
    /**
     * Calculate the distance covered by a lead from origin to destination
     * 
     * @param Illuminate\Http\Request $reguest
     * @return Illuminate\Http\Response
     */
    public function getDistance(LocationRequest $reguest)
    {
        $api_key = config('services.google_maps.api_key');
        $origin = $reguest->origin;
        $destination = $reguest->destination;
        $headers = ['Accept' => 'application/json'];

        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$origin.'&destinations='.$destination.'&key='.$api_key;
        $response = Http::withHeaders($headers)->post($url);
        //return $response['rows'];
        if(!$response)
        {
            return response()->json(['error' => '','message'], 500);
        }
        return $response->body();
    }
}
