<?php

namespace App\Controller;

use App\Entity\Clients;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ClientsController extends AbstractController
{
    /**
     * @Route("/clients", name="clients")
     */
    public function index(): Response
    {
        return $this->render('clients/index.html.twig', [
            'controller_name' => 'ClientsController',
        ]);
    }

    /**
     * @Route("/add_client", name="add_client")
     */
    public function addClient(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();
        $now = new \DateTimeImmutable();

        $client = new Clients();
        $client->setEmail('testclient@example.com');
        $client->setFirstname('Jhon');
        $client->setLastname('Doe');
        $client->setPhone('+380636171184');
        $client->setCreatedAt($now);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($client);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$client->getId());
    }
}
