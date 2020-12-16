<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    
    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil()
    {
        return $this->render('accueil.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
}
