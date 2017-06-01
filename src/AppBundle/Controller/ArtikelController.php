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
      //$active = 0;  
      $artikelen = $this->getDoctrine()->getRepository("AppBundle:Artikel")->findBy(array('active' => 1));
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
      $em = $this->getDoctrine()->getManager(); //maakt de entiteitsmanager

      $em->persist($nieuweArtikel); //zet de nieuwe gegevens in de DB
      $em->flush();
      $nieuweArtikel->setActive(1);
      $lokatieid = $nieuweArtikel->getMagazijnlocatie()->getMid(); //pakt de locatieID uit de nieuwe gegevens
      $lokatie = $this->getDoctrine()->getRepository("AppBundle:Magazijnlocatie")->find($lokatieid); //zoekt de nieuwe locatie in de magazijntabel
      $lokatie->setArtikelid($nieuweArtikel->getArtikelnummer()); //zet bij de nieuwe locatie het art.nr. uit de nieuwe gegevens

      $em->persist($lokatie);
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

        $lokatieid = $bestaandeartikel->getMagazijnlocatie()->getMid();
        $lokatie = $this->getDoctrine()->getRepository("AppBundle:Magazijnlocatie")->find($lokatieid);
        $lokatie->setArtikelid($bestaandeartikel->getArtikelnummer());
        $em->persist($lokatie);
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
      $bestaandeartikel->setActive(0);
           $lokatieid = $bestaandeartikel->getMagazijnlocatie()->getMid();
      $lokatie = $this->getDoctrine()->getRepository("AppBundle:Magazijnlocatie")->find($lokatieid);
      $lokatie->setArtikelid(NULL);
      $em->flush();
      return $this->redirect($this->generateurl("alleartikelen"));
    }

    /**
     * @Route("/artikel/verwijder/bevestig/{artikelnummer}", name="artikelverwijderenbevestingen")
     */
    public function verwijderArtikelBevestigen(Request $request, $artikelnummer) {
      $em = $this->getDoctrine()->getManager();
      $artikel = $em->getRepository("AppBundle:Artikel")->find($artikelnummer);
      return new Response($this->renderView('bevestig.html.twig', array('artikel' => $artikel)));
    }

    /**
     * @Route("/artikel/toon/{artikelnummer}", name="toonArtikel")
     */
    public function toonArtikel(request $request, $artikelnummer) {
      $artikelen = $this->getDoctrine()->getRepository("AppBundle:Artikel")->find($artikelnummer);
      return new Response($this->renderView('eenproduct.html.twig', array('artikel' => $artikelen)));
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
