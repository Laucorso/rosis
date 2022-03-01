<?php

namespace App\Exceptions;

use Exception;

class AsteriskManagerException extends Exception
{
    const NOSOCKET      = 'No socket defined';
    const AUTHFAIL      = 'Authorisation failed';
    const CONNECTFAILED = 'Connection failed';
    const NOCOMMAND     = 'Unknown command specified';
    const NOPONG        = 'No response to ping';
    const NOSERVER      = 'No server specified';
    const MONITORFAIL   = 'Monitoring of channel failed';
    const RESPERR       = 'Server didn\'t respond as expected';
    const CMDSENDERR    = 'Sending of command failed';
}
