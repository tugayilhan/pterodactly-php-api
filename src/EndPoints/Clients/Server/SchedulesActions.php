<?php 

namespace Tugayilhan\Pterodactyl\EndPoints\Clients\Server;
use Tugayilhan\Pterodactyl\EndPoints\Clients\ServerClientsActions;

class SchedulesClientsActions extends ServerClientsActions {

    protected $servers;
    
    protected int $schedule_id;

    protected int $task_id;

    public function __construct($servers)
    {
      $this->servers =   $servers;
    }

    public function setScheduleId(int $schedule_id)
    {
      $this->schedule_id = $schedule_id;

    }
    public function getScheduleId()
    {
      return $this->schedule_id;

    }
    public function setTaskId(int $task_id)
    {
      $this->task_id = $task_id;

    }
    public function getTaskId()
    {
      return $this->task_id;

    }

    public function list()
    {
      return $this->servers->requestJson('GET', '/api/client/servers/'. $this->servers->server_id ."/schedules/");
    }
    public function create(string $name, bool $is_active, string $minute, string $hour, string $day_of_week, string $day_of_month)
    {
      $data = [
        'name' => $name,
        'is_active' => $is_active,
        'minute'   => $minute,
        'hour'  => $hour,
        'day_of_week' => $day_of_week,
        'day_of_month' => $day_of_month

      ];
      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/schedules", $data);
    }

    public function detail()
    {
      return $this->servers->requestJson('GET', '/api/client/servers/'. $this->servers->server_id ."/schedules/".$this->getScheduleId());
    }

    public function update(string $name, bool $is_active, string $minute, string $hour, string $day_of_week, string $day_of_month)
    {
      $data = [
        'name' => $name,
        'is_active' => $is_active,
        'minute'   => $minute,
        'hour'  => $hour,
        'day_of_week' => $day_of_week,
        'day_of_month' => $day_of_month
      ];
      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/schedules/".$this->getScheduleId(), $data);
    }

    /*
      action => command, power, backup
    */


    public function createTask(string $action, string $payload, string $time_offset)
    {
      $data = [
        'aciton' => $action,
        'payload' => $payload,
        'time_offset' => $time_offset
      ];
      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/schedules/".$this->getScheduleId()."/tasks", $data);
    

    }

    public function updateTask(string $action, string $payload, string $time_offset)
    {
      $data = [
        'aciton' => $action,
        'payload' => $payload,
        'time_offset' => $time_offset
      ];
      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/schedules/".$this->getScheduleId()."/tasks/".$this->getTaskId(), $data);
    }

    public function deleteTask()
    {
      return $this->servers->requestJson('POST', '/api/client/servers/'. $this->servers->server_id ."/schedules/".$this->getScheduleId()."/tasks/".$this->getTaskId());
    }

    


}