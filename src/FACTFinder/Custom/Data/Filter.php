<?php
namespace FACTFinder\Custom\Data;

/**
 * Represents a particular clickable filter within the After Search Navigation
 * (ASN).
 */
class Filter extends \FACTFinder\Data\Filter
{
    private $bSelectable = true;

    /**
     * @return string
     */
    public function setSelectable($bSelectable)
    {
        $this->bSelectable = $bSelectable;
    }

    /**
     * wheter filter should be selectable/clickable
     * 
     * @return bool
     */
    public function isSelectable()
    {
        return $this->bSelectable;
    }
}
