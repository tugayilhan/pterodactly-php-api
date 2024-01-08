<?php

namespace Tugayilhan\Pterodactyl\EndPoints;

class Actions 
{
    protected $pterodactyl;
    
    public function __construct($pterodactyl)
    {
        $this->pterodactyl = $pterodactyl;

    }

    protected function requestJson($method, $uri, $values = null, $asResource = true, $includes = [])
    {
        
       
        $uri = $this->pterodactyl->getBaseUrl() . "" . $uri;
        
        $url = $uri;
        echo $url;
        
        $headers[] = 'Accept: application/json';
        if(is_array($values))
            $headers[]= 'Content-Type: application/json';
        
        $headers[]= 'Authorization: Bearer '.$this->pterodactyl->getApiKey();
        
        $curl = curl_init();
        
        // CURL ayarları
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        
        if($method == "PUT")
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        if($method == "POST") 
            curl_setopt($curl, CURLOPT_POST, true);
        if($method == "GET")
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        if($method == "DELETE")
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        
        
        
        if(is_array($values))
        {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($values));
        }else{ 
            
        }
        // İstek gönderme
        $response = curl_exec($curl);
        
        
        // CURL kapatma
        
        
        // Yanıtı görüntüleme
        $result = json_decode($response,true);
        if ($response === false ) {
            $error = curl_error($curl);
            $error_code = curl_errno($curl);
            curl_close($curl);
            $data = [
                'code' => -1,
                'response' => 
                [
                    'error_code' => $error_code,
                    'error_description' => $error,
                ],
            ];
            
            return $data;
        }else
        {
            curl_close($curl);
            
            
            if($result === false && array_key_exists('errors', $result))
            {
                
                $data = [
                    'code' => $result['errors'][0]['status'],
                    'response' => 
                    [
                        'error_code' => $result['errors'][0]['code'],
                        'error_description' => $result['errors'][0]['detail'],
                    ],
                ];
                return $data;
            }else
            {
              
                $result['code'] = 200;
                
                $result['response'] = $result;
               
                $data= [
                    'code' => 200,
                    'response' => ($result === false) ? $result : $response,
                ];
                return $data;

            }
            
            
            
            
            
            
        }
        
    }
}

?>