<?php
namespace FACTFinder\Custom\Adapter;

use FACTFinder\Loader as FF;

class Tracking extends \FACTFinder\Adapter\Tracking
{
    /**
     * Use this method directly if you want to separate the setup from sending
     * the request. This is particularly useful when using the
     * MultiCurlRequestFactory.
     */
    public function setupClickTracking(
        $id,
        $query,
        $pos,
        $masterId = null,
        $sid = null,
        $cookieId = null,
        $origPos = -1,
        $page = 1,
        $simi = 100.0,
        $title = '',
        $pageSize = 12,
        $origPageSize = -1,
        $userId = null,
        $campaign = null,
        $instoreAds = false
    ) {
        parent::setupClickTracking($id, $query, $pos, $masterId, $sid, $cookieId, $origPos, $page, $simi, $title, $pageSize, $origPageSize, $userId, $campaign, $instoreAds);
        $this->_convertParameters();
    }

    /**
     * Use this method directly if you want to separate the setup from sending
     * the request. This is particularly useful when using the
     * MultiCurlRequestFactory.
     */
    public function setupCartTracking(
        $id,
        $masterId = null,
        $title = '',
        $query = null,
        $sid = null,
        $cookieId = null,
        $count = 1,
        $price = null,
        $userId = null,
        $campaign = null,
        $instoreAds = false
    ) {
        parent::setupCartTracking($id, $masterId, $title, $query, $sid, $cookieId, $count, $price, $userId, $campaign, $instoreAds);
        $this->_convertParameters();
    }

    /**
     * Use this method directly if you want to separate the setup from sending
     * the request. This is particularly useful when using the
     * MultiCurlRequestFactory.
     */
    public function setupCheckoutTracking(
        $id,
        $masterId = null,
        $title = '',
        $query = null,
        $sid = null,
        $cookieId = null,
        $count = 1,
        $price = null,
        $userId = null,
        $campaign = null,
        $instoreAds = false
    ) {
        parent::setupCheckoutTracking($id, $masterId, $title, $query, $sid, $cookieId, $count, $price, $userId, $campaign, $instoreAds);
        $this->_convertParameters();
    }

    /**
     * Use this method directly if you want to separate the setup from sending
     * the request. This is particularly useful when using the
     * MultiCurlRequestFactory.
     */
    public function setupRecommendationClickTracking(
        $id,
        $mainId,
        $masterId = null,
        $sid = null,
        $cookieId = null,
        $userId = null
    ) {
        parent::setupRecommendationClickTracking($id, $mainId, $masterId, $sid, $cookieId, $userId);
        $this->_convertParameters();
    }

    /**
     * Use this method directly if you want to separate the setup from sending
     * the request. This is particularly useful when using the
     * MultiCurlRequestFactory.
     */
    public function setupLoginTracking(
        $sid = null,
        $cookieId = null,
        $userId = null
    ) {
        parent::setupLoginTracking($sid, $cookieId, $userId);
        $this->_convertParameters();
    }

    /**
     * @deprecated Use _convertParameters() instead.
     */
    protected function _converParameters()
    {
        return $this->_convertParameters();
    }


    /**
     * Convert all set parameters with decodeClientUrlData.
     */
    protected function _convertParameters()
    {
        $params = $this->parameters->getArray();
        $this->parameters->clear();
        $params = $this->encodingConverter->decodeClientUrlData($params);
        $this->parameters->setAll($params);
    }
}
