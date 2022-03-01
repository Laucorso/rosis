<?php

namespace App;

use App\Exceptions\AsteriskManagerException;

class AsteriskManager
{
    public $server = null;
    public $port = 5038;
    private $_socket;

    public function __construct($params = array())
    {
        $this->server = config('app.asterisk_server');
        if (isset($params['auto_connect'])) {
            $this->connect();
        }
    }

    private function _checkSocket()
    {
        if (!$this->_socket) {
            throw new AsteriskManagerException(AsteriskManagerException::NOSOCKET);
        }
    }

    private function _sendCommand($command, $terminationString = null, $stripTerminator = true)
    {
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".$command."\n", FILE_APPEND );
        if (!fwrite($this->_socket, $command)) {
            throw new AsteriskManagerException(AsteriskManagerException::CMDSENDERR);
        }

        $response = false;
        $break = false;
        while (!$break && $line = fgets($this->_socket)) {
            if (!empty($terminationString) && strstr($line, $terminationString) !== false ) {
                $break = true;
                if (!$stripTerminator) {
                    $response .= $line;
                }
            } else {
                $response .= $line;
            }

        }

        if (!$response) {
            throw new AsteriskManagerException(AsteriskManagerException::RESPERR);
        }
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".$response."\n", FILE_APPEND );
        return $response;
    }

    public function connect()
    {
        if ($this->_socket) {
            $this->close();
        }
        
        if ($this->_socket = fsockopen($this->server, $this->port)) {
            stream_set_timeout($this->_socket, 3);
            return true;
        }
        
        throw new AsteriskManagerException (AsteriskManagerException::CONNECTFAILED);
    }

    public function login($username, $password, $authtype = null, $eventsoff = false)
    {
        $this->_checkSocket();
        $events = $eventsoff ? "Events: off\r\n": "";
        
        if (strtolower($authtype) == 'md5') {
            $response = $this->_sendCommand(
                "Action: Challenge\r\n"
                ."AuthType: MD5\r\n\r\n"
            );
            if (strpos($response, "Response: Success") !== false) {
                $challenge = trim(substr($response,
                    strpos($response, "Challenge: ")+strlen("Challenge: ")));

                $md5_key  = md5($challenge . $password);
                $response = $this->_sendCommand("Action: Login\r\nAuthType: MD5\r\n"
                    ."Username: {$username}\r\n"
                    ."Key: {$md5_key}\r\n$events\r\n");
            } else {
                throw new AsteriskManagerException(AsteriskManagerException::AUTHFAIL);
            }
        } else {
            $response = $this->_sendCommand(
                "Action: login\r\n"
                ."Username: {$username}\r\n"
                ."Secret: {$password}\r\n$events\r\n",
                'Message: Authentication',
                false
            );
        }

        if (strpos($response, "Message: Authentication accepted") !== false) {
            return true;
        }
        throw new AsteriskManagerException(AsteriskManagerException::AUTHFAIL);
    }

    public function logout()
    {
        $this->_checkSocket();       
        $this->_sendCommand("Action: Logoff\r\n\r\n");
        return true;
    }

    public function close()
    {
        $this->_checkSocket();
        return fclose($this->_socket);
    }

    public function command($command)
    {
        $this->_checkSocket();
        $response = $this->_sendCommand("Action: Command\r\n"."Command: $command\r\n\r\n", "--END COMMAND--");
        if (strpos($response, 'No such command') !== false) {
            throw new AsteriskManagerException(AsteriskManagerException::NOCOMMAND);
        }
        return $response;
    }

    public function ping()
    {
        $this->_checkSocket();
        $response = $this->_sendCommand("Action: Ping\r\n\r\n", "Response", false);
        if (strpos($response, "Pong") === false) {
            return false;
        }
        return true;
    }

