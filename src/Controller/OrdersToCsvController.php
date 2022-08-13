<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Service\ListService;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class OrdersToCsvController extends AbstractController
{
    private $client;
    private $params;
    private $session; 
    private $CommandList;
    private $passwordHasher;
    private $doctrine;

    public function __construct(HttpClientInterface $client,ParameterBagInterface $params, SessionInterface $session, ListService $CommandList, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine)
    {
        $this->client = $client;
        $this->session = $session; 
        $this->params = $params; 
        $this->CommandList = $CommandList; 
        $this->passwordHasher = $passwordHasher; 
        $this->doctrine = $doctrine; 
        

    }
    // only users with ROLE_USER can access to this interface (basic but it could be more precised if i have an admin or HR role) its mentionned in access_control in the security.yml file
    // get the command list from listService and render it to the interface : commandes.html.twig
    /**
     * @Route("/orders-to-csv", name="app_orders_to_csv")
     */
    public function index()
    { 
        $list = $this->CommandList->getList();
        return $this->render('orders_to_csv/commandes.html.twig',
        ['commands' => $list]
    );
    } 

    // get the command list from listService and render it as json response for the export function

    /**
     * @Route("/export", name="export")
     */
    public function export()
    { 
        $list = $this->CommandList->getList();
        return new JsonResponse($list);
    } 

    
}





