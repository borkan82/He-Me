<?php

class GEOLOCATION {
    private $token  = '';
    private $secure = 'http';

    public function getGeolocation($ip) {

        // Initialize cURL session
        $curl = curl_init();

        // Set the cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->secure."://ipinfo.io/$ip?token=$this->token",
            CURLOPT_RETURNTRANSFER => true, // Get response as string
            CURLOPT_HTTPGET => true // Send GET request
        ));

        // Execute the cURL request and get the response
        $response = curl_exec($curl);

        // Check for errors
        if(curl_errno($curl)) {
            return json_encode(['error'=>curl_error($curl)]);
        } else {
            curl_close($curl);
            // Decode the JSON response
            if(!empty($response['country'])){
                return $response['country'];
            }
            return json_encode(['error'=>"Error on Geolocation request"]);
        }
    }
}