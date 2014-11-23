<?php

class sqlConnClass {
    private $dbhost = 'localhost';
    private $dbuser = '';
    private $dbpass = '';
    private $dbname = '';
    protected $dbconn;
    
    protected function __construct() {
        $dbh = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        $this->dbconn = $dbh;
    }
}