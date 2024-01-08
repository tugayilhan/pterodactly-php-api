<?php 

namespace Tugayilhan\Pterodactyl\EndPoints\Clients\Server;
use Tugayilhan\Pterodactyl\EndPoints\Clients\ServerClientsActions;

class StartupClientsActions extends ServerClientsActions {

    protected $servers;
    

    public function __construct($servers)
    {
      $this->servers =   $servers;
    }
    public function list()
    {   
      return $this->servers->requestJson('GET', '/api/client/servers/'. $this->servers->server_id ."/startup");
    }

    public function update(string $key, string $value)
    {   
      $data = ['key' => $key, 'value' => $value];
      return $this->servers->requestJson('PUT', '/api/client/servers/'. $this->servers->server_id ."/startup/variable", $data);
    }

}