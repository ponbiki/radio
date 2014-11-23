<?php

class sqlConnClass {
    private $dbhost = 'localhost';
    private $dbuser = 'cbdb-rw';
    private $dbpass = 'K&n5wj!kj3X';
    private $dbname = 'cpdb';
    protected $dbconn;
    
    protected function __construct() {
        $dbh = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        $this->dbconn = $dbh;
    }
}