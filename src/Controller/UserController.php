<?php

namespace App\Controller;

use App\Service\ListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UserController extends AbstractController
{
    private $client;
    private $params;
    private $session; 
    private $UserList;

    public function __construct(HttpClientInterface $client,ParameterBagInterface $params, SessionInterface $session, ListService $UserList)
    {
        $this->client = $client;
        $this->session = $session; 
        $this->params = $params;   
        $this->UserList = $UserList; 
    }

    // get the users list who have pass an order from listService and render it to the users interface contacts.html.twig

    /**
     * @Route("/contacts", name="contacts")
     */
    public function index(): Response
    { 
        $newArr =array();
        $list = $this->UserList->getList();
        foreach($list as $key => $value){
            $value = $value['DeliverTo']  ; 
            array_push($newArr, $value);
        }   
        return $this->render('user/contacts.html.twig',
        ['contacts' => $newArr]
    );
    }  
}
