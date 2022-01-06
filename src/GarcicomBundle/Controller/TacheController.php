<?php
/**
 * Created by PhpStorm.
 * User: Slim sl
 * Date: 22/09/2021
 * Time: 06:43
 */

namespace GarcicomBundle\Controller;


use GarcicomBundle\Entity\Affectation;
use GarcicomBundle\Form\AffectationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TacheController extends Controller
{
    Public function addAction(Request $request){
        if($this->getUser()->getRole()!="admin"){
            return $this->redirectToRoute("garcicom_homepage");
        }
        $affectation = new Affectation();
        $form = $this->createForm(AffectationType::class, $affectation);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $affectation->setResponsable($this->getUser());
            $affectation->setEtat("en cours");
            $em = $this->getDoctrine()->getManager();
            $em->persist($affectation);
            $em->flush();
            return $this->redirectToRoute("garcicom_homepage");
        }
        return $this->render("GarcicomBundle:Tache:Tache.html.twig",
            array('form' => $form->createView()

            ));
    }

}