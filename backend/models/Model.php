<?php
declare(strict_types=1);

namespace App\Models;

use App\Application;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

abstract class Model
{
    protected $app;
    protected $db;
    protected $log;
    protected $dbFile = __DIR__ . '/../database/database.json';
    protected $logFile = __DIR__ . '/../../logs/log.log';

    public function __construct()
    {
        $this->app = Application::getInstance();
        $db = file_get_contents($this->dbFile);
        $this->db = json_decode($db, true);
        
        if (!file_exists($this->logFile)) {
            mkdir(__DIR__ . '/../../logs', 0777, true); 
            touch($this->logFile);
        }

        $log = new Logger('name');
        $log->pushHandler(new StreamHandler($this->logFile, Level::Debug));
        $this->log = $log;
    }
    

}