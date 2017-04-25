<?php

namespace AppBundle\Controller;

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
        $form = $this->createForm(EventSearchType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data =$form->getData();
             $title = $data['title'];
             $city = $data['city']->getTitle();
             $category = $data['category']->getTitle();
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
        $form = $this->createForm(EventFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());die;
        }

        return $this->render('AppBundle:sportEvent:create_event.html.twig', [
            'eventForm' => $form->createView()
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
