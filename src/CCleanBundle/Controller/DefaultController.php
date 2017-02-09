<?php
namespace CCleanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->render('CCleanBundle:Default:index.html.twig');
    }

    /**
     * @Route("/sitemap", name="sitemap")
     */
    public function sitemapAction()
    {
        return $this->render('CCleanBundle:Default:sitemap.html.twig');
    }
}
