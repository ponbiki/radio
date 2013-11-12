<?php
class ircConnectionClass {
    private $socket;

    function IRCConnection($host, $port = 6667, $ssl = false) {
        $this->socket = fsockopen($host, $port);
    }

    function Send($message) {
        fputs($this->$socket, $message."\n");
    }

    function Read($length = null) {
        return fgets($this->$socket, $length);
    }

    function Join($channel, $key = '') {
        return $this->Send("JOIN $channel $key");
    }

    function Msg($target, $message) {
        return $this->Send("PRIVMSG $target");
    }
}
?>
