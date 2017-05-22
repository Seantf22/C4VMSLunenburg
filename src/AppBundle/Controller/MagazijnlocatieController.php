<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\MagazijnlocatieType as magazijnForm;
use AppBundle\Entity\Magazijnlocatie;

class MagazijnlocatieController extends Controller
{
    /**
     * @Route("/magazijnlocatie/alle", name="allemagazijnlocatie")
     */
    public function alleMagazijnlocatie(request $request) {
      $magazijnlocatie  = $this->getDoctrine()->getRepository("AppBundle:Magazijnlocatie")->findall();
      return new Response($this->renderView('magazijnlocatie.html.twig', array('magazijnlocatie' => $magazijnlocatie)));
    }

    /**
     * @Route("/magazijnlocatie/nieuw", name="nieuwemagazijnlocatie")
     */
    public function nieuwemagazijnlocatie(Request $request) {
      $nieuwemagazijnlocatie = new Magazijnlocatie();
      $form = $this->createForm(MagazijnForm::class, $nieuwemagazijnlocatie);
      $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($nieuwemagazijnlocatie);
      $em->flush();
      return $this->redirect($this->generateurl("nieuwemagazijnlocatie"));
    }
    return new Response($this->renderView('formmagazijn.html.twig', array('form' => $form->createView())));
    }

    /**
     * @Route("/magazijnlocatie/wijzig/{magazijnlocatie}", name="magazijnlocatiewijzigen")
     */
    public function wijzigMagazijnlocatie(Request $request, $magazijnlocatie) {
      $bestaandemagazijnlocatie = $this->getDoctrine()->getRepository("AppBundle:Magazijnlocatie")->find($magazijnlocatie);
      $form = $this->createForm(MagazijnForm::class, $bestaandemagazijnlocatie);
      $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($bestaandemagazijnlocatie);
      $em->flush();
      return $this->redirect($this->generateurl("magazijnlocatiewijzigen", array("magazijnlocatie" => $bestaandemagazijnlocatie->getMagazijnlocatie())));
      }
    return new Response($this->renderView('formmagazijn.html.twig', array('form' => $form->createView())));
    }
}
