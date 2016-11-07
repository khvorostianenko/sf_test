<?php

namespace ProductBundle\Controller;

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
{
    /**
     * Add new product
     * /products/new
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $name = $request->query->get('name');
        $price = $request->query->get('price');

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
     * Display a list of all products
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
     * Display a specific product
     * /products/{$product}
     * @param $product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction(Product $product){
        $view = $this->view($product, 200);
        return $this->handleView($view);
    }

    /**
     * Delete a specific product
     *  /products/{$product}
     * @param $product
     * @return \FOS\RestBundle\View\View
     */
    public function deleteAction(Product $product){

        $id = $product->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        $result = 'Delete product with id= '.$id;

        $view = $this->view($result, 200);
        return $this->handleView($view);
    }

    /**
     * Update a specific product
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

        $price = $request->query->get('price');
        $product->setPrice($price);
        $em->flush();

        $result = 'Update product with id '.$product->getId();

        $view = $this->view($result, 200);
        return $this->handleView($view);
    }



}
