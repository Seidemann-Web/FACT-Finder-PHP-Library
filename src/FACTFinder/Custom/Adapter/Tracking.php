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
        $userid = null
    ) {
        parent::setupClickTracking($id, $query, $pos, $masterId, $sid, $cookieId, $origPos, $page, $simi, $title, $pageSize, $origPageSize, $userid);
        $this->_converParameters();
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
        $userid = null
    ) {
        parent::setupCartTracking($id, $masterId, $title, $query, $sid, $cookieId, $count, $price, $userid);
        $this->_converParameters();
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
        $userid = null
    ) {
        parent::setupCheckoutTracking($id, $masterId, $title, $query, $sid, $cookieId, $count, $price, $userid);
        $this->_converParameters();
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
        $userid = null
    ) {
        parent::setupRecommendationClickTracking($id, $mainId, $masterId, $sid, $cookieId, $userid);
        $this->_converParameters();
    }

    /**
     * Use this method directly if you want to separate the setup from sending
     * the request. This is particularly useful when using the
     * MultiCurlRequestFactory.
     */
    public function setupLoginTracking(
        $sid = null,
        $cookieId = null,
        $userid = null
    ) {
        parent::setupLoginTracking($sid, $cookieId, $userid);
        $this->_converParameters();
    }
    
    protected function _converParameters()
    {
        $params = $this->parameters->getArray();
        $this->parameters->clear();
        $params = $this->encodingConverter->decodeClientUrlData($params);
        $this->parameters->setAll($params);
    }
}
