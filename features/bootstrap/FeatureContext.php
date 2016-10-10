<?php


/**
 * Created by PhpStorm.
 * User: arthur
 * Date: 10/10/16
 * Time: 09:08
 */

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Behat\Behat\Hook\Scope\AfterFeatureScope;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeFeatureScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class FeatureContext extends RawMinkContext implements Context, SnippetAcceptingContext, KernelAwareContext
{

    use KernelDictionary;

    /**
     * @var \AppBundle\Entity\Order
     */
    private $order;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {

    }


    /**
     * @BeforeScenario
     *
     * @param BeforeScenarioScope $scope
     */
    public function setupScenario(BeforeScenarioScope $scope)
    {
        $this->order = new \AppBundle\Entity\Order();
    }

    /**
     * @Given /^the "([^"]+)" offer is enabled$/
     */
    public function thatOfferIsEnabled($offerName)
    {
        if ($offerName == '3 for the price of 2')
        {
            $this->order->addOffer(new \AppBundle\Entity\ThreeForTwoOffer());
        }
        if ($offerName == 'Buy Shampoo & get Conditioner for 50% off')
        {
            $this->order->addOffer(new \AppBundle\Entity\BuyShampooAndGetConditionnerForHalfOffer());
        }
    }

    /**
     * @Given /^the "([^"]+)" offer is disabled$/
     */
    public function thatOfferIsDisabled($offerName)
    {
        if ($offerName == '3 for the price of 2')
        {
            $this->order->removeOffer(new \AppBundle\Entity\ThreeForTwoOffer());
        }
        if ($offerName == 'Buy Shampoo & get Conditioner for 50% off')
        {
            $this->order->removeOffer(new \AppBundle\Entity\BuyShampooAndGetConditionnerForHalfOffer());
        }
    }

    /**
     * @When /^the following products are put on the order$/
     */
    public function loadOrder(TableNode $table)
    {
        $hash = $table->getHash();

        foreach($hash as $newProduct)
        {
            $product = new \AppBundle\Entity\Product($newProduct['Title'],$newProduct['Category'],$newProduct['Price']);
            $this->order->addProduct($product);
        }

        //var_dump($this->order);
    }


    /**
     * @Then /^I should get the “([^"]+)” for free$/
     */
    public function Ishouldget($productName)
    {
        foreach($this->order->getOffers() as $offer)
        {
            if (get_class($offer) == 'AppBundle\Entity\ThreeForTwoOffer'  )
            {
                if ($offer->isEligibleOrder( $this->order))
                return true;
            }
        }
        throw new \Exception();
    }

    /**
     * @Then /^I should not get anything for free$/
     */
    public function IshouldNotget()
    {
        foreach($this->order->getOffers() as $offer)
        {
            if (get_class($offer) == 'AppBundle\Entity\ThreeForTwoOffer'  )
            {
                if ($offer->isEligibleOrder( $this->order))
                    throw new \Exception();

            }
        }
       return true;
    }


    /**
     * @Then /^I should get a 50% discount on “([^"]+)”$/
     */
    public function Ishouldget50($productName)
    {
        foreach($this->order->getOffers() as $offer)
        {
            var_dump(get_class($offer));
            if (get_class($offer) == 'AppBundle\Entity\BuyShampooAndGetConditionnerForHalfOffer'  )
            {
                if ($offer->isEligibleOrder( $this->order))
                    return true;
            }
        }
        throw new \Exception();
    }



    /**
     * @Then /^the order total should be "([^"]+)"$/
     */
    public function theOrderTotalShouldBe($orderTotal)
    {
        $tot = $this->getContainer()->get('app_calculateOrderTotal_service')->calculateOrderTotal($this->order);

        // == float
        if (abs(($tot-floatval($orderTotal))/floatval($orderTotal)) < 0.0000001 )
            return true;
        else
            throw new \Exception();
    }




}