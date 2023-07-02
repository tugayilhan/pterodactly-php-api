<?php 

namespace Tugayilhan\Pterodactyl;

class Pterodactyl

{

    protected $api_key;

    protected $base_url;

    public $api_type;



    public function __construct($api_key, $base_url, $api_type = 'application')
    {
        $this->api_type = $api_type;
        $this->api_key = $api_key;
        $this->base_url = $base_url;
    }

    public function getApiKey()
    {
        return $this->api_key;
    }
    public function getBaseUrl()
    {
        return $this->base_url;
    }



}




?>