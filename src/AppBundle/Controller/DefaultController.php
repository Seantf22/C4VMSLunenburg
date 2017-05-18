<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\KlantType as KlantForm;
use AppBundle\Entity\Klant;
use AppBundle\Form\Type\ProductTypeType as ProductTypeForm;
use AppBundle\Entity\ProductType;
use AppBundle\Form\Type\ProductType as ProductForm;
use AppBundle\Entity\Product;
use AppBundle\Form\Type\ArtikelType as ArtikelForm;
use AppBundle\Entity\Artikel;
use AppBundle\Form\Type\MagazijnlocatieType as magazijnForm;
use AppBundle\Entity\Magazijnlocatie;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/home", name="home")
     */
    public function home(Request $request)
    {
        return $this->render('home.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/alle/klanten", name="alleklanten")
     */
    public function alleKlanten(request $request) {
        $klanten = $this->getDoctrine()->getRepository("AppBundle:Klant")->findall();
        return new Response($this->renderView('klanten.html.twig', array('klanten' => $klanten)));
    }

    /**
     * @Route("/alle/producten", name="alleproducten")
     */
    public function alleProducten(request $request) {
        $producten = $this->getDoctrine()->getRepository("AppBundle:Product")->findall();
        return new Response($this->renderView('producten.html.twig', array('producten' => $producten)));
    }

    /**
     * @Route("/alle/producttype", name="alleproducttype")
     */
    public function alleProducttype(request $request) {
        $producttype = $this->getDoctrine()->getRepository("AppBundle:ProductType")->findall();
        return new Response($this->renderView('producttype.html.twig', array('producttype' => $producttype)));
    }

    /**
     * @Route("/alle/artikelen", name="alleartikelen")
     */
    public function alleArtikelen(request $request) {
        $artikelen = $this->getDoctrine()->getRepository("AppBundle:Artikel")->findall();
        return new Response($this->renderView('artikel.html.twig', array('artikel' => $artikelen)));
    }

    /**
     * @Route("/alle/magazijnlocatie", name="allemagazijnlocatie")
     */
    public function alleMagazijnlocatie(request $request) {
        $magazijnlocatie  = $this->getDoctrine()->getRepository("AppBundle:Magazijnlocatie")->findall();
        return new Response($this->render('magazijnlocatie.html.twig', array('magazijnlocatie' => $magazijnlocatie)));
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
       * @Route("/producttype/nieuw", name="nieuweproducttype")
       */
      public function nieuweProductType(Request $request) {
  		$nieuweProducttype = new ProductType();
  		$form = $this->createForm(ProductTypeForm::class, $nieuweProducttype);

      $form->handleRequest($request);
  		if ($form->isSubmitted() && $form->isValid()) {
  			$em = $this->getDoctrine()->getManager();
  			$em->persist($nieuweProducttype);
  			$em->flush();
  			return $this->redirect($this->generateurl("nieuweproducttype"));
  		}

  		return new Response($this->renderView('formproducttype.html.twig', array('form' => $form->createView())));
      }
  /**
      * @Route("/producttype/wijzig/{tid}", name="producttypewijzigen")
      */
    public function wijzigProductType(Request $request, $tid) {
    $bestaandeproducttype = $this->getDoctrine()->getRepository("AppBundle:ProductType")->find($tid);
    $form = $this->createForm(ProductTypeForm::class, $bestaandeproducttype);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($bestaandeproducttype);
    	$em->flush();
    	return $this->redirect($this->generateurl("producttypewijzigen", array("tid" => $bestaandeproducttype->gettid())));
    }

    return new Response($this->renderView('formproducttype.html.twig', array('form' => $form->createView())));
    }

    /**
       * @Route("/product/nieuw", name="nieuweproduct")
       */
      public function nieuweProduct(Request $request) {
      $nieuweProduct = new Product();
      $form = $this->createForm(ProductForm::class, $nieuweProduct);

        $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($nieuweProduct);
        $em->flush();
        return $this->redirect($this->generateurl("nieuweproduct"));
        }

        return new Response($this->render('formproduct.html.twig', array('form' => $form->createView())));
        }

  /**
    * @Route("/product/wijzig/{barcode}", name="productwijzigen")
    */
    public function wijzigProduct(Request $request, $barcode) {
      $bestaandeproduct = $this->getDoctrine()->getRepository("AppBundle:Product")->find($barcode);
      $form = $this->createForm(ProductForm::class, $bestaandeproduct);

      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
      	$em = $this->getDoctrine()->getManager();
      	$em->persist($bestaandeproduct);
      	$em->flush();
      	return $this->redirect($this->generateurl("productwijzigen", array("barcode" => $bestaandeproduct->getbarcode())));
      }

      return new Response($this->renderView('formproduct.html.twig', array('form' => $form->createView())));
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
    * @Route("/product/verwijder/{barcode}", name="productverwijderen")
    */
    public function verwijderProduct(Request $request, $barcode) {
      $em = $this->getDoctrine()->getManager();
      $bestaandeproduct = $em->getRepository("AppBundle:Product")->find($barcode);
      $em->remove($bestaandeproduct);
      $em->flush();
      return $this->redirect($this->generateurl("alleproducten"));
      }

  /**
    * @Route("/producttype/verwijder/{tid}", name="producttypeverwijderen")
    */
    public function verwijderProducttype(Request $request, $tid) {
      $em = $this->getDoctrine()->getManager();
      $bestaandeproducttype = $em->getRepository("AppBundle:ProductType")->find($tid);
      $em->remove($bestaandeproducttype);
      $em->flush();
      return $this->redirect($this->generateurl("alleproducttype"));
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

      return new Response($this->render('formartikel.html.twig', array('form' => $form->createView())));
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

    return new Response($this->render('formartikel.html.twig', array('form' => $form->createView())));
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

    return new Response($this->render('formmagazijn.html.twig', array('form' => $form->createView())));
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

  return new Response($this->render('formmagazijn.html.twig', array('form' => $form->createView())));
  }
}
