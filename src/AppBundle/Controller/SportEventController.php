<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\EventSearch;
use AppBundle\Entity\Event;
use AppBundle\Form\EventFormType;
use AppBundle\Form\EventSearchType;
use ReCaptcha\ReCaptcha;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\CssSelector\XPath\Extension\CombinationExtension;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Facebook\Facebook;

class SportEventController extends Controller
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
             $em = $this->getDoctrine()->getManager();
             $events = $em->getRepository('AppBundle:Event')
                 ->findAllByTitle($title,$city);

             return $this->render('@App/SportEvent/result.html.twig',[
                 'events'=>$events
             ]);
        }

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Event');
        $events = $repository->findAllOrderByDate();

        return $this->render('AppBundle:SportEvent:search_event.html.twig', [
            'eventSearchForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/showNewestEventsAction", name="show_newest")
     */
    public function showNewestEventsAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Event');
        $events = $repository->findAllOrderByDate();

        return $this->render('AppBundle:SportEvent:result.html.twig', [
            'events' => $events,
        ]);
    }


    /**
     * @Route("/createEvent", name="create_event")
     */
    public function createEventAction(Request $request)
    {
        if ($this->isGranted('ROLE_COACH')) {
            $event = new Event();
            $form = $this->createForm(EventFormType::class, $event);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $file = $event->getImage();
                if(!empty($file)) {
                    $fileName = $this->get('app.image_uploader')->upload($file);
                    $event->setImage($fileName);
                }
                $em = $this->getDoctrine()->getManager();
                $user = $this->getUser();
                $event->setCoach($user->getCoach());
                $em->persist($event);
                $em->flush();

                $appId = '377571242640422';
                $appSecret = '572ca2118f7bff76d9cc0bff3adcd244';
                $pageId='1891646464413478';
                $userAccessToken = 'EAAFXZAifLhCYBACQy15xVXIfxaszefM26fVJfLoBHVMYneyUxa06yzV7uebBXYhHABC16wz3WpVRtZBZAVWmF7gAARLPJPh7vHxBFWvpJhHYcUlWv81NOj1XFY156wrJKmySZAxlcAaWhZAZBPifwx6yZCAZBxze9qtHXgzbAlVHhBsC9tyZApDLFtOJDF2AvEcwZD';
                $fb = new Facebook([
                    'app_id' => $appId,
                    'app_secret' => $appSecret,
                    'default_graph_version' => 'v2.5'
                ]);
                $longLivedToken = $fb->getOAuth2Client()->getLongLivedAccessToken($userAccessToken);
                $fb->setDefaultAccessToken($longLivedToken);
                $response = $fb->sendRequest('GET', $pageId, ['fields' => 'access_token'])
                    ->getDecodedBody();
                $foreverPageAccessToken = $response['access_token'];
                $fb = new Facebook([
                    'app_id' => $appId,
                    'app_secret' => $appSecret,
                    'default_graph_version' => 'v2.5'
                ]);

                $fb->setDefaultAccessToken($foreverPageAccessToken);
                $fb->sendRequest('POST', "$pageId/feed", [
                    'name' => $event->getTitle(),
                    'description' => $event->getDescription(),
                    'picture' => $event->getImage(),
                    'link' => 'http://sport2gether.projektai.nfqakademija.lt/viewEvent/'.$event->getId()
                ]);

                $this->addFlash('success', 'Sekmingai sukurta');
                return $this->redirectToRoute('coachEvents');
            }
            return $this->render('AppBundle:SportEvent:create_event.html.twig', [
                'createEventForm' => $form->createView()
            ]);
        }
        else {
            return $this->redirectToRoute('registerCoach');
        }


    }

    /**
     * @Route("/editEvent")
     */
    public function editEventAction()
    {
        return $this->render('AppBundle:SportEvent:edit_event.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/joinEvent")
     */
    public function joinEventAction()
    {
        return $this->render('AppBundle:SportEvent:join_event.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/viewEvent/{id}", name="viewEvent")
     */
    public function viewEventAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Event');
        $event = $repository->find($id);
        return $this->render('AppBundle:SportEvent:event_item.html.twig', array(
            'event' => $event
        ));
    }

    /**
     * @Route("/searchEvent")
     */
    public function searchEventAction()
    {
        return $this->render('AppBundle:SportEvent:search_event.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/listEvents")
     */
    public function listEventsAction()
    {
        return $this->render('AppBundle:SportEvent:list_events.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/addComment/{id}", name="addComment")
     * @Method({"POST","GET"})
     */
    public function addCommentAction(Request $request, $id)
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->getUser();
            $comment = new Comment();
            $content = $request->request->get('comment');
            $recaptcha = new ReCaptcha('6LdX3yEUAAAAAOEa-PyccdZkoW5nu027O-rvZPE0');
            $resp = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());
            if(!$resp->isSuccess()){
                $response = new JsonResponse();
                $response->setStatusCode(Response::HTTP_BAD_REQUEST);
                $response->setData(['message'=>'Verify yourself']);
                return $response;
            }
            if(!empty($content) && $resp->isSuccess()) {
                    $comment->setContent($content);
                    $comment->setCreatedAtDate(new \DateTime('NOW'));
                    $comment->setAuthor($user);
                    $repository = $this->getDoctrine()->getRepository('AppBundle:Event');
                    $event = $repository->findOneBy(['id' => $id]);
                    $comment->setEvent($event);
                    $event->addComment($comment);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($comment);
                    $em->persist($event);
                    $em->flush();
            }

            return new Response();
        }
        else {
          return $this->redirectToRoute('fos_user_security_login');
        }
    }

    /**
     * @Route("/showComments/{id}", name="showComments")
     * @Method({"GET"})
     */
    public function showCommentsAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Event');
        $event = $repository->findOneBy(['id'=>$id]);
        $comments = $event->getComments();
        return new JsonResponse($comments);
    }

    /**
     * @Route("/attend/{id}", name="attendEvent")
     */
    public function attendEventAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Event');
        $event = $repository->findOneBy(['id'=>$id]);
        $user = $this->getUser();
        $event->addAttendee($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();
        return new Response();
    }

    /**
     * @Route("/unattend/{id}", name="unattendEvent")
     */
    public function unattendEventAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Event');
        $event = $repository->findOneBy(['id'=>$id]);
        $user = $this->getUser();
        $event->removeAttendee($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();
        return new Response();
    }

    /**
     * @Route("/myEvents", name="myEvents")
     */
    public function viewMyEventsAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Event');
        $events = $repository->findUserEvents($user);


        return $this->render('@App/SportEvent/result.html.twig', array(
            'events' => $events
        ));
    }

    /**
     * @Route("/userShowEvents", name="userSearchEvents")
     */
    public function userSearchEventsAction(Request $request)
    {
        $eventSearch = new EventSearch();
        $form = $this->createForm(EventSearchType::class, $eventSearch);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $title = $eventSearch->getTitle();
            $city = $eventSearch->getCity() ? $eventSearch->getCity()->getTitle() : null;
            $em = $this->getDoctrine()->getManager();
            $events = $em->getRepository('AppBundle:Event')
                ->findAllByTitle($title,$city);

            return $this->render('@App/SportEvent/result.html.twig',[
                'events'=>$events
            ]);
        }

        return $this->render('AppBundle:SportEvent:userSearch_event.html.twig', [
            'eventSearchForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/coachEvents", name="coachEvents")
     */
    public function viewCoachEventsAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Event');
        $events = $repository->findCoachEvents($user->getCoach());


        return $this->render('@App/SportEvent/result.html.twig', array(
            'events' => $events
        ));
    }



}
