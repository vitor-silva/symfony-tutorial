<?php
// src/Acme/HelloBundle/DataFixtures/ORM/LoadUserData.php

namespace Yoda\EventBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Yoda\EventBundle\Entity\Event;

class LoadEvents implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $wayne = $manager->getRepository('UserBundle:User')
            ->findOneByUsernameOrEmail('wayne');

        $event1 = new Event();
        $event1->setName('some event name');
        $event1->setLocation('some location');
        $event1->setTime(new \DateTime('tomorrow noon'));
        $event1->setDetails('some details to the event');
        $manager->persist($event1);

        $event2 = new Event();
        $event2->setName('event 2');
        $event2->setLocation('location 2');
        $event2->setTime(new \DateTime('Thursday noon'));
        $event2->setDetails('some details to the event');
        $manager->persist($event2);

        $event1->setOwner($wayne);
        $event2->setOwner($wayne);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 20;
    }


}