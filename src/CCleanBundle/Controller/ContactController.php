<?php
/**
 * Created by PhpStorm.
 * User: j1v3
 * Date: 02/02/17
 * Time: 19:59
 */
namespace CCleanBundle\Controller;

use CCleanBundle\Entity\Contact;
use CCleanBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Contact controller.
 *
 */
class ContactController extends Controller
{
    /**
     * @Route("/", name="contact")
     */
    public function contactAction()
    {
        $contact = new Contact();

        $form = $this->createForm(new ContactType(), $contact);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {

            $form->bind($request);

            if ($form->isValid()) {

                var_dump($contact);die;
                $mailFrom = $this->container->getParameter('mailer_user');
                $message = \Swift_Message::newInstance()
                    ->setSubject('Demande de contact depuis www.cclean-nettoyage.fr')
                    ->setFrom($mailFrom)
//                    ->setTo('cclean.bectard@gmail.com')
                    ->setTo($mailFrom)
                    ->setBody($this->renderView('contact/contactEmail.txt.twig',
                        array('contact' => $contact)));

                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->Add('notice', 'Votre message a bien été envoyé, nous y répondrons dans les meilleurs délais. Merci !');

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('home'));
            }
        }

        return $this->render('contact/contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}