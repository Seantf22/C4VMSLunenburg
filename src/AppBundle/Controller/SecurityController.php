<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{

    public function indexAction(UserInterface $user = null)
    {
    if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        throw $this->createAccessDeniedException();

    // the above is a shortcut for this
    $user = $this->get('security.token_storage')->getToken()->getUser();

        return new Response('Well hi there '.$user->getFirstName());

            // $user is null when not logged-in or anon.
    }

    // the above is a shortcut for this
    $user = $this->get('security.token_storage')->getToken()->getUser();
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function helloAction($name)
    {
    // The second parameter is used to specify on what object the role is tested.
    $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

    // Old way :
    // if (false === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
    //     throw $this->createAccessDeniedException('Unable to access this page!');
    // }

    // ...
    }

	 /**
     * @Route("/login", name="login")
     */
     public function loginAction(Request $request)
     {
     	$authenticationUtils = $this->get('security.authentication_utils');
    	
    	// get the login error if there is one
    	$error = $authenticationUtils->getLastAuthenticationError();

    	// last username entered by the user
    	$lastUsername = $authenticationUtils->getLastUsername();

    	return $this->render('login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    	));
     }
}