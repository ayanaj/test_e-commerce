<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security; 
use Symfony\Component\HttpFoundation\RequestStack; 

/**
 * @Security("is_granted('PUBLIC_ACCESS')", message="No access! Get out!")
 */

class ListService
{
    private $client; 

    public function __construct(HttpClientInterface $client, ParameterBagInterface $params, RequestStack $requestStack)
    {
        $this->client = $client;
        $this->params = $params; 
    }

    // function that calls the get orders+contacts api 

    function getList(){
        $responseContact = $this->client->request('GET', $this->params->get('Hostapi') . '/contacts', [
            'headers' => [
                'Accept' => 'application/json',
                'x-api-key' => 'PMAK-62f64bf97eba742875007f5e-81d3eb358a0d6210c2060c260683ed032c',
            ],
        ]); 
        $statusCodeContact = $responseContact->getStatusCode();
        $decodedResponseContact = "";
        if ($statusCodeContact == 200) {
            $decodedResponseContact = json_decode($responseContact->getContent(), true);  
            $decodedResponseContact = $decodedResponseContact['results'];
        }

        $response = $this->client->request('GET', $this->params->get('Hostapi') . '/orders/', [
            'headers' => [
                'Accept' => 'application/json',
                'x-api-key' => 'PMAK-62f64bf97eba742875007f5e-81d3eb358a0d6210c2060c260683ed032c',
            ],
        ]); 
        $statusCode = $response->getStatusCode();
        $decodedResponse = "";
        $newArray = array();
        if ($statusCode == 200) {
            $decodedResponse = json_decode($response->getContent(), true);  
            $decodedResponse = $decodedResponse['results'];
            foreach ($decodedResponse as $key => $value) {
                foreach ($decodedResponseContact as $j => $val) {    
                    if ($value['DeliverTo'] == $val['ID']) {
                        $value['DeliverTo'] = $val;
                    }
                }
                array_push($newArray, $value);
            } 
        } 

        return $newArray;
    }
 
}
