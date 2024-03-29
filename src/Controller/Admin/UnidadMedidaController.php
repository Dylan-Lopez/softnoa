<?php

namespace App\Controller\Admin;;

use App\Entity\UnidadMedida;
use App\Form\UnidadMedidaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

#[Route('/admin/unidad-medida', name: 'admin_unidad_medida_')]
class UnidadMedidaController extends AbstractController
{
    private $entityManager; 

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/listado', name: 'list')]
    public function list(): Response
    {
        return $this->render('admin/unidad_medida/list.html.twig', [
            'unidadMedidaAll' => $this->entityManager->getRepository(UnidadMedida::class)->findAll()
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request): Response
    {
        $unidadMedida = new UnidadMedida();
        $form = $this->createForm(UnidadMedidaType::class, $unidadMedida);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->entityManager->persist($unidadMedida);
                $this->entityManager->flush();
                return $this->redirectToRoute('admin_unidad_medida_list');
            } catch (UniqueConstraintViolationException $e) {
                $this->addFlash('danger', 'El código ya está en uso. Por favor, ingrese otro.');
                return $this->redirectToRoute('admin_unidad_medida_new');
            }
        }

        return $this->render('admin/unidad_medida/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Request $request, int $id): Response
    {
        $unidadMedida = $this->entityManager->getRepository(UnidadMedida::class)->find($id);

        if (!$unidadMedida) {
            throw $this->createNotFoundException('No se encontró la unidad de medida');
        }

        $form = $this->createForm(UnidadMedidaType::class, $unidadMedida);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->entityManager->flush();
                return $this->redirectToRoute('admin_unidad_medida_list');
            } catch (UniqueConstraintViolationException $e) {
                $this->addFlash('danger', 'El código ya está en uso. Por favor, ingrese otro.');
                return $this->redirectToRoute('admin_unidad_medida_edit', ['id' => $id]);
            }
        }

        return $this->render('admin/unidad_medida/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}/delete', name: 'delete')]
    public function delete(int $id): Response
    {
        $unidadMedida = $this->entityManager->getRepository(UnidadMedida::class)->find($id);
    
        if (!$unidadMedida) {
            throw $this->createNotFoundException('No se encontró la unidad de medida');
        }
    
        $this->entityManager->remove($unidadMedida);
        $this->entityManager->flush();
    
        return $this->redirectToRoute('admin_unidad_medida_list');
    }
}