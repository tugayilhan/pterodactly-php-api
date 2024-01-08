<?php 

namespace Tugayilhan\Pterodactyl;
use Tugayilhan\Pterodactyl\EndPoints\Clients\AccountClientsActions;
use Tugayilhan\Pterodactyl\EndPoints\Clients\ServerClientsActions;

use Tugayilhan\Pterodactyl\EndPoints\Clients\Server\BackupsClientsActions;
use Tugayilhan\Pterodactyl\EndPoints\Clients\Server\DatabaseClientsActions;
use Tugayilhan\Pterodactyl\EndPoints\Clients\Server\FilesClientsActions;
use Tugayilhan\Pterodactyl\EndPoints\Clients\Server\NetworkClientsActions;
use Tugayilhan\Pterodactyl\EndPoints\Clients\Server\SchedulesClientsActions;
use Tugayilhan\Pterodactyl\EndPoints\Clients\Server\SettingsClientsActions;
use Tugayilhan\Pterodactyl\EndPoints\Clients\Server\StartupClientsActions;
use Tugayilhan\Pterodactyl\EndPoints\Clients\Server\UsersClientsActions;

class Pterodactyl

{
    protected $api_key;

    protected $base_url;

    public $api_type;

    public $servers;
    

    public $accountActions;


    public function __construct($api_key, $base_url, $api_type = 'client')
    {
        $this->api_type = $api_type;
        $this->api_key = $api_key;
        $this->base_url = $base_url;
        $this->servers = new ServerClientsActions($this);
        $this->servers->backupsActions = new BackupsClientsActions($this->servers);
        $this->servers->databaseActions = new DatabaseClientsActions($this->servers);
        $this->servers->filesActions = new FilesClientsActions($this->servers);
        $this->servers->networkActions = new NetworkClientsActions($this->servers);
        $this->servers->schedulesActions = new SchedulesClientsActions($this->servers);
        $this->servers->settingsActions = new SettingsClientsActions($this->servers);
        $this->servers->startupActions = new StartupClientsActions($this->servers);
        $this->servers->usersActions = new UsersClientsActions($this->servers);
        $this->accountActions = new AccountClientsActions($this);
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