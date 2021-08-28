<?php

namespace App\Controller;

use App\Entity\Pets;
use App\Form\PetsType;
use App\Repository\PetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pets")
 */
class PetsController extends AbstractController
{
    /**
     * @Route("/", name="pets_index", methods={"GET"})
     */
    public function index(PetsRepository $petsRepository): Response
    {
        return $this->render('pets/index.html.twig', [
            'pets' => $petsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pets_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pet = new Pets();
        $form = $this->createForm(PetsType::class, $pet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pet);
            $entityManager->flush();

            return $this->redirectToRoute('pets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pets/new.html.twig', [
            'pet' => $pet,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="pets_show", methods={"GET"})
     */
    public function show(Pets $pet): Response
    {
        return $this->render('pets/show.html.twig', [
            'pet' => $pet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pets_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pets $pet): Response
    {
        $form = $this->createForm(PetsType::class, $pet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pets/edit.html.twig', [
            'pet' => $pet,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="pets_delete", methods={"POST"})
     */
    public function delete(Request $request, Pets $pet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pets_index', [], Response::HTTP_SEE_OTHER);
    }
}
