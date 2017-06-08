<?php
//Namespace en uses, mag je vergeten. Moet er wel in staan!
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\SearchForm;
use AppBundle\Entity\Artikel;



class SearchController extends Controller
{

     /**
     * @Route("/searchArtikel/", name="search")
     */

  public function doctrineQuery(Request $request)
  {
    $form = $this->createForm(SearchForm::class);
    $form->handleRequest($request);
    $title = $form->get('searching')->getData();
    $em = $this->getDoctrine()->getManager();
    $query1 = $em->createQuery('
        Select a FROM AppBundle:Artikel a
        WHERE a.artikelnummer LIKE :title
        OR a.omschrijving LIKE :title


      ')->setParameter('title', '%'. $title .'%');

    $articles = $query1->getResult();
    //var_dump($articles);
    return new Response($this->renderView('search.html.twig', array( 'artikel' => $articles,'form' => $form->createView())));
  }

// OR a.magazijnlocatie = :title

     /**
     * @Route("/searchBestelformulier", name="searchbestel")
     */

  public function bestelQuery(Request $request)
  {
    $form = $this->createForm(BestelForm::class);
    $form->handleRequest($request);
    $title = $form->get('searching')->getData();

    $em = $this->getDoctrine()->getManager();
    $query1 = $em->createQuery('
        Select a FROM AppBundle:Bestelformulier a
        WHERE a.leverancier LIKE :title OR a.bestelordernr LIKE :title 
      

      ')->setParameter('title', '%'. $title .'%');
    $bestelling = $query1->getResult();
    //var_dump($articles);
    return new Response($this->renderView('bestel.html.twig', array( 'bestel' => $bestelling,'form' => $form->createView())));
  }
}



?>
