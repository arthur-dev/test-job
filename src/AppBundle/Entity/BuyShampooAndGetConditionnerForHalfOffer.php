<?php
/**
 * Created by PhpStorm.
 * User: arthur
 * Date: 10/10/16
 * Time: 11:01
 */

namespace AppBundle\Entity;


use AppBundle\Model\OfferInterface;

class BuyShampooAndGetConditionnerForHalfOffer extends Offer
{
    public function isEligibleOrder(Order $order)
    {
        if ($order->getProducts()->count() >= 2)
        {
            foreach($order->getProducts() as $product)
            {
                if ($product->getCategory() == "Shampoo")
                {
                    foreach($order->getProducts() as $product)
                    {
                        if ($product->getCategory() == "Conditioner")
                        {
                            return true;
                        }
                    }
                }
            }
        }
        else
            return false;
    }

    public function getDiscount(Order $order)
    {
        foreach($order->getProducts() as $product)
        {
            if ($product->getCategory() == "Conditioner")
            {
                return $product->getPrice()/2;
            }
        }
    }
}