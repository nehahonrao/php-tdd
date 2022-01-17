<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user')]
    public function index():Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
        // return new Response("<h1>hello world</h1>");
    }
}
