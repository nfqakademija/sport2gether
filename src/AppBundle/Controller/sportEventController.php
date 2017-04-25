<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Form\EventFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class sportEventController extends Controller
{
    /**
     * @Route("/createEvent")
     */
    public function createEventAction(Request $request)
    {
        $event = new Event();
        $form = $this->createForm(EventFormType::class, $event);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            /**todo need to add logged user ID*/
            //$event->setCoach(1);
            $em->persist($event);
            $em->flush();

            $this->addFlash('success', 'Sekmingai sukurta');
            return $this->redirectToRoute('app_sportevent_createevent');
        }
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
