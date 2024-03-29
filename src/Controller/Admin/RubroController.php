<?php

namespace App\Controller\Admin;;

use App\Entity\Rubro;
use App\Form\RubroType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/admin/rubro', name: 'admin_rubro_')]
class RubroController extends AbstractController
{
    private $entityManager; 

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/listado', name: 'list')]
    public function list(): Response
    {
        return $this->render('admin/rubro/list.html.twig', [
            'rubroAll' => $this->entityManager->getRepository(Rubro::class)->findAll()
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request): Response
    {
        $rubro = new Rubro();
        $form = $this->createForm(RubroType::class, $rubro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($rubro);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_rubro_list');
        }

        return $this->render('admin/rubro/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Request $request, int $id): Response
    {
        $rubro = $this->entityManager->getRepository(Rubro::class)->find($id);

        if (!$rubro) {
            throw $this->createNotFoundException('No se encontró el rubro');
        }

        $form = $this->createForm(RubroType::class, $rubro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_rubro_list');
        }

        return $this->render('admin/rubro/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}/delete', name: 'delete')]
    public function delete(int $id): Response
    {
        $rubro = $this->entityManager->getRepository(Rubro::class)->find($id);
    
        if (!$rubro) {
            throw $this->createNotFoundException('No se encontró el rubro');
        }
    
        $this->entityManager->remove($rubro);
        $this->entityManager->flush();
    
        return $this->redirectToRoute('admin_rubro_list');
    }
}