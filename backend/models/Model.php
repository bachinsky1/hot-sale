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

    protected $file = __DIR__ . '/../database/database.json';
    public function __construct()
    {
        $this->app = Application::getInstance();
        $db = file_get_contents($this->file);
        $this->db = json_decode($db, true);

        $log = new Logger('name');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../../logs/log.log', Level::Debug));
        $this->log = $log;
        
    }
    

}