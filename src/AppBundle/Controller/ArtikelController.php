<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\ArtikelType as ArtikelForm;
use AppBundle\Entity\Artikel;

class ArtikelController extends Controller
{
    /**
     * @Route("/artikel/alle", name="alleartikelen")
     */
    public function alleArtikelen(request $request) {
      $artikelen = $this->getDoctrine()->getRepository("AppBundle:Artikel")->findall();
      return new Response($this->renderView('artikel.html.twig', array('artikel' => $artikelen)));
    }

    /**
     * @Route("/artikel/nieuw", name="nieuweartikel")
     */
    public function nieuweArtikel(Request $request) {
      $nieuweArtikel = new Artikel();
      $form = $this->createForm(ArtikelForm::class, $nieuweArtikel);
      $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($nieuweArtikel);
      $em->flush();
      return $this->redirect($this->generateurl("nieuweartikel"));
    }
    return new Response($this->renderView('formartikel.html.twig', array('form' => $form->createView())));
    }

    /**
     * @Route("/artikel/wijzig/{artikelnummer}", name="artikelwijzigen")
     */
    public function wijzigArtikel(Request $request, $artikelnummer) {
      $bestaandeartikel = $this->getDoctrine()->getRepository("AppBundle:Artikel")->find($artikelnummer);
      $form = $this->createForm(ArtikelForm::class, $bestaandeartikel);
      $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($bestaandeartikel);
      $em->flush();
      return $this->redirect($this->generateurl("artikelwijzigen", array("artikelnummer" => $bestaandeartikel->getArtikelnummer())));
    }
    return new Response($this->renderView('formartikel.html.twig', array('form' => $form->createView())));
    }

    /**
     * @Route("/artikel/verwijder/{artikelnummer}", name="artikelverwijderen")
     */
    public function verwijderArtikel(Request $request, $artikelnummer) {
      $em = $this->getDoctrine()->getManager();
      $bestaandeartikel = $em->getRepository("AppBundle:Artikel")->find($artikelnummer);
      $em->remove($bestaandeartikel);
      $em->flush();
      return $this->redirect($this->generateurl("alleartikelen"));
    }

    /**
    * @Route("/artikel/tekort", name="tekort")
    */
    public function teKort(request $request)
    {
      $artikelen = $this->getDoctrine()->getRepository("AppBundle:Artikel")->findall();
      $tekort = array();
      foreach ($artikelen as $artikel) {
        if($artikel->getVoorraadAantal() < $artikel->getMinimumVoorraad()){
          array_push($tekort, $artikel);
        }
      }
      // return new Response($tekort);
      return new Response($this->renderView('artikeltekort.html.twig', array('tekort' => $tekort)));
    }
}
