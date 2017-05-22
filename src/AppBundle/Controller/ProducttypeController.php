<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\ProductTypeType as ProductTypeForm;
use AppBundle\Entity\ProductType;

class ProducttypeController extends Controller
{
    /**
     * @Route("/producttype/alle", name="alleproducttype")
     */
    public function alleProducttype(request $request) {
      $producttype = $this->getDoctrine()->getRepository("AppBundle:ProductType")->findall();
      return new Response($this->renderView('producttype.html.twig', array('producttype' => $producttype)));
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
   * @Route("/producttype/verwijder/{tid}", name="producttypeverwijderen")
   */
  public function verwijderProducttype(Request $request, $tid) {
    $em = $this->getDoctrine()->getManager();
    $bestaandeproducttype = $em->getRepository("AppBundle:ProductType")->find($tid);
    $em->remove($bestaandeproducttype);
    $em->flush();
    return $this->redirect($this->generateurl("alleproducttype"));
  }
}
