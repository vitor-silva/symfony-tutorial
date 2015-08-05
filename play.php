<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;


$loader = require_once __DIR__.'/app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$kernel->boot();

$container = $kernel->getContainer();
$container->enterScope('request');
$container->set('request', $request);

use Yoda\EventBundle\Entity\Event;

$event = new Event();
$event->setName('some event name');
$event->setLocation('some location');
$event->setTime(new \DateTime('tomorrow noon'));
//$event->setDetails('some details to the event');

$em = $container->get('doctrine')->getManager();
$em->persist($event);
$em->flush();