<?php 

namespace Tugayilhan\Pterodactyl\EndPoints\Clients\Server;
use Tugayilhan\Pterodactyl\EndPoints\Clients\ServerClientsActions;

class FilesClientsActions extends ServerClientsActions {

    protected $servers;
    

    public function __construct($servers)
    {
      $this->servers =   $servers;
    }


    public function listFiles(string $directory = ".cache")
    {   
       return $this->servers->requestJson('GET', '/api/client/servers/'. $this->servers->server_id ."/files/list");
    }
    
    public function fileContents(string $file_name)
    {
        return $this->servers->requestJson('GET', '/api/client/servers/' . $this->servers->server_id . '/files/contents?file='. $file_name);
    }
    public function fileDownload( string $file_name)
    {
        $reponse = $this->servers->requestJson('GET', '/api/client/servers/' . $this->servers->server_id . '/files/download?file='. $file_name);
        $reponse = json_decode($reponse['response']);
        return $reponse->attributes->url;
    }
    public function reNameFile(string $old_file_name, string $new_file_name, string $direcotory = "")
    {   
            $arr = [
                'root' => "/".$direcotory,
                'files' => [
                    [
                        'from' => $old_file_name,
                        'to'  =>  $new_file_name,
                    ],
                ],
            ];
            return $this->requestJson('PUT', '/api/client/servers/' . $this->servers->server_id . '/files/rename', $arr);
    }
    /*
    public function copyFile(string $server_id, $file_name)
    {
        $reponse = $this->requestJson('GET', '/api/client/servers/' . $server_id . '/files/copy?file='. $file_name);
        $reponse = json_decode($reponse['response']);
        return $reponse->attributes->url;

    }
    */
    public function writeFile( string $file_name, string $fileContents)
    {   
       return $this->servers->requestJson('POST', '/api/client/servers/' . $this->servers->server_id . '/files/write?file=' . $file_name, $fileContents);
    }
 
    public function compressFiles( array $files,  string $directory = "")
    {   
        if($directory);
            $arr['root'] = "/".$directory;
        $arr['files'] =  $files;
        return $this->servers->requestJson('POST', '/api/client/servers/' . $this->servers->server_id . '/files/compress', $arr);
    }
    public function decompressFiles( string $file,  string $directory = "")
    {   
        if($directory);
            $arr['root'] = "/".$directory;
        $arr['file'] =  $file;
        
        return $this->servers->requestJson('POST', '/api/client/servers/' . $this->servers->server_id . '/files/decompress', $arr);
    }
    public function deleteFiles(array $file_names, string $direcotory = "")
    {   
            $data = [
                'root' => '/'.$direcotory,
                'files' => $file_names
            ];
            
            return $this->requestJson('POST', '/api/client/servers/' . $this->servers->server_id . '/files/delete', $data);
    }
    public function createFolder(string $folderName,  string $directory = "")
    {   
        if($directory);
            $arr['root'] = "/".$directory;
        $arr['name'] =  $folderName;

        return $this->servers->requestJson('POST', '/api/client/servers/' . $this->servers->server_id . '/files/create-folder', $arr);
    }
}