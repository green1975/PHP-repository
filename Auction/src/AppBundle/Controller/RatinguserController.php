<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ratinguser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ratinguser controller.
 *
 */
class RatinguserController extends Controller
{
    /**
     * Lists all ratinguser entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ratingusers = $em->getRepository('AppBundle:Ratinguser')->findAll();

        return $this->render('ratinguser/index.html.twig', array(
            'ratingusers' => $ratingusers,
        ));
    }

    /**
     * Creates a new ratinguser entity.
     *
     */
    public function newAction(Request $request)
    {
        $ratinguser = new Ratinguser();
        $form = $this->createForm('AppBundle\Form\RatinguserType', $ratinguser);
        $form->handleRequest($request);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $val = $user->getId();
        $ratinguser->setUserId($val);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ratinguser);
            $em->flush($ratinguser);

            return $this->redirectToRoute('ratinguser_show', array('id' => $ratinguser->getId()));
        }

        return $this->render('ratinguser/new.html.twig', array(
            'ratinguser' => $ratinguser,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ratinguser entity.
     *
     */
    public function showAction(Ratinguser $ratinguser)
    {
        $deleteForm = $this->createDeleteForm($ratinguser);

        return $this->render('ratinguser/show.html.twig', array(
            'ratinguser' => $ratinguser,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ratinguser entity.
     *
     */
    public function editAction(Request $request, Ratinguser $ratinguser)
    {
        $deleteForm = $this->createDeleteForm($ratinguser);
        $editForm = $this->createForm('AppBundle\Form\RatinguserType', $ratinguser);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ratinguser_edit', array('id' => $ratinguser->getId()));
        }

        return $this->render('ratinguser/edit.html.twig', array(
            'ratinguser' => $ratinguser,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ratinguser entity.
     *
     */
    public function deleteAction(Request $request, Ratinguser $ratinguser)
    {
        $form = $this->createDeleteForm($ratinguser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ratinguser);
            $em->flush($ratinguser);
        }

        return $this->redirectToRoute('ratinguser_index');
    }

    /**
     * Creates a form to delete a ratinguser entity.
     *
     * @param Ratinguser $ratinguser The ratinguser entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ratinguser $ratinguser)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ratinguser_delete', array('id' => $ratinguser->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
