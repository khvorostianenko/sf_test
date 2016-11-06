<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\Version;

use Doctrine\ORM\Query;
use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends FOSRestController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * Display a list of all users
     * /users
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cgetUsersAction(){
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');
        $query = $repository->createQueryBuilder('u')->select('u')->getQuery();
        $result = $query->getResult(Query::HYDRATE_ARRAY);
        $view = $this->view($result, 200);
        return $this->handleView($view);
    }

    /**
     * Display a specific user
     * /users/{$user}
     * @param $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getUserAction(User $user){
        $view = $this->view($user, 200);
        return $this->handleView($view);
    }
    
    /**
     * Delete a specific user
     *  /users/{$user}
     * @param $user
     * @return \FOS\RestBundle\View\View
     */
    public function deleteUserAction(User $user){

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $result = 'Delete user with username '.$user;

        $view = $this->view($result, 200);
        return $this->handleView($view);
    }

    /**
     * Update a specific user
     * /users/{$id}/username
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putUsersUsernameAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $username = $request->headers->get('username');
        if(!$username){
            throw $this->createNotFoundException(
                'You don\'t entered username for id =   '.$id
            );
        }
        $user->setUsername($username);
        $em->flush();

        $result = 'Update product with id '.$user->getId();

        $view = $this->view($result, 200);
        return $this->handleView($view);
    }

}
