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
     * @Route("/alle/klanten", name="alleklanten")
     */
    public function alleKlanten(request $request) {
        $klanten = $this->getDoctrine()->getRepository("AppBundle:Klant")->findall();
        $tekst = "";
        foreach($klanten as $klant) {
          $tekst = $tekst . $klant->getVoornaam() . " " . $klant->getAchternaam() . " " . $klant->getTelefoonnummer() . "<br />";

        }
        return new Response("$tekst");
    }

    /**
     * @Route("/klanten/{voornaam}", name="klantopvoornaam")
     */
    public function klantOpVoornaam(request $request, $voornaam) {
        $klanten = $this->getDoctrine()->getRepository("AppBundle:Klant")->findByVoornaam($voornaam);
        $tekst = "";
        foreach($klanten as $klant) {
          $tekst = $tekst . $klant->getVoornaam() . " " . $klant->getAchternaam() . " " . $klant->getTelefoonnummer() . "<br />";

        }
        return new Response("$tekst");
    }

    /**
    * @Route("/klanten/woonplaats/{woonplaats}", name="klantopwoonplaats")
    */
    public function klantOpWoonplaats(request $request, $woonplaats) {
        $klanten = $this->getDoctrine()->getRepository("AppBundle:Klant")->findByWoonplaats($woonplaats);
        $tekst = "";
        foreach($klanten as $klant) {
          $tekst = $tekst . $klant->getVoornaam() . " " . $klant->getAchternaam() . " " . $klant->getWoonplaats() . "<br />";

          }
          return new Response("$tekst");
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

  		return new Response($this->render('form.html.twig', array('form' => $form->createView())));
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

    return new Response($this->render('form.html.twig', array('form' => $form->createView())));
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

  		return new Response($this->render('form.html.twig', array('form' => $form->createView())));
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

    return new Response($this->render('form.html.twig', array('form' => $form->createView())));
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

      return new Response($this->render('form.html.twig', array('form' => $form->createView())));
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
      	return $this->redirect($this->generateurl("productwijzigen", array("barcode" => $bestaandeproduct->getBarcode())));
      }

      return new Response($this->render('form.html.twig', array('form' => $form->createView())));
      }

}
