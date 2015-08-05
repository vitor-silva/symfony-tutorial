<?php

namespace Yoda\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($count, $firstName)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EventBundle:Event');

        $event = $repo->findOneBy(array(
            'name' => 'some event name'
        ));

        return $this->render(
            'EventBundle:Default:index.html.twig',
            array('name' =>  $firstName, 'count' => $count, 'event' => $event)
        );
    }
}
