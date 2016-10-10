<?php

namespace AppBundle\Service;
use AppBundle\Entity\Order;

/**
 * Created by PhpStorm.
 * User: arthur
 * Date: 10/10/16
 * Time: 11:49
 */

//app_calculateOrderTotal_service

class CalculateOrderTotalService
{

    public function __construct()
    {

    }

    public function calculateOrderTotal(Order $order)
    {
        $discount = 0;
        $totalPrice  = 0;

        foreach($order->getOffers() as $offer)
        {
            $discount+= $offer->returnDiscount($order);
        }

        foreach($order->getProducts() as $product)
        {
          $totalPrice+= $product->getPrice();
        }

        $totalPrice-= $discount;

        return $totalPrice;
    }

    public function SetOrderTotal(Order $order)
    {
        $total = $this->calculateOrderTotal( $order);
        $order->setTotal($total);
    }
}