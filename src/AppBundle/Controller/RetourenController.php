<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\RetourType as RetourForm;
use AppBundle\Entity\Retouren;

class RetourenController extends Controller
{
    /**
     * @Route("/alle/retouren", name="alleretouren")
     */
    public function alleRetouren(request $request) {
      $retouren = $this->getDoctrine()->getRepository("AppBundle:Retouren")->findall();
      return new Response($this->renderView('retouren.html.twig', array('retouren' => $retouren)));
    }

    /**
     * @Route("/retouren/nieuw", name="nieuwretour")
     */
    public function nieuweRetour(Request $request) {
      $nieuwRetour = new Retouren();
      $form = $this->createForm(RetourForm::class, $nieuwRetour);
      $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($nieuwRetour);
      $em->flush();
      return $this->redirect($this->generateurl("nieuwretour"));
    }
    return new Response($this->renderView('formretouren.html.twig', array('form' => $form->createView())));
    }

    /**
     * @Route("/retouren/wijzig/{retournummer}", name="retourwijzigen")
     */
    public function wijzigretour(Request $request, $retournummer) {
      $bestaanderetouren = $this->getDoctrine()->getRepository("AppBundle:Retouren")->find($retournummer);
      $form = $this->createForm(RetourForm::class, $bestaanderetouren);
      $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($bestaanderetouren);
      $em->flush();
      return $this->redirect($this->generateurl("retourwijzigen", array("retournummer" => $bestaanderetouren->getRetournummer())));
    }
    return new Response($this->renderView('formretouren.html.twig', array('form' => $form->createView())));
    }

    /**
     * @Route("/retour/verwijder/{retournummer}", name="retourverwijderen")
     */
    public function verwijderRetour(Request $request, $retournummer) {
      $em = $this->getDoctrine()->getManager();
      $bestaanderetouren = $em->getRepository("AppBundle:Retouren")->find($retournummer);
      $em->remove($bestaanderetouren);
      $em->flush();
      return $this->redirect($this->generateurl("alleretouren"));
    }
}
