<?php

namespace App\Controller\Admin;;

use App\Entity\CondicionIva;
use App\Form\CondicionIvaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

#[Route('/admin/condicion-iva', name: 'admin_condicion_iva_')]
class CondicionIvaController extends AbstractController
{
    private $entityManager; 

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/listado', name: 'list')]
    public function list(): Response
    {
        return $this->render('admin/condicion_iva/list.html.twig', [
            'condicionIvaAll' => $this->entityManager->getRepository(CondicionIva::class)->findAll()
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request): Response
    {
        $condicionIva = new CondicionIva();
        $form = $this->createForm(CondicionIvaType::class, $condicionIva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->entityManager->persist($condicionIva);
                $this->entityManager->flush();
                return $this->redirectToRoute('admin_condicion_iva_list');
            } catch (UniqueConstraintViolationException $e) {
                $this->addFlash('danger', 'El código ya está en uso. Por favor, ingrese otro.');
                return $this->redirectToRoute('admin_condicion_iva_new');
            }
        }

        return $this->render('admin/condicion_iva/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Request $request, int $id): Response
    {
        $condicionIva = $this->entityManager->getRepository(CondicionIva::class)->find($id);

        if (!$condicionIva) {
            throw $this->createNotFoundException('No se encontró la condición iva');
        }

        $form = $this->createForm(CondicionIvaType::class, $condicionIva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->entityManager->flush();
                return $this->redirectToRoute('admin_condicion_iva_list');
            } catch (UniqueConstraintViolationException $e) {
                $this->addFlash('danger', 'El código ya está en uso. Por favor, ingrese otro.');
                return $this->redirectToRoute('admin_condicion_iva_edit', ['id' => $id]);
            }
        }

        return $this->render('admin/condicion_iva/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}/delete', name: 'delete')]
    public function delete(int $id): Response
    {
        $condicionIva = $this->entityManager->getRepository(CondicionIva::class)->find($id);
    
        if (!$condicionIva) {
            throw $this->createNotFoundException('No se encontró la condición iva');
        }
    
        $this->entityManager->remove($condicionIva);
        $this->entityManager->flush();
    
        return $this->redirectToRoute('admin_condicion_iva_list');
    }
}