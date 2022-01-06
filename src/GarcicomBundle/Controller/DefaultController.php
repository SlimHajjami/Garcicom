<?php

namespace GarcicomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{


    public function indexAction()
    {
        if ( $this->getUser() ) {
            return $this->redirectToRoute('garcicom_homepage');
        }

        return $this->redirectToRoute('app_login');
    }
}
