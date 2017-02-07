<?php

namespace CCleanBundle\Controller;

use CCleanBundle\Entity\Average;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Average controller.
 *
 * @Route("average")
 */
class AverageController extends Controller
{
    /**
     * Lists all average entities.
     *
     * @Route("/", name="average_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $averages = $em->getRepository('CCleanBundle:Average')->findAll();

        return $this->render('average/index.html.twig', array(
            'averages' => $averages,
        ));
    }

    /**
     * Creates a new average entity.
     *
     * @Route("/new", name="average_new")
     * @Method({"GET", "POST"})
     */
    public function newAction()
    {
        $average = new Average();

        $em = $this->getDoctrine()->getManager();
        $nb = count($em->getRepository('CCleanBundle:Testimonial')->findBy(array('isActive' => 1)));
        $notes = $em->getRepository('CCleanBundle:Testimonial')->findTotalNoteByActive();

        $total = 0;
            foreach ($notes as $key => $item) {
                $total += $item['note'];
            }

        $result = round( $total/$nb, 1, PHP_ROUND_HALF_UP);
        $average->setScore($result);
        $em->persist($average);
        $em->flush($average);

        return $this->render('average/show.html.twig', array(
            'id' => $average->getId(),
            'result' => $average->getScore()));
    }

    /**
     * Finds and displays a average entity.
     *
     * @Route("/{id}", name="average_show")
     * @Method("GET")
     */
    public function showAction(Average $average)
    {
        $deleteForm = $this->createDeleteForm($average);

        return $this->render('average/show.html.twig', array(
            'average' => $average,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing average entity.
     *
     * @Route("/{id}/edit", name="average_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Average $average)
    {
        $deleteForm = $this->createDeleteForm($average);
        $editForm = $this->createForm('CCleanBundle\Form\AverageType', $average);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('average_edit', array('id' => $average->getId()));
        }

        return $this->render('average/edit.html.twig', array(
            'average' => $average,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a average entity.
     *
     * @Route("/{id}", name="average_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Average $average)
    {
        $form = $this->createDeleteForm($average);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($average);
            $em->flush($average);
        }

        return $this->redirectToRoute('average_index');
    }

    /**
     * Creates a form to delete a average entity.
     *
     * @param Average $average The average entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Average $average)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('average_delete', array('id' => $average->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
