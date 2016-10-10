<?php

namespace AppBundle\Model;
use AppBundle\Entity\Order;

/**
 * Created by PhpStorm.
 * User: arthur
 * Date: 10/10/16
 * Time: 10:58
 */
Interface OfferInterface
{
    /**
     * @return float
     */
    public function returnDiscount(Order $order);

    /**
     * @return boolean
     */
    public function isEligibleOrder(Order $order);

    /**
     * @return float
     */
    public function getDiscount(Order $order);
}