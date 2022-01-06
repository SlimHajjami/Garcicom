<?php
/**
 * Created by PhpStorm.
 * User: Slim sl
 * Date: 24/07/2021
 * Time: 23:38
 */

namespace GarcicomBundle\Controller;


use GarcicomBundle\Entity\Images;
use GarcicomBundle\Form\ImagesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ImageController extends Controller

{
    Public function addAction($id,Request $request){
        $Image = new Images();
        $form = $this->createForm(ImagesType::class, $Image);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $images = $form->get('name')->getData();
            $c = array("");
            foreach ($images as $image) {
                $s = $image;
                $fichier = $s->getClientOriginalName();
                $s->move($this->getUploadDir(), $fichier);
                array_push($c, $fichier);
            }

            $Image->setPortfolio($id);
            $em->persist($Image);
            $em->flush();
            $this->addFlash('success', 'Image ajouter :)');
            return $this->redirectToRoute("garcicom_homepage");

        }
        return $this->render("GarcicomBundle:Societe:AddSociete.html.twig",
            array('form' => $form->createView()));

    }

    protected function getUploadRootDir(){
        return __DIR__.'/../../../../web'.$this->getUploadDir();
    }
    protected function getUploadDir(){
        return 'images/';
    }
}