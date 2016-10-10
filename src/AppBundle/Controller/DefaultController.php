<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        //init du serializer
        $encoders = array(new XmlEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);


        /*
        $product = new Product('nom','category',2.31);
        $xmlContent = $serializer->serialize($product, 'xml');
        dump($xmlContent);
        */

        $data = <<<EOF
            <product title="titre">

                <category>cate</category>
                <price>2</price>
            </product>
EOF;

        $person = $serializer->deserialize($data, 'AppBundle\Entity\Product', 'xml');

        dump($person);

        $order = new Order();
        $tot = $this->get('app_calculateOrderTotal_service')->calculateOrderTotal($order);


        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
}
