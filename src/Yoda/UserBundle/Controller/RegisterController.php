<?php
/**
 * Created by PhpStorm.
 * User: vs
 * Date: 06/08/15
 * Time: 14:54
 */

namespace Yoda\UserBundle\Controller;

use Yoda\EventBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Yoda\UserBundle\Entity\User;
use Yoda\UserBundle\Form\RegisterFormType;

class RegisterController extends Controller
{
    /**
     * @Route("register", name="user_register")
     * @Template()
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $user->setUsername('Leia');

        $form = $this->createForm(new RegisterFormType(), $user);

        //takes submitted values and push them to user object
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $user->setIsActive(true);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashbag()
                ->add('success', 'Welcome to the Death Star! Have a magical day!');

            $this->authenticateUser($user);

            $url = $this->generateUrl('event');

            return $this->redirect($url);
        }

        return array('form' => $form->createView());
    }

    public function authenticateUser(User $user)
    {
        $providerKey = 'secured_area'; //your firewall name
        $token = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());

        $this->getSecurityContext()->setToken($token);
    }
}