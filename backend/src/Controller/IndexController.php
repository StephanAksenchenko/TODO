<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route(path: '/app', name: 'app_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('app.html.twig');
    }
}
