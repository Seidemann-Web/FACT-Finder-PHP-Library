<?php
namespace FACTFinder\Custom\Core;

class ParametersConverter extends \FACTFinder\Core\ParametersConverter
{
    /**
     * convertClientToServerParameters
     * 
     * Modified to map oxid sorting and paging
     * 
     * @param Parameters $clientParameters Parameters obtained from a request to
     *        the client.
     * @return Parameters Parameters ready for use with FACT-Finder.
     */
    public function convertClientToServerParameters($clientParameters)
    {
        $result = clone $clientParameters;
        $this->applySortingMapping($result);
        $this->applyPagingMapping($result);
        
        return parent::convertClientToServerParameters($result);
    }
    
    /**
     * applySortingMapping
     * 
     * map oxid sorting ('listorder' => DIRECTION and 'listorderby' => SORTVALUE)
     * to sorting by FACT-Finder (sortSORTVALUE => DIRECTION)
     * 
     * @param Parameters $clientParameters
     * @return Parameters
     */
    protected function applySortingMapping($clientParameters)
    {
        if(!isset($clientParameters['listorderby']))
            return;
        if (!$clientParameters['listorder'])
            $clientParameters['listorder'] = 'desc';
        
        $oConfig = class_exists('oxRegistry') ? \oxRegistry::getConfig() : \oxConfig::getInstance();
        $aMapping = $oConfig->getConfigParam('aSwFFSortMapping');
        if (isset($aMapping[$clientParameters['listorderby']])) {
            $paramName = 'sort'.$aMapping[$clientParameters['listorderby']];
        } elseif($oConfig->getConfigParam('bSwFFUseSortings')) {
            $paramName = 'sort'.$clientParameters['listorderby'];
        }
        $clientParameters[$paramName] = $clientParameters['listorder'];
    }
    
    /**
     * applyPagingMapping
     * 
     * map oxid pagination to pagination by FACT-Finder
     * 'pgNr' => 'page' and +1 because oxid starts at 0 and FF at 1
     * 
     * @param Parameters $clientParameters
     * @return Parameters
     */
    protected function applyPagingMapping($clientParameters)
    {
        if(isset($clientParameters['pgNr'])) {
            $clientParameters['page'] = $clientParameters['pgNr'] + 1;
            unset($clientParameters['pgNr']);
        }
    }
    
    
    /**
     * convertServerToClientParameters
     * 
     * modified to reverse sort and paging mapping
     * 
     * @param Parameters $clientParameters Parameters obtained from FACT-Finder.
     * @return Parameters Parameters ready for use in requests to the client.
     */
    public function convertServerToClientParameters($serverParameters)
    {
        $result = clone $serverParameters;
        $this->reverseSortingMapping($result);
        $this->reversePagingMapping($result);
        
        return parent::convertServerToClientParameters($result);
    }
    
    /**
     * reverseSortingMapping
     * 
     * map sorting by FACT-Finder (sortSORTVALUE => DIRECTION)
     * to oxid sorting ('listorder' => DIRECTION and 'listorderby' => SORTVALUE)
     * 
     * @param Parameters $serverParameters
     * @return Parameters
     */
    protected function reverseSortingMapping($serverParameters)
    {
        $oConfig = class_exists('oxRegistry') ? \oxRegistry::getConfig() : \oxConfig::getInstance();
        if ($oConfig->getConfigParam('bSwFFUseSortings')) {
            foreach ($serverParameters->getArray() as $name => $value) {
                if (strpos($name, 'sort') !== 0) {
                    continue;
                }
                $serverParameters['listorder'] = $value;
                $serverParameters['listorderby'] = substr($name, 4);
                unset($serverParameters[$name]);
            }
        } else {
            $aMapping = $oConfig->getConfigParam('aSwFFSortMapping');
            foreach ($aMapping as $oxidValue => $FFParamSuffix) {
                $FFParamName = 'sort' . $FFParamSuffix;
                if (!isset($serverParameters[$FFParamName]))
                    continue;
                $serverParameters['listorder'] = $serverParameters[$FFParamName];
                $serverParameters['listorderby'] = $oxidValue;
                unset($serverParameters[$FFParamName]);
            }
        }
    }
    
    /**
     * reversePagingMapping
     * 
     * map FACT-Finder pagination to pagination by oxid
     * 'page' => 'pgNr' and -1 because oxid starts at 0 and FF at 1
     * 
     * @param Parameters $serverParameters
     * @return Parameters
     */
    protected function reversePagingMapping($serverParameters)
    {
        if(isset($serverParameters['page'])) {
            $serverParameters['pgNr'] = $serverParameters['page'] - 1;
            if($serverParameters['pgNr'] <= 0)
                unset($serverParameters['pgNr']);
        }
    }
    
    /**
     * modified to get required parameters from oxid if possible
     * 
     * Adds keys to an array of parameters according to the given require rules.
     * @param Parameters $parameters Parameters to be modified.
     * @param string[] $ignoreRules Array of required parameters. The keys are
     *        the names of the required parameter, the values are default values
     *        to be used if the parameter is not present.
     */
    protected function addRequiredParameters($parameters, $requireRules)
    {
        //oxid pushes all params from seourl into $_GET
        //$_REQUEST is not updated can therefore not be used
        $aCallParams = array_merge($_GET, $_POST);
        foreach ($requireRules as $k => $v)
            if (!isset($parameters[$k])) {
                if($clientVal = $aCallParams[$k])
                    $parameters[$k] = $clientVal;
                else
                    $parameters[$k] = $v;
            }
    }
}
