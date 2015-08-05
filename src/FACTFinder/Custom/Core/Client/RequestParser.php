<?php
namespace FACTFinder\Custom\Core\Client;

use FACTFinder\Loader as FF;

/**
 * Extracts several data from the request made to the client.
 */
class RequestParser extends \FACTFinder\Core\Client\RequestParser
{
    /**
     * allow reseting to reevalute $_POST and $_SERVER['QUERY_STRING']
     */
    public function reset()
    {
        $this->clientRequestParameters = null;
        $this->serverRequestParameters = null;
        $this->requestTarget = null;
    }
}