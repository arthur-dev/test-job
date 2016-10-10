<?php

namespace AppBundle\Entity;
use AppBundle\Model\OfferInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Created by PhpStorm.
 * User: arthur
 * Date: 10/10/16
 * Time: 10:19
 */

use JMS\Serializer\Annotation as JMS;

class Order
{

    /**
     * @var integer
     */
    private $uid;

    /**
     * @var float
     * @JMS\Type("float")
     */
    private $total;

    /**
     * @var ArrayCollection
     * @JMS\Type("ArrayCollection<AppBundle\Entity\Product>")
     * @JMS\XmlList(entry="product")
     */
    private $products;

    /**
     * @var ArrayCollection
     */
    private $offers;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->offers = new ArrayCollection();
        $this->total = 0;
    }

    public function addOffer(OfferInterface $offer)
    {
        $this->offers->add($offer);
    }

    public function removeOffer(OfferInterface $offer)
    {
        $this->offers->removeElement($offer);
    }

    public function getOffers()
    {
        return $this->offers;
    }

    public function initiateOffers()
    {
        return $this->offers = new ArrayCollection();
    }

    public function addProduct(Product $product)
    {
        $this->products->add($product);
    }

    public function removeProduct(Product $product)
    {
        $this->products->removeElement($product);
    }

    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return int
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param int $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }


}