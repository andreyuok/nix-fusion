<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Form\AddClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ClientsController extends AbstractController
{
    /**
     * @Route("/clients", name="clients")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $allClients = $entityManager->getRepository('App:Clients')->findAll();

        return $this->render('clients/index.html.twig', [
            'controller_name' => 'ClientsController',
            'clients' => $allClients,
        ]);
    }

    /**
     * @Route("/add_client", name="add_client")
     */
    public function addClient(Request $request): Response
    {
        $client = new Clients();
        $client->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(AddClientType::class, $client);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $client = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();
            $this->addFlash('success', 'Новый клиент сохранен');

            return $this->redirectToRoute('add_client');
        }

        return $this->render('clients/addnew.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
