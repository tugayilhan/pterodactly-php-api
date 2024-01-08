<?php 

namespace Tugayilhan\Pterodactyl\EndPoints\Clients\Server;
use Tugayilhan\Pterodactyl\EndPoints\Clients\ServerClientsActions;

class BackupsClientsActions extends ServerClientsActions {

    protected $servers;
    
    protected $backup_id;

    public function setBackupId($backup_id)
    {
      $this->backup_id = $backup_id;
    }

    public function getBackupId()
    {
      return $this->backup_id;
    }

    public function __construct($servers)
    {
      $this->servers =   $servers;
    }
    public function list()
    {   
      return $this->servers->requestJson('GET', '/api/client/servers/'. $this->servers->server_id ."/backups");
    }
    public function create()
    {   
      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/backups");
    }
    public function detail()
    {   
      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/backups/".$this->getBackupId());
    }
    public function download()
    {   
      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/backups/".$this->getBackupId()."/downlaod");
    }
    public function delete()
    {   
      return $this->servers->requestJson('DELETE', '/api/client/servers/'. $this->servers->server_id ."/backups/".$this->getBackupId());
    }
    
}