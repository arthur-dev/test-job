<?php
/**
 * Created by PhpStorm.
 * User: arthur
 * Date: 10/10/16
 * Time: 11:05
 */

namespace AppBundle\Entity;


use AppBundle\Model\OfferInterface;

abstract class Offer implements OfferInterface
{
    /**
     * @var float
     */
    private $uid;

    /**
     * @return float
     */
    public function returnDiscount(Order $order)
    {
        if ($this->isEligibleOrder($order))
        {
            return $this->getDiscount($order);
        }
        else
        return 0;
    }

    public function isEligibleOrder(Order $order)
    {

    }

    public function getDiscount(Order $order)
    {

    }

    /**
     * @return float
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param float $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }


}