    public function originateCall( $extension, $channel, $context, $cid, $priority = 1, $timeout = 30000, $variables = null, $action_id = null )
    {
        $this->_checkSocket();
        $command = "Action: Originate\r\nChannel: $channel\r\n"."Context: $context\r\nExten: $extension\r\nPriority: $priority\r\n"."Callerid: $cid\r\nTimeout: $timeout\r\n";
        if ( $variables && count($variables) > 0) {
            $chunked_vars = array();
            foreach ($variables as $key => $val) {
                $chunked_vars[] = "$key=$val";
            }
            $chunked_vars = implode('|', $chunked_vars);
            $command     .= "Variable: $chunked_vars\r\n";
        }
        if ($action_id) {
            $command .= "ActionID: $action_id\r\n";
        }
        $this->_sendCommand($command."\r\n");
        return true;
    }

    public function getQueues()
    {
        $this->_checkSocket();
        $response = $this->_sendCommand("Action: Queues\r\n\r\n");
        return $response;
    }

    public function queueAdd($queue, $handset, $penalty = null, $memberName = null)
    {
        $this->_checkSocket();       
        $command = "Action: QueueAdd\r\nQueue: $queue\r\n"
                    ."Interface: $handset\r\n";

        if ($memberName) {
            $command .= "MemberName: $memberName\r\n";
        }
        if ($penalty) {
            $this->_sendCommand($command."Penalty: $penalty\r\n\r\n");
            return true;
        }
        $this->_sendCommand($command."\r\n");
        return true;
    }

    public function queueRemove($queue, $handset)
    {
        $this->_checkSocket();

        $this->_sendCommand(
            "Action: QueueRemove\r\nQueue: $queue\r\n"
            ."Interface: $handset\r\n\r\n"
        );
        return true;
    }
    
    public function queuePause($queue, $handset)
    {
        $this->_checkSocket();

        $this->_sendCommand(
            "Action: QueuePause\r\nQueue: $queue\r\n"
            ."Interface: $handset\r\n"
            ."Paused: True\r\n\r\n"
        );
        return true;
    }
    
    public function queueUnpause($queue, $handset)
    {
        $this->_checkSocket();
        $this->_sendCommand(
            "Action: QueuePause\r\nQueue: $queue\r\n"
            ."Interface: $handset\r\n"
            ."Paused: False\r\n\r\n"
        );
        return true;
    }

    public function startMonitor($channel, $filename, $format, $mix = null)
    {
        $this->_checkSocket();
        $response = $this->_sendCommand(
            "Action: Monitor\r\nChannel: $channel\r\n"
            ."File: $filename\r\nFormat: $format\r\n"
            ."Mix: $mix\r\n\r\n"
        );

        if (strpos($response, "Success") === false) {
            throw new AsteriskManagerException(AsteriskManagerException::MONITORFAIL);
        } else {
            return true;
        }
    }

    public function stopMonitor($channel)
    {
        $this->_checkSocket();

        $this->_sendCommand(
            "Action: StopMonitor\r\n"
            ."Channel: $channel\r\n\r\n"
        );
        return true;
    }

    public function getChannelStatus($channel = null)
    {
        $this->_checkSocket();

        $response = $this->_sendCommand(
            "Action: Status\r\nChannel: "
            ."$channel\r\n\r\n"
        );

        return $response;
    }

    public function getSipPeers()
    {
        $this->_checkSocket();

        $response = $this->_sendCommand("Action: Sippeers\r\n\r\n", 'ListItems', false);
        return $response;
    }

    public function getIaxPeers()
    {
        $this->_checkSocket();

        $response = $this->_sendCommand(
            "Action: IAXPeers\r\n\r\n",
            ' iax2 peers',
            false
        );
        return $response;
    }

    public function parkedCalls()
    {
        $this->_checkSocket();

        $response = $this->_sendCommand(
            "Action: ParkedCalls\r\n"
            ."Parameters: ActionID\r\n\r\n",
            'ParkedCallsComplete'
        );
        return $response;
    }
}

