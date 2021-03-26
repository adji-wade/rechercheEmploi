<?php

namespace App\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Demandeur;
use App\Form\DemandeurType;
use App\Repository\DemandeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demandeur")
 */
class DemandeurController extends AbstractController
{
    /**
     * @Route("/", name="demandeur_index", methods={"GET"})
     */
    public function index(DemandeurRepository $demandeurRepository): Response
    {
        return $this->render('demandeur/index.html.twig', [
            'demandeurs' => $demandeurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="demandeur_new", methods={"GET","POST"})
     */
    public function new(Request $request,UserPasswordEncoderInterface $encoders): Response
    {
        $demandeur = new Demandeur();
        $form = $this->createForm(DemandeurType::class, $demandeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoders->encodePassword($demandeur,$demandeur->getPassword());
            $demandeur->setPassword($hash);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($demandeur);
            $entityManager->flush();

            // return $this->redirectToRoute('demandeur_index');

            return $this->redirectToRoute('connexion');
        }

        return $this->render('demandeur/new.html.twig', [
            'demandeur' => $demandeur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demandeur_show", methods={"GET"})
     */
    public function show(Demandeur $demandeur): Response
    {
        return $this->render('demandeur/show.html.twig', [
            'demandeur' => $demandeur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="demandeur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Demandeur $demandeur): Response
    {
        $form = $this->createForm(DemandeurType::class, $demandeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demandeur_index');
        }

        return $this->render('demandeur/edit.html.twig', [
            'demandeur' => $demandeur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demandeur_delete", methods={"POST"})
     */
    public function delete(Request $request, Demandeur $demandeur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandeur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($demandeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('demandeur_index');
    }
}
