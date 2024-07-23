<?php

namespace App\Utils;

use GuzzleHttp\Client;

class CustomHelper
{
    public static function fetchLocCoordinates($query)
    {
        try {
            $client = new Client();

            $response = $client->get("http://nominatim.openstreetmap.org/search", [
                'query' => [
                    'q' => $query,
                    'format' => 'json'
                ]
            ]);

            

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            }
        }catch(\Exception $e){
            return response()->json([]);
        }

        return response()->json([]);
    }

    public static function fetchLocDetails($lat, $lng)
    {
        try {
            $client = new Client();

            $response = $client->get("https://nominatim.openstreetmap.org/reverse", [
                'query' => [
                    'lat' => $lat,
                    'lon' => $lng,
                    'format' => 'json'
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            }
        }catch(\Exception $e){
            return null;
        }


        return null;
    }

}