<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\KlantType as KlantForm;
use AppBundle\Entity\Klant;

class KlantController extends Controller
{
    /**
     * @Route("/alle/klanten", name="alleklanten")
     */
    public function alleKlanten(request $request) {
      $klanten = $this->getDoctrine()->getRepository("AppBundle:Klant")->findall();
      return new Response($this->renderView('klanten.html.twig', array('klanten' => $klanten)));
    }

    /**
     * @Route("/klant/nieuw", name="nieuweklant")
     */
    public function nieuweKlant(Request $request) {
      $nieuweKlant = new Klant();
      $form = $this->createForm(KlantForm::class, $nieuweKlant);
      $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($nieuweKlant);
      $em->flush();
      return $this->redirect($this->generateurl("nieuweklant"));
    }
    return new Response($this->renderView('formklant.html.twig', array('form' => $form->createView())));
    }

    /**
     * @Route("/klant/wijzig/{klantnummer}", name="klantwijzigen")
     */
    public function wijzigKlant(Request $request, $klantnummer) {
      $bestaandeklant = $this->getDoctrine()->getRepository("AppBundle:Klant")->find($klantnummer);
      $form = $this->createForm(KlantForm::class, $bestaandeklant);
      $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($bestaandeklant);
      $em->flush();
      return $this->redirect($this->generateurl("klantwijzigen", array("klantnummer" => $bestaandeklant->getKlantnummer())));
      }
    return new Response($this->renderView('formproducttype.html.twig', array('form' => $form->createView())));
    }

    /**
     * @Route("/klant/verwijder/{klantnummer}", name="klantverwijderen")
     */
    public function verwijderKlant(Request $request, $klantnummer) {
      $em = $this->getDoctrine()->getManager();
      $bestaandeklant = $em->getRepository("AppBundle:Klant")->find($klantnummer);
      $em->remove($bestaandeklant);
      $em->flush();
      return $this->redirect($this->generateurl("alleklanten"));
    }

    /**
     * @Route("/klanten/{voornaam}", name="klantopvoornaam")
     */
    public function klantOpVoornaam(request $request, $voornaam) {
      $klanten = $this->getDoctrine()->getRepository("AppBundle:Klant")->findByVoornaam($voornaam);
      return new Response($this->renderView('klanten.html.twig', array('klanten' => $klanten)));
    }

    /**
     * @Route("/klanten/woonplaats/{woonplaats}", name="klantopwoonplaats")
     */
    public function klantOpWoonplaats(request $request, $woonplaats) {
      $klanten = $this->getDoctrine()->getRepository("AppBundle:Klant")->findByWoonplaats($woonplaats);
      return new Response($this->renderView('klanten.html.twig', array('klanten' => $klanten)));
    }
}
