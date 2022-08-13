<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{

    //login endpoint login_path,check_path and login default_target_path are defined in the firewalls in the securuty.yml file

    /**
     * @Route("/", name="login")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig', [
            'controller_name' => 'LoginController',
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    //logout endpoint

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout(): void
    {
        // controller can be blank: it will never be called!
       // throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }


    
    //  function that allows a user creation in the database 

    /**
     * @Route("/create/usertest", name="app_create_user_test")
     */
    public function createUserTest(): JsonResponse
    {
        $entityManager = $this->doctrine->getManager();

        $user = new User();
        $user->setEmail("user@ecommerce.com");
        $plainPassword = 'ecommercepwd';
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plainPassword
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(["ROLE_USER"]);
       
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json([
            'message' => 'User created succesfully!',
            'path' => 'src/Controller/ApiLoginController.php',
            'user'  => $user->getUserIdentifier()
        ]);
    }
}
