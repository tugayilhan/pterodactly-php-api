<?php

namespace Tugayilhan\Pterodactyl\EndPoints\Clients;
use Tugayilhan\Pterodactyl\EndPoints\Actions;
class ServerClientsActions extends Actions
{

    protected $server_id;
    public $backupsActions;
    public $databaseActions;
    public $filesActions;
    public $networkActions;
    public $schedulesActions;
    public $settingsActions;
    public $startupActions;
    public $usersActions;


    public function setServerId($server_id)
    {
        $this->server_id = $server_id;
    }
    private function getServerId()
    {
        return $this->server_id;
    }
    
    public function detail()
    {
        return $this->requestJson('GET', '/api/client/servers/'. $this->server_id );
    }
    public function websocket()
    {
        //test edilecek
        return $this->requestJson('GET', '/api/client/servers/'. $this->server_id."/websocket");
    }
    public function resources()
    {
        return $this->requestJson('GET', '/api/client/servers/'. $this->server_id."/resources");
    }
    public function sendCommand(string $command)
    {
        $data = ['command' => $command];
        return $this->requestJson('GET', '/api/client/servers/'. $this->server_id."/command", $data);
    }

    /*
     signal => start, stop, restart, kill
    */
    public function changePowerStatus(string $signal)
    {
        $data = ['signal' => $signal];
        return $this->requestJson('POST', '/api/client/servers/'. $this->server_id."/power", $data);
    }

        
}
