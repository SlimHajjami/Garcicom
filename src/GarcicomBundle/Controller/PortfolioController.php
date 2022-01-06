<?php
/**
 * Created by PhpStorm.
 * User: Slim sl
 * Date: 22/03/2021
 * Time: 16:27
 */

namespace GarcicomBundle\Controller;


use GarcicomBundle\Entity\Images;
use GarcicomBundle\Entity\Portfolio;
use GarcicomBundle\Form\ImagesType;
use GarcicomBundle\Form\PortfolioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PortfolioController extends Controller
{
    public function addAction($id , Request $request)
    {
        if ($this->getUser() == null){
            return $this->redirectToRoute('fos_user_security_login');
        }
        $portfolio = new Portfolio();
        $form = $this->createForm(PortfolioType::class, $portfolio);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $societe = $em->getRepository('GarcicomBundle:Societe')->find($id);
            $portfolio->setIdSociete($societe);
            $em->persist($portfolio);
            $em->flush();
            $portfolioo = $em->getRepository('GarcicomBundle:Portfolio')->findBy(array('idSociete' => $id));
            dump($societe);
            return $this->render("GarcicomBundle:Societe:DetailSociete.html.twig", array('societ'=> $societe,'portfolio'=>$portfolioo));




        }

        return $this->render("GarcicomBundle:Societe:AddSociete.html.twig",
            array('form' => $form->createView()));


    }
    public function detailAction ($id,Request $request){
        if ($this->getUser() == null){
            return $this->redirectToRoute('fos_user_security_login');
        }
        $em = $this->getDoctrine()->getManager();
        $portfolio = $em->getRepository('GarcicomBundle:Images')->findBy(array('Portfolio'=>$id));
        $societe = $em->getRepository('GarcicomBundle:Portfolio')->findBy(array('id'=>$id));

        $p = new Portfolio();
        foreach ($societe as $item){
            $p=$item;
        }
        $societe = $em->getRepository('GarcicomBundle:Portfolio')->findBy(array('id'=>$id));
        $a = new Portfolio();
        $a= $societe[0];
        $s = $em->getRepository('GarcicomBundle:Societe')->findby(array('id'=>$a->getIdSociete()));
        dump($s);
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
                $Image->setName($s->getClientOriginalName());

            }

            $Image->setPortfolio($p);
            $em->persist($Image);
            $em->flush();
            $this->addFlash('success', 'Image ajouter :)');
            return $this->redirectToRoute("garcicom_homepage");

        }
        return $this->render("GarcicomBundle:Portfolio:DetailPortfolio.html.twig",array('image'=>$portfolio,'societe'=>$s,'form'=>$form->createView()));

    }
    public function addImageAction($id,Request $request)
    {
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
            $this->addFlash('success', 'Societe ajouter :)');
            return $this->redirectToRoute("garcicom_homepage");

        }
    }

    protected function getUploadRootDir(){
        return __DIR__.'/../../../../web'.$this->getUploadDir();
    }
    protected function getUploadDir(){
        return 'images/';
    }
}