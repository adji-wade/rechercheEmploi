<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormulaireController extends AbstractController
{
    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function formulaire(): Response
    {
        return $this->render('formulaire/formulaire.html.twig', [
            'controller_name' => 'FormulaireController',
        ]);
    }
   
}
