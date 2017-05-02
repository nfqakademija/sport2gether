<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EventSearch;
use AppBundle\Entity\Event;
use AppBundle\Form\EventFormType;
use AppBundle\Form\EventSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class sportEventController extends Controller
{
    /**
     * @Route("/showEvents", name="searchEvents")
     */
    public function searchEventsAction(Request $request)
    {
        $eventSearch = new EventSearch();
        $form = $this->createForm(EventSearchType::class, $eventSearch);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $title = $eventSearch->getTitle();
            $city = $eventSearch->getCity() ? $eventSearch->getCity()->getTitle() : null;
            $category = $eventSearch->getCategory() ? $eventSearch->getCategory()->getTitle() : null;
             $em = $this->getDoctrine()->getManager();
             $events = $em->getRepository('AppBundle:Event')
                 ->findAllByTitle($title,$city,$category);


             if(!$events){
                 throw $this->createNotFoundException('Such event does not exist!');
             }

             return $this->render('AppBundle:sportEvent:view_event.html.twig',[
                 'events'=>$events
             ]);
        }

        return $this->render('AppBundle:sportEvent:search_event.html.twig', [
            'eventSearchForm' => $form->createView()
        ]);
    }


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
     * @Route("/viewEvent/{id}")
     */
    public function viewEventAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Event');
        $event = $repository->find($id);


        return $this->render('AppBundle:sportEvent:event_item.html.twig', array(
            'event' => $event
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
