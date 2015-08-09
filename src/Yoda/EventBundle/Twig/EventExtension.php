<?php

/**
 * Created by PhpStorm.
 * User: vs
 * Date: 09/08/15
 * Time: 13:13
 */
namespace Yoda\EventBundle\Twig;

use Yoda\EventBundle\Util\DateUtil;

class EventExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'event';
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('ago', array($this, 'calculateAgo')),
        );
    }

    public function calculateAgo(\DateTime $dt)
    {
        return DateUtil::ago($dt);
    }
}