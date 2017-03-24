<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ratingproduct;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ratingproduct controller.
 *
 */
class RatingproductController extends Controller
{
    /**
     * Lists all ratingproduct entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ratingproducts = $em->getRepository('AppBundle:Ratingproduct')->findAll();

        return $this->render('ratingproduct/index.html.twig', array(
            'ratingproducts' => $ratingproducts,
        ));
    }

    /**
     * Creates a new ratingproduct entity.
     *
     */
    public function newAction(Request $request)
    {
        $ratingproduct = new Ratingproduct();
        $form = $this->createForm('AppBundle\Form\RatingproductType', $ratingproduct);
        $form->handleRequest($request);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $val = $user->getId();
        $ratingproduct->setUserId($val);
       

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ratingproduct);
            $em->flush($ratingproduct);

            return $this->redirectToRoute('ratingproduct_show', array('id' => $ratingproduct->getId()));
        }

        return $this->render('ratingproduct/new.html.twig', array(
            'ratingproduct' => $ratingproduct,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ratingproduct entity.
     *
     */
    public function showAction(Ratingproduct $ratingproduct)
    {
        $deleteForm = $this->createDeleteForm($ratingproduct);

        return $this->render('ratingproduct/show.html.twig', array(
            'ratingproduct' => $ratingproduct,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ratingproduct entity.
     *
     */
    public function editAction(Request $request, Ratingproduct $ratingproduct)
    {
        $deleteForm = $this->createDeleteForm($ratingproduct);
        $editForm = $this->createForm('AppBundle\Form\RatingproductType', $ratingproduct);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ratingproduct_edit', array('id' => $ratingproduct->getId()));
        }

        return $this->render('ratingproduct/edit.html.twig', array(
            'ratingproduct' => $ratingproduct,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ratingproduct entity.
     *
     */
    public function deleteAction(Request $request, Ratingproduct $ratingproduct)
    {
        $form = $this->createDeleteForm($ratingproduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ratingproduct);
            $em->flush($ratingproduct);
        }

        return $this->redirectToRoute('ratingproduct_index');
    }

    /**
     * Creates a form to delete a ratingproduct entity.
     *
     * @param Ratingproduct $ratingproduct The ratingproduct entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ratingproduct $ratingproduct)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ratingproduct_delete', array('id' => $ratingproduct->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
