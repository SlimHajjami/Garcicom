<?php
/**
 * Created by PhpStorm.
 * User: Slim sl
 * Date: 03/02/2021
 * Time: 09:31
 */

namespace GarcicomBundle\Controller;


use GarcicomBundle\Entity\Images;
use GarcicomBundle\Entity\Societe;
use GarcicomBundle\Form\SocieteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SocieteController extends Controller
{
    public function AddAction(Request $request)
    {
        if ($this->getUser() == null){
            return $this->redirectToRoute('fos_user_security_login');
        }
        $societe = new Societe();
        $form = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $images = $form->get('image')->getData();
            $c = array("");
            foreach($images as $image) {
            $s = $image;
                $fichier = $s->getClientOriginalName();
                $s->move($this->getUploadDir(), $fichier);
            array_push($c,$fichier);
                }

            $societe->setImage($c);
            $em->persist($societe);
            $em->flush();
            $this->addFlash('success','Societe ajouter :)');

            $aa =$em->getRepository("GarcicomBundle:Societe")->find(9);
         //   $dc2 = unserialize($aa->getImage());
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
    private function test(){
        $em = $this->getDoctrine()->getManager();

    }
    public function listSocieteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $societes = $em->getRepository("GarcicomBundle:Societe")->findAll();
        return $this->render("GarcicomBundle:Societe:listSociete.html.twig",
            array('societes' => $societes));

    }
    public function deleteSocieteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $societe = $em->getRepository("GarcicomBundle:Societe")->find($id);
        $em->remove($societe);
        $em->flush();
        return $this->redirectToRoute("/");


    }
    public function updateSocieteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $societe = $em->getRepository("GarcicomBundle:Societe")->find($id);
        $form = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($societe);
            $em->flush();
            return $this->redirectToRoute("/");
        }
        return $this->render("GarcicomBundle:Societe:updateSociete.html.twig"
            , array('form' => $form->createView())
        );

    }
    public function detailSocieteAction ($id){
        $em = $this->getDoctrine()->getManager();
        $societe = $em->getRepository("GarcicomBundle:Societe")->find($id);
        $portfolio = $em->getRepository("GarcicomBundle:Portfolio")->findBy(array('idSociete'=>$id));
        dump($societe);
        return $this->render("GarcicomBundle:Societe:DetailSociete.html.twig", array('societ'=> $societe,'portfolio'=>$portfolio));

    }


}