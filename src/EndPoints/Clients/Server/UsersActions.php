<?php 

namespace Tugayilhan\Pterodactyl\EndPoints\Clients\Server;
use Tugayilhan\Pterodactyl\EndPoints\Clients\ServerClientsActions;

class UsersClientsActions extends ServerClientsActions {

    protected $servers;
    
    protected $sub_user_id;

    public function __construct($servers)
    {
      $this->servers =   $servers;
    }

    public function setSubUserId(string $sub_user_id)
    {
      $this->sub_user_id = $sub_user_id;
    }
    public function getSubUserId()
    {
      return $this->sub_user_id;
    }
    public function list()
    {
      return $this->servers->requestJson('GET', '/api/client/servers/'. $this->servers->server_id ."/users");
    }
    public function createUser(string $email, array $permissions)
    {
      $data = [
        'email' => $email,
        'permissions' => $permissions
      ];
      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/users", $data);
    }

    public function getSubUser()
    {
      return $this->servers->requestJson('GET', '/api/client/servers/'. $this->servers->server_id ."/users/".$this->getSubUserId());
    }
    public function updateSubUser(array $permissions)
    {
      $data = [
        'permissions' => $permissions
      ];
      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/users/".$this->getSubUserId(), $data);
    }
    public function deleteSubUser()
    {
      return $this->servers->requestJson('DELETE', '/api/client/servers/'. $this->servers->server_id ."/users/".$this->getSubUserId());
    }
}