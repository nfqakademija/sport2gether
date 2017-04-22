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
        $form = $this->createForm(EventFormType::class);
        //check if submited
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $event = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            //dump($form->getData());die;
            $this->addFlash('success', 'Genus created!');
            //return $this->redirectToRoute('createEvent');
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
