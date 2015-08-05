<?php
namespace FACTFinder\Custom\Core\Server;

use \FACTFinder\Loader as FF;

/**
 * This implementation backs the Request with a MultiCurlDataProvider.
 */
class MultiCurlRequestFactory extends \FACTFinder\Core\Server\MultiCurlRequestFactory
{
    
    /**
     * allow reseting to reevalute $_POST and $_SERVER['QUERY_STRING']
     */
    public function reset()
    {
        global $dic;
        $dic['requestParser']->reset();
        $this->requestParameters = $dic['requestParser']->getRequestParameters();
    }
}
