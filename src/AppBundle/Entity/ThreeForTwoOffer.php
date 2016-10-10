<?php
/**
 * Created by PhpStorm.
 * User: arthur
 * Date: 10/10/16
 * Time: 11:00
 */

namespace AppBundle\Entity;


use AppBundle\Model\OfferInterface;
use Doctrine\Common\Collections\ArrayCollection;

class ThreeForTwoOffer extends Offer
{
    public function isEligibleOrder(Order $order)
    {
        if ($order->getProducts()->count() >= 3)
            return true;
        else
            return false;
    }

    public function getDiscount(Order $order)
    {
        $cheapest = $this->getCheapestProduct($order->getProducts());

        return $cheapest->getPrice();
    }

    public function getCheapestProduct(ArrayCollection $products)
    {
        $productMin = $products->first();

        foreach($products as $product)
        {
            if ( $product->getPrice() < $productMin->getPrice() )
            {
                $productMin = $product;
            }
        }

        return $productMin;
    }
}