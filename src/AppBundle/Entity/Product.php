<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Created by PhpStorm.
 * User: arthur
 * Date: 10/10/16
 * Time: 09:25
 */
class Product
{

    /**
     * @var integer
     */
    private $uid;

    /**
     * @var string
     * @JMS\XmlAttribute
     */
    private $title;

    /**
     * @var string
     */
    private $category;

    /**
     * @var float
     * @JMS\XmlAttribute
     */
    private  $price;

    public function __construct($title = null, $category = null,$price = null)
    {
        $this->title = $title;
        $this->category = $category;
        $this->price = $price;
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }


}