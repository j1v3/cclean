<?php

namespace CCleanBundle\Controller;

use CCleanBundle\Entity\Testimonial;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Testimonial controller.
 *
 * @Route("testimonial")
 */
class TestimonialController extends Controller
{
    /**
     * Lists all testimonial entities.
     *
     * @Route("/", name="testimonial_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $testimonials = $em->getRepository('CCleanBundle:Testimonial')->findTestimonialByActive();

        return $this->render('testimonial/index.html.twig', array(
            'testimonials' => $testimonials,
        ));
    }

    /**
     * Creates a new testimonial entity.
     *
     * @Route("/new", name="testimonial_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function newAction(Request $request)
    {
        $testimonial = new Testimonial();
        $form = $this->createForm('CCleanBundle\Form\TestimonialType', $testimonial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $client = $this->container->get('security.context')->getToken()->getUser();

            $em = $this->getDoctrine()->getManager();
            $testimonial->setClientId($client);
            $em->persist($testimonial);
            $em->flush($testimonial);

            return $this->redirectToRoute('testimonial_show', array('id' => $testimonial->getId()));
        }

        return $this->render('testimonial/new.html.twig', array(
            'testimonial' => $testimonial,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/publish", name="testimonial_publish")
     * @param Request $request
     * @param Testimonial $testimonial
     * @Security("has_role('ROLE_USER')")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function publishAction(Request $request, Testimonial $testimonial) {

        $client = $this->container->get('security.context')->getToken()->getUser();

        $mailFrom = $this->container->getParameter('mailer_user');
        $message = \Swift_Message::newInstance()
            ->setSubject('Vous avez un nouvel avis sur www.cclean-nettoyage.fr')
            ->setFrom($mailFrom)
//                    ->setTo('cclean.bectard@gmail.com')
            ->setTo($mailFrom)
            ->setBody($this->renderView('testimonial/testimonialEmail.html.twig',
                array(
                    'testimonial' => $testimonial,
                    'client' => $client)),
                    'text/html')
        ;

        $this->get('mailer')->send($message);

        $this->get('session')->getFlashBag()->Add('notice', 'Merci pour votre avis, il sera validé par notre webmaster dans les meilleurs délais...');

        return $this->redirectToRoute('home');
    }

    /**
     * Validate testimonial entity.
     *
     * @Route("/{id}/validate", name="testimonial_validate")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     * @param Testimonial $testimonial
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function validateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $testimonial = $em->getRepository('CCleanBundle:Testimonial')->findBy(array('id' => $id));
//        echo "<pre>";
//        var_dump($testimonial[0]->getIsActive());die;

            $testimonial[0]->setIsActive(1);
            $testimonial[0]->setValidatedAt( new DateTime() );
            $em->persist($testimonial[0]);
            $em->flush($testimonial[0]);

        $this->get('session')->getFlashBag()->Add('notice', 'Cet avis est maintenant publié sur le site...');

        return $this->redirectToRoute('testimonial_show', array('id' => $testimonial[0]->getId()));
    }

    /**
     * Finds and displays a testimonial entity.
     *
     * @Route("/{id}", name="testimonial_show")
     * @Security("has_role('ROLE_USER')")
     * @Method("GET")
     */
    public function showAction(Testimonial $testimonial)
    {
        $deleteForm = $this->createDeleteForm($testimonial);

        return $this->render('testimonial/show.html.twig', array(
            'testimonial' => $testimonial,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing testimonial entity.
     *
     * @Route("/{id}/edit", name="testimonial_edit")
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Testimonial $testimonial)
    {
        $deleteForm = $this->createDeleteForm($testimonial);
        $editForm = $this->createForm('CCleanBundle\Form\TestimonialType', $testimonial);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('testimonial_show', array('id' => $testimonial->getId()));
        }

        return $this->render('testimonial/edit.html.twig', array(
            'id' => $testimonial->getId(),
            'testimonial' => $testimonial,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a testimonial entity.
     *
     * @Route("/{id}", name="testimonial_delete")
     * @Security("has_role('ROLE_USER')")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Testimonial $testimonial)
    {
        $form = $this->createDeleteForm($testimonial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($testimonial);
            $em->flush($testimonial);
        }

        $this->get('session')->getFlashBag()->Add('notice', 'Cet avis est maintenant supprimé...');

        return $this->redirectToRoute('home');
    }

    /**
     * Creates a form to delete a testimonial entity.
     *
     * @param Testimonial $testimonial The testimonial entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Testimonial $testimonial)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('testimonial_delete', array('id' => $testimonial->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
