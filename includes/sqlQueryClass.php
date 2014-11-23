<?php
require 'sqlConnClass';

class sqlQueryClass extends sqlConnClass {
    
    public $res;
    
    function queryMysqli($query) {
        $conn = new sqlConnClass();
        $result = mysqli_query($conn->dbconn, $query);
        $this->res = $result;
    }
}
