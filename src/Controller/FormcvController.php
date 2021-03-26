<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormcvController extends AbstractController
{
    /**
     * @Route("/formcv", name="formcv")
     */
    public function formcv(): Response
    {
        return $this->render('formcv/formcv.html.twig', [
            'controller_name' => 'FormcvController',
        ]);
    }
}
