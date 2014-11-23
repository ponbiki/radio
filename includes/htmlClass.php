<?php

class htmlClass {
    
    public $username;
    public $loggedin;
    public $admin;
    public $navigation;
    public $logo;
    
    public function __construct() {
        
        session_start();
        
        if (isset($_SESSION['user'])) {
            $this->username = $_SESSION['user'];
            $this->loggedin = TRUE;
        } else {
            $this->loggedin = FALSE;
        }
        
        if (isset($_SESSION['admin'])) {
            $this->admin = TRUE;
        } else {
            $this->admin = FALSE;
        }
        
        if ($this->loggedin) {
            $this->navigation = "<div class='navbar'>[<a href='controlpanel.php' title='Control Panel'>"
                    . "Control Panel</a> / <a href='logout.php' title='Logout'>Logout</a>]</div>\n";
        } else {
            $this->navigation = "<div class='navbar'>"
                    . "[<a href='login.php' title='Control Panel'>Control Panel</a>]</div>\n";
        }
        
        $this->logo = "<div class='logo'><h1 title='New York Internet'>New York Internet</h1></div>\n";
        
    }
    
    public function htmlHeader($title, $meta, $scripts = array()) {
        echo <<<_END
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset=UTF-8">

        <title>$title</title>

        <meta name="robots" content="NYI, New York Internet Company, $meta" />

        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />

_END;
 
        foreach ($scripts as $x) {
            echo "$x\n\n";
        }
        
        echo <<<_END
       <link rel="stylesheet" href="css/my.css" type="text/css" />\n
       <link rel="stylesheet" href="css/menu.css" type="text/css" />\n
       <link rel="stylesheet" href="css/print.css" type="text/css" />\n

    </head>

    <body>

_END;
    }    
    
    public function htmlTail() {
        echo <<<_END
    </body>
</html>
_END;
    }
}
