<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\BestelformulierType as BestelformulierForm;
use AppBundle\Entity\Bestelformulier;

class BestelformulierController extends Controller
{
    /**
     * @Route("/alle/bestelformulier", name="allebestelformulieren")
     */
    public function alleBestelformulieren(request $request) {
      $bestelformulieren = $this->getDoctrine()->getRepository("AppBundle:Bestelformulier")->findall();
      return new Response($this->renderView('bestelformulier.html.twig', array('bestelformulier' => $bestelformulieren)));
    }

    /**
     * @Route("/bestelformulier/nieuw", name="nieuwebestelformulier")
     */
    public function nieuweBestelformulier(Request $request) {
      $nieuweBestelformulier = new Bestelformulier();
      $form = $this->createForm(BestelformulierForm::class, $nieuweBestelformulier);
      $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($nieuweBestelformulier);
      $em->flush();
      return $this->redirect($this->generateurl("nieuwebestelformulier"));
    }
    return new Response($this->renderView('formbestelformulier.html.twig', array('form' => $form->createView())));
    }

    /**
     * @Route("/bestelformulier/wijzig/{bid}", name="bestelformulierwijzigen")
     */
    public function wijzigBestelformulier(Request $request, $bid) {
      $bestaandebestelformulier = $this->getDoctrine()->getRepository("AppBundle:Bestelformulier")->find($bid);
      $form = $this->createForm(BestelformulierForm::class, $bestaandebestelformulier);
      $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($bestaandebestelformulier);
      $em->flush();
      return $this->redirect($this->generateurl("bestelformulierwijzigen", array("bid" => $bestaandebestelformulier->getBid())));
    }
    return new Response($this->renderView('formbestelformulier.html.twig', array('form' => $form->createView())));
    }

    /**
     * @Route("/bestelformulier/verwijder/{bid}", name="bestelformulierverwijderen")
     */
    public function verwijderBestelformulier(Request $request, $bid) {
      $em = $this->getDoctrine()->getManager();
      $bestaandebestelformulier = $em->getRepository("AppBundle:Bestelformulier")->find($bid);
      $em->remove($bestaandebestelformulier);
      $em->flush();
      return $this->redirect($this->generateurl("allebestelformulieren"));
    }
}
