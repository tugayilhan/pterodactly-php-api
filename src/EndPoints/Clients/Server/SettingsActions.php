<?php 

namespace Tugayilhan\Pterodactyl\EndPoints\Clients\Server;
use Tugayilhan\Pterodactyl\EndPoints\Clients\ServerClientsActions;

class SettingsClientsActions extends ServerClientsActions {

    protected $servers;
    

    public function __construct($servers)
    {
      $this->servers =   $servers;
    }
    public function rename(string $new_name)
    {   
      $data = ['name' => $new_name];
      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/settings/rename", $data);
    }

    public function reinstall()
    {   

      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/settings/reinstall");
    }
}