<?php 

namespace Tugayilhan\Pterodactyl\EndPoints\Clients\Server;
use Tugayilhan\Pterodactyl\EndPoints\Clients\ServerClientsActions;

class NetworkClientsActions extends ServerClientsActions {

    protected $servers;
    
    protected $allocation_id;

    public function setAllocationId($allocation_id)
    {
      $this->allocation_id = $allocation_id;
    }
    public function getAllocationId()
    {
      return $this->allocation_id;
    }

    public function __construct($servers)
    {
      $this->servers =   $servers;
    }
    
    public function list()
    {   
      return $this->servers->requestJson('GET', '/api/client/servers/'. $this->servers->server_id ."/network/allocations");
    }

    public function assingAllocation()
    {
      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/network/allocations");
    }

    public function setAllocationNote(string $notes)
    {
      $data = [
        'notes' => $notes
      ];
      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/network/allocations/".$this->getAllocationId(), $data);
    }

    public function setPrimaryAllocation()
    {
      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/network/allocations/".$this->getAllocationId()."/primary");
    }
    public function unassignAllocation()
    {
      return $this->servers->requestJson('DELETE', '/api/client/servers/'. $this->servers->server_id ."/network/allocations/".$this->getAllocationId());
    }


}