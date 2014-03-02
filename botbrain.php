<!-- #!/usr/bin/php -q -->

<?php

require_once 'functions.php';

$server = 'bobba.7chan.org'; //irc server address
$port = 6667; // port usually 6667 or 6697 for ssl
$botnick = 'd[^_^]b'; // irc nick
$botname = 'djbot'; //irc ident field
$realname = 'Tiesto'; //irc ident field
$nspass = 'P455w0rd1!'; //nickserv pass
$ownerid = 'ponbiki!asdf@I.is.confused'; // owner 
$channel = '#BitchBot';  // initial join channel
$switch = 1; //force true value used for infinite loop
$nowdj = ''; //currently streaming DJ

$dbserver = mysql_connect($dbhost, $dbuser, $dbpass);
if(!db_server) {
    die(mysqlerror());
} else {
    echo "ok1";
}
mysql_select_db($dbname) or die(mysql_error());
$query = 'SELECT usernames FROM djs';
$result = mysql_query($query);
if(!result) {
    die(mysql_error());
} else {
    echo "ok2";
}
mysql_close($db_server);
$rows = mysql_num_rows($result);
$djlist = mysql_result($result);
echo $rows;
/*
//force unlimited time to run
set_time_limit(0);

//open connection with socket
$socket = fsockopen($server, $port);

//auth
fputs($socket,"USER ".$botname." * 8 :".$realname."\n");
sleep(5); //temp solution to allow time for ircd needs replaced with proper command queue
fputs($socket,"NICK ".$botnick."\n");

//join
sleep(5); //temp solution same as above
fputs($socket,"PRIVMSG NickServ :IDENTIFY ".$nspass."\n");
fputs($socket,"JOIN $channel\n");

//infinite looooop
while($switch) {
    while($data = fgets($socket, 128)) {
        //echo $data;
        //will switch commenting if i want to browser execute
        echo "<pre>".nl2br($data)."</pre>";
        flush();
        //seperate the datas
        $ex = explode(' ', $data);
        //pingpong
        if($ex[0] == "PING") {
            fputs($socket, "PONG ". $ex[1]."\n");
        }

        // looks for command keywords amongst the raw irc input
        $command = str_replace(array(chr(10), chr(13)), '', $ex[3]);

		//autojoin on channel invite
		if ($ex[1] == "INVITE" && $ex[2] == $botnick) fputs($socket,"JOIN ".trim($ex[3], ":")."\n");
		
		// allows universally accessible commands
		if ($ex[0] != ":".$ownerid || $ex[0] == ":".$ownerid) {
			switch($command) {
				case ":;ping":   exec("ping -c 3 ".trim($ex[4]), $output);
					foreach($output as $msg) {
						fputs($socket,"PRIVMSG ".$ex[2]." :".$msg."\n");
						$output = "";
					}
				break;
                                case ":;nap":	 preg_match("/^:([^!]+)!/",$ex[0],$match);
					fputs($socket,"PRIVMSG ".$ex[2]." :Get bent ".$match[1]."\n");
				break;
                                case ":;on":    preg_match("/^:([^!]+)!/",$ex[0],$match);
                                        fputs($socket,"PRIVMSG ".$ex[2]." :".$match[1]." is now streaming on 7chan Radio.\n");
                                        $nowdj = $match[1];
                                break;
                                case ":;off":    preg_match("/^:([^!]+)!/",$ex[0],$match);
                                        fputs($socket,"PRIVMSG ".$ex[2]." :7chan Radio is now off the air.\n");
                                        $nowdj = '';
                                break;                            
			}
		}
		if ($ex[0] == ":".$ownerid) {    // only allows auth user to command
			switch($command) {
				case ":!join":   fputs($socket,"JOIN ".$ex[4]."\n");
				break;
				case ":!part":   fputs($socket,"PART ".$ex[4]." :". implode(' ',array_slice($ex, 5)) ."\n");
				break;
				case ":!quit":   fputs($socket,"QUIT :". implode(' ',array_slice($ex, 4)) ."\n");
					$switch = 0;
				break;
				case ":!nick";   fputs($socket,"NICK :".$ex[4]."\n");
				break;				
				case ":!say":    fputs($socket,"PRIVMSG ".$ex[4]." :". implode(' ',array_slice($ex, 5)) ."\n");
				break;
				case ":!do":     fputs($socket,"PRIVMSG ".$ex[4]." :".chr(1)."ACTION ". implode(' ',array_slice($ex, 5))."".chr(1)."\n");
				break;
				case ":!notice": fputs($socket,"NOTICE ".$ex[4]." :". implode(' ',array_slice($ex, 5)) ."\n");
				break;
				case ":!mode":   fputs($socket,"MODE ".$ex[4]." :". implode(' ',array_slice($ex, 5)) ."\n");
				break;
				case ":!kick":   fputs($socket,"KICK ".$ex[4]." ".$ex[5]." :". implode(' ',array_slice($ex, 6)) ."\n");
				break;
				case ":!memo":   fputs($socket,"PRIVMSG MemoServ :SEND ".$ex[4]." ". implode(' ',array_slice($ex, 5)) ."\n");
				break;
				case ":!info":   fputs($socket,"PRIVMSG ".$ex[2]." :". exec("uname -a") ."\n");
					fputs($socket,"PRIVMSG ".$ex[2]." :". exec("uptime") ."\n");
				break;
				case ":!target": $victim = $ex[4];
					$ragelevel = $ex[5];
				break;
			}
		}
    }
}

function objectsIntoArray($arrObjData, $arrSkipIndices = array()) {
	$arrData = array();
   
	// if input is object, convert into array
	if (is_object($arrObjData)) {
		$arrObjData = get_object_vars($arrObjData);
	}
   
	if (is_array($arrObjData)) {
		foreach ($arrObjData as $index => $value) {
			if (is_object($value) || is_array($value)) {
				$value = objectsIntoArray($value, $arrSkipIndices); // recursive call
			}
			if (in_array($index, $arrSkipIndices)) {
				continue;
			}
			$arrData[$index] = $value;
		}
	}
	return $arrData;
} */
?>
