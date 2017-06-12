<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Ontvangsten;
use AppBundle\Form\Type\OntvangstenForm;
use AppBundle\Entity\Artikel;

class OntvangstenController extends Controller
{
    /**
     * @Route("/ontvangsten", name="ontvangsten")
     */
    public function ontvangsten(Request $request)
    {
      $ontvangen = $this->getDoctrine()->getRepository("AppBundle:Ontvangsten")->findall();
      return new Response($this->renderView('ontvangen.html.twig', array('ontvangen' => $ontvangen)));
    }

    /**
     * @Route("/ontvangsten/nieuw", name="nieuwontvangstenformulier")
     */
     public function nieuwOntvangstenformulier(Request $request, $artikelnummer=0 ) {
      $ontvangstformulier = new ontvangsten();
      $form = $this->createForm(OntvangstenForm::class, $ontvangstformulier);
      $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      //print_r($ontvangstformulier);
      $em = $this->getDoctrine()->getManager();
      $em->persist($ontvangstformulier);
      $em->flush();

      //Ophogen voorraad
      $artikelnummer = $ontvangstformulier->getArtikelnummer()->getArtikelnummer();
      $artikel = $this->getDoctrine()->getRepository("AppBundle:Artikel")->find($artikelnummer); //zoekt de nieuwe locatie in de magazijntabel
      $huidigeVoorraad = $artikel->getVoorraadAantal();
      $opgegevenVoorraad = $ontvangstformulier->getHoeveelheid();
      $huidigeVoorraad = $huidigeVoorraad + $opgegevenVoorraad;
      $artikel->setVoorraadAantal($huidigeVoorraad);
      $em->persist($artikel);
      $em->flush();
      return $this->redirect($this->generateurl("ontvangsten"));
    }
    return new Response($this->renderView('bestelformulier.html.twig', array('form' => $form->createView())));
    }

}
