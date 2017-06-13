<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\BestelFormulierType;
use AppBundle\Entity\BestelFormulier;
use AppBundle\Entity\BestelArtikel;
use AppBundle\Form\Type\BestelFormulierArtikelToevoegen;
use AppBundle\Form\Type\SelectBestelform;

class BestelFormulierController extends Controller
{
    /**
     * @Route("/bestelformulier/nieuw", name="nieuwebestelformulier")
     */
     public function nieuweBestelformulier(Request $request) {
      $bestelformulier = new bestelformulier();
      $form = $this->createForm(BestelFormulierType::class, $bestelformulier);
      $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($bestelformulier);
      $em->flush();
      return $this->redirect($this->generateurl("nieuwebestelformulier"));
    }
    return new Response($this->renderView('bestelformulier.html.twig', array('form' => $form->createView())));
    }

    /**
     * @Route("/bestelformulier/weergeven", name="alleBestelFormulieren")
     */
    public function alleBestelFormulieren(Request $request) {
      $weergevenbestelformulier = $this->getDoctrine()->getRepository("AppBundle:BestelFormulier")->findall();
      return new Response($this->renderView('bestelformulierweergeven.html.twig', array('bestelformulier' => $weergevenbestelformulier)));
    }

        /**
     * @Route("/artikelbestellen/{bestelordernummer}", name="bestelNieuwArtikel")
     */
     public function bestelNieuwArtikel(Request $request, $bestelordernummer) {
      $BestelArtikel = new BestelArtikel();
       $form = $this->createForm(BestelFormulierArtikelToevoegen::class, $BestelArtikel);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
              $BestelArtikel->setBestelordernummer($bestelordernummer);
        $em->persist($BestelArtikel);
        $em->flush();
       }
      return new Response($this->renderView('bestelformulierArtikel.html.twig', array('form' => $form->createView())));
    }
    /**
     * @Route("/bestelling/weergeven/{bestelordernummer}", name="bestellingWeergeven")
     */
    public function bestellingweergeven(Request $request, $bestelordernummer) {
      $bestelling = $this->getDoctrine()->getRepository("AppBundle:BestelArtikel")->findBy(array('bestelordernummer'=>$bestelordernummer));
      return new Response($this->renderView('allesweergevenbestelling.html.twig', array('bestelling' => $bestelling)));
    }

    /**
    * @Route("/tekorten/bestellen/", name="tekortbestellen")
    */
    public function tekortBestellen(Request $request)
    {
      $BestelFormulier = new BestelFormulier();
      $form = $this->createForm(SelectBestelform::class, $BestelFormulier);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        //$bestelling = $BestelFormulier->getBestelordernummer();
        $bestelling = $BestelFormulier->getBestelordernummer()->getBestelordernummer();
        print_r($bestelling);
        return $this->redirect("../../artikelbestellen/$bestelling");
        //return $this->redirect("/symfony/C4VMSLunenburg/web/app_dev.php/artikelbestellen/$bestelling");
        //return $this->redirect($this->generateurl("{{ path('bestelNieuwArtikel',{'bestelordernummer':$bestelling}) }}");
        //echo $form;
        //print_r($form->getBestelordernummer());


       }
      return new Response($this->renderView('bestelformulierArtikel.html.twig', array('form' => $form->createView())));
    }

  }
