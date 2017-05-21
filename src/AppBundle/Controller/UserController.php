<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Coach;
use AppBundle\Form\CoachFormType;
use ReCaptcha\ReCaptcha;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Event;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @Route("/edit", name="coach_edit")
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        $coach = $user->getCoach();
        $form = $this->createForm(CoachFormType::class, $coach);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($coach);
            $em->flush();

        }
        return $this->render('@App/Coach/edit.html.twig', [
            'coachForm' => $form->createView()
        ]);

    }
}
