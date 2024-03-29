<?php

namespace App\Controller\Admin;;

use App\Entity\ProductoServicio;
use App\Form\ProductoServicioType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

#[Route('/admin/producto-servicio', name: 'admin_producto_servicio_')]
class ProductoServicioController extends AbstractController
{
    private $entityManager; 

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/listado', name: 'list')]
    public function list(): Response
    {
        return $this->render('admin/producto_servicio/list.html.twig', [
            'productoServicioAll' => $this->entityManager->getRepository(ProductoServicio::class)->findAll()
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request): Response
    {
        $productoServicio = new ProductoServicio();
        $form = $this->createForm(ProductoServicioType::class, $productoServicio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->entityManager->persist($productoServicio);
                $this->entityManager->flush();
                return $this->redirectToRoute('admin_producto_servicio_list');
            } catch (UniqueConstraintViolationException $e) {
                $this->addFlash('danger', 'El código ya está en uso. Por favor, ingrese otro.');
                return $this->redirectToRoute('admin_producto_servicio_new');
            }
        }

        return $this->render('admin/producto_servicio/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    
    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Request $request, int $id): Response
    {
        $productoServicio = $this->entityManager->getRepository(ProductoServicio::class)->find($id);

        if (!$productoServicio) {
            throw $this->createNotFoundException('No se encontró el Producto / Servicio');
        }

        $form = $this->createForm(ProductoServicioType::class, $productoServicio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->entityManager->flush();
                return $this->redirectToRoute('admin_producto_servicio_list');
            } catch (UniqueConstraintViolationException $e) {
                $this->addFlash('danger', 'El código ya está en uso. Por favor, ingrese otro.');
                return $this->redirectToRoute('admin_producto_servicio_edit', ['id' => $id]);
            }
        }

        return $this->render('admin/producto_servicio/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}/delete', name: 'delete')]
    public function delete(int $id): Response
    {
        $productoServicio = $this->entityManager->getRepository(ProductoServicio::class)->find($id);
    
        if (!$productoServicio) {
            throw $this->createNotFoundException('No se encontró el Producto / Servicio');
        }
    
        $this->entityManager->remove($productoServicio);
        $this->entityManager->flush();
    
        return $this->redirectToRoute('admin_producto_servicio_list');
    }

}