<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Ratinguser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
            ));
    }

    /**
     * Finds and displays a user entity.
     *
     */
    public function showAction(Request $request, User $user)
    {

        $ratinguser = new Ratinguser();
        $form = $this->createForm('AppBundle\Form\RatinguserType', $ratinguser);
        $form->handleRequest($request);
        $usere = $this->get('security.token_storage')->getToken()->getUser();
        $val = $usere->getId();
        $userad = $user->getId();
        $ratinguser->setUserId($userad);
        $ratinguser->setUser($usere);
        $user_id = $val;


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ratinguser);
            $em->flush($ratinguser);

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        $em = $this->getDoctrine()->getManager();
        $ratinguser = $em->getRepository('AppBundle:Ratinguser')->findBy(array('userId'=> $userad));

            return $this->render('user/show.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
            'ratinguser' => $ratinguser,
            ));
    }
}
