<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Event;

class UserController extends Controller
{
    /**
     * @Route("/", name="show_all_events")
     */
    public function indexAction()
    {
        $events = $this->getDoctrine()->getRepository('AppBundle:Event')->findAll();

        return $this->render('AppBundle:User:index.html.twig', array("events" => $events));
    }
}
