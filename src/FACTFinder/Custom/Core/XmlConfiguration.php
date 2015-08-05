<?php
namespace FACTFinder\Custom\Core;

class XmlConfiguration extends \FACTFinder\Core\XmlConfiguration
{
    /**
     * use user credentials of backend user instead of shop user
     * 
     * @var bool 
     */
    protected $isBackendUser = false;

    /**
     * getChannel
     * 
     * modified to return shop language specific channel
     * 
     * @return string
     */
    public function getChannel()
    {
        if(class_exists('oxRegistry')) {
            $oLang = \oxRegistry::getLang();
            $oConfig = \oxRegistry::getConfig();
        } else {
            $oLang = \oxLang::getInstance();
            $oConfig = \oxConfig::getInstance();
        }
        $sChannel = parent::getChannel();
        // #1085
        if($oConfig->getConfigParam("bl_perfLoadLanguages")) {
            $sChannel .= '_' . $oLang->getLanguageAbbr();
        }
        return $sChannel;
    }

    public function useBackendUser()
    {
        $this->isBackendUser = true;
    }

    public function getUserName()
    {
        if(!$this->isBackendUser)
            return parent::getUserName();
        $oConfig = class_exists('oxRegistry') ? \oxRegistry::getConfig() : \oxConfig::getInstance();
        return $oConfig->getConfigParam('sSwFFAdminUser');
    }

    public function getPassword()
    {
        if(!$this->isBackendUser)
            return parent::getPassword();
        $oConfig = class_exists('oxRegistry') ? \oxRegistry::getConfig() : \oxConfig::getInstance();
        return $oConfig->getConfigParam('sSwFFAdminPassword');
    }

}
