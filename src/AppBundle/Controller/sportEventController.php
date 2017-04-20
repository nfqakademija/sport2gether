<?php

namespace AppBundle\Controller;

use AppBundle\Form\creatEventFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class sportEventController extends Controller
{
    /**
     * @Route("/createEvent")
     */
    public function createEventAction()
    {
        $form = $this->createForm(creatEventFormType::class);
        return $this->render('AppBundle:sportEvent:create_event.html.twig', [
            'createEventForm' => $form->createView()
        ]);

    }

    /**
     * @Route("/editEvent")
     */
    public function editEventAction()
    {
        return $this->render('AppBundle:sportEvent:edit_event.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/joinEvent")
     */
    public function joinEventAction()
    {
        return $this->render('AppBundle:sportEvent:join_event.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/viewEvent")
     */
    public function viewEventAction()
    {
        return $this->render('AppBundle:sportEvent:view_event.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/searchEvent")
     */
    public function searchEventAction()
    {
        return $this->render('AppBundle:sportEvent:search_event.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/listEvents")
     */
    public function listEventsAction()
    {
        return $this->render('AppBundle:sportEvent:list_events.html.twig', array(
            // ...
        ));
    }

}
