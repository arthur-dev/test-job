<?php
/**
 * Created by PhpStorm.
 * User: arthur
 * Date: 10/10/16
 * Time: 13:00
 */

namespace AppBundle\Service;


use AppBundle\Entity\BuyShampooAndGetConditionnerForHalfOffer;
use AppBundle\Entity\ThreeForTwoOffer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

//app_importData_service

class ImportDataService
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var
     */
    protected $serializer;

    /**
     * @var CalculateOrderTotalService
     */
    protected $update;

    public function __construct($serializer,EntityManager $em,CalculateOrderTotalService $update)
    {
        $this->em = $em;
        $this->serializer = $serializer;
        $this->update = $update;
    }

    public function import($data,$offer)
    {
       // $order = $this->serializer->deserialize($data, 'AppBundle\Entity\Order', 'xml');


        $order = $this->serializer->deserialize($data,'AppBundle\Entity\Order' ,  'xml');
        $order->initiateOffers();

        if ($offer == 1)
        {
            $order->addOffer(new ThreeForTwoOffer());
        }
        if ($offer == 2)
        {
            $order->addOffer(new BuyShampooAndGetConditionnerForHalfOffer());
        }

        $this->update->SetOrderTotal($order);

        $this->em->persist($order);
        $this->em->flush();
        
    }




}