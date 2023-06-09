<?php

namespace App\Controller;

use App\Entity\Bibliotheque;
use App\Form\BibliothequeType;
use App\Repository\BibliothequeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bibliotheque')]
class BibliothequeController extends AbstractController
{
    #[Route('/', name: 'app_bibliotheque_index', methods: ['GET'])]
    public function index(BibliothequeRepository $bibliothequeRepository): Response
    {
        return $this->render('bibliotheque/index.html.twig', [
            'bibliotheques' => $bibliothequeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bibliotheque_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BibliothequeRepository $bibliothequeRepository): Response
    {
        $bibliotheque = new Bibliotheque();
        $form = $this->createForm(BibliothequeType::class, $bibliotheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bibliothequeRepository->save($bibliotheque, true);

            return $this->redirectToRoute('app_bibliotheque_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bibliotheque/new.html.twig', [
            'bibliotheque' => $bibliotheque,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bibliotheque_show', methods: ['GET'])]
    public function show(Bibliotheque $bibliotheque): Response
    {
        return $this->render('bibliotheque/show.html.twig', [
            'bibliotheque' => $bibliotheque,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bibliotheque_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bibliotheque $bibliotheque, BibliothequeRepository $bibliothequeRepository): Response
    {
        $form = $this->createForm(BibliothequeType::class, $bibliotheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bibliothequeRepository->save($bibliotheque, true);

            return $this->redirectToRoute('app_bibliotheque_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bibliotheque/edit.html.twig', [
            'bibliotheque' => $bibliotheque,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bibliotheque_delete', methods: ['POST'])]
    public function delete(Request $request, Bibliotheque $bibliotheque, BibliothequeRepository $bibliothequeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bibliotheque->getId(), $request->request->get('_token'))) {
            $bibliothequeRepository->remove($bibliotheque, true);
        }

        return $this->redirectToRoute('app_bibliotheque_index', [], Response::HTTP_SEE_OTHER);
    }
}
