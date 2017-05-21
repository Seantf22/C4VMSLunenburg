<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\ProductType as ProductForm;
use AppBundle\Entity\Product;

class ProductController extends Controller
{
    /**
     * @Route("/alle/producten", name="alleproducten")
     */
    public function alleProducten(request $request) {
      $producten = $this->getDoctrine()->getRepository("AppBundle:Product")->findall();
      return new Response($this->renderView('producten.html.twig', array('producten' => $producten)));
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
    return new Response($this->renderView('formproduct.html.twig', array('form' => $form->createView())));
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
     * @Route("/product/verwijder/{barcode}", name="productverwijderen")
     */
    public function verwijderProduct(Request $request, $barcode) {
      $em = $this->getDoctrine()->getManager();
      $bestaandeproduct = $em->getRepository("AppBundle:Product")->find($barcode);
      $em->remove($bestaandeproduct);
      $em->flush();
      return $this->redirect($this->generateurl("alleproducten"));
    }
}
