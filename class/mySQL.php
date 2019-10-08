<?php
class MySQL {
    
    public $dbc;
    
    public function __construct() 
    {
        $config = require 'config/database.php';
            
        $this->dbc = new PDO("mysql:host=" . $config["HOST"] . ";dbname=". $config["DB"],$config["USERNAME"],$config["PASSWORD"]);
    
        $this->dbc->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $this->dbc->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        
    }
   
    
}
 
