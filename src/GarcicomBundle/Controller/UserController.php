<?php
/**
 * Created by PhpStorm.
 * User: Slim sl
 * Date: 01/03/2021
 * Time: 14:56
 */

namespace GarcicomBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use GarcicomBundle\Entity\Calendar;
use GarcicomBundle\Form\CalendarType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function AddUserAction(Request $request){
    $u = new User();
        $form = $this->createForm(UserType::class, $u);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($u);
            $em->flush();
            return $this->redirectToRoute("garcicom_homepage");

        }
        return $this->render("GarcicomBundle:User:UserAdd.html.twig",
            array('form' => $form->createView()));
    }




}