<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KernelController extends AbstractController
{
    #[Route('/kernel', name: 'app_kernel')]
    public function index(): Response
    {
        return $this->render('kernel/index.html.twig', [
            'controller_name' => 'KernelController',
        ]);
    }
}
