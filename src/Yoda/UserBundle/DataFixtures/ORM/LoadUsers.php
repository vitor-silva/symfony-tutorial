<?php
// src/Acme/HelloBundle/DataFixtures/ORM/LoadUserData.php

namespace Yoda\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Yoda\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class LoadUsers implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('darth');
        //$user->setPassword($this->encodePassword($user, 'darthpass'));
        $user->setPlainPassword('darthpass');
        $user->setEmail('darth@deathstar.com');
        $user->setIsActive(true);
        $manager->persist($user);

        $admin = new User();
        $admin->setUsername('wayne');
        //$admin->setPassword($this->encodePassword($admin, 'waynepass'));
        $admin->setPlainPassword('waynepass');
        $admin->setEmail('wayne@deathstar.com');
        $admin->setRoles(array('ROLE_ADMIN'));
        $admin->setIsActive(true);
        $manager->persist($admin);

        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 10;
    }


}