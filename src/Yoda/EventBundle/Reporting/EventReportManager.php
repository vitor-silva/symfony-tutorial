<?php

/**
 * Created by PhpStorm.
 * User: vs
 * Date: 09/08/15
 * Time: 12:29
 */
namespace Yoda\EventBundle\Reporting;

class EventReportManager
{
    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getRecentlyUpdatedReport() {
        $events = $this->em->getRepository('EventBundle:Event')
            ->getRecentlyUpdatedEvents();

        $rows = array();
        foreach ($events as $event) {
            $data = array(
                $event->getId(),
                $event->getName(),
                $event->getTime()->format('Y-m-d H:i:s')
            );
            $rows[] = implode(',', $data);
        }

        return implode("\n", $rows);
    }
}