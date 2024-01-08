<?php 

namespace Tugayilhan\Pterodactyl\EndPoints\Clients\Server;
use Tugayilhan\Pterodactyl\EndPoints\Clients\ServerClientsActions;

class DatabaseClientsActions extends ServerClientsActions {

    protected $servers;
    
    protected $database_id;

    public function __construct($servers)
    {
      $this->servers =   $servers;
    }
    public function setDatabaseId($database_id)
    {
      $this->database_id = $database_id;
    }

    public function getDatabaseId()
    {

    }

    public function list()
    {   
       return $this->servers->requestJson('GET', '/api/client/servers/'. $this->servers->server_id ."/databases");
    }

    public function create(string $databaseName, string $remote = "%")
    {   
      $data =
      [
        'database' => $databaseName,
        'remote'  => $remote 
      ];
       return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/databases", $data);
    }

    public function rotatePassword()
    {
      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/databases/".$this->database_id."/rotate-password");
    }

    public function delete()
    {
      return $this->servers->requestJson('DELETE', '/api/client/servers/'. $this->servers->server_id ."/databases/".$this->database_id);
    }


}