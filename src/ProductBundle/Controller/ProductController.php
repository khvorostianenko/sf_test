<?php

namespace ProductBundle\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\Version;

use Doctrine\ORM\Query;
use FOS\RestBundle\Controller\FOSRestController;
use ProductBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;

/**
     * @RouteResource("Product")
     */
class ProductController extends FOSRestController
//    extends Controller
{
//    /**
//     * @Route("/")
//     */
//    public function indexAction()
//    {
//        return $this->render('ProductBundle:Default:index.html.twig');
//    }

    /**
     * /products/{$id}/price
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putPriceAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('ProductBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $price = $request->headers->get('price');
        $product->setPrice($price);
        $em->flush();

        $result = 'Update product with id '.$product->getId();

        $view = $this->view($result, 200);
        return $this->handleView($view);
    }

    /**
     * /products/new
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $name = $request->headers->get('name');
        $price = $request->headers->get('price');

        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        //return new Response('Saved new product with id '.$product->getId());
        $result = 'Saved new product with id '.$product->getId();

        $view = $this->view($result, 200);
        return $this->handleView($view);
    }

    /**
     * /products
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cgetAction(){
        $repository = $this->getDoctrine()->getRepository('ProductBundle:Product');
        $query = $repository->createQueryBuilder('p')->select('p')->getQuery();
        $result = $query->getResult(Query::HYDRATE_ARRAY);
        $view = $this->view($result, 200);
        return $this->handleView($view);
    }


    /**
     * /products/{$product}
     * @param $product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction(Product $product){
        $view = $this->view($product, 200);
        return $this->handleView($view);
    }

    /**
     *  /products/{$product}
     * @param $product
     * @return \FOS\RestBundle\View\View
     */
    public function deleteAction(Product $product){

        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }
}
