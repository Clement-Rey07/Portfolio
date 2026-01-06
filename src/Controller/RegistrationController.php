<?php

namespace App\Controller;

use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'registration')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(RegistrationType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            return $this->render('registration/cv.html.twig', [
                'data' => $data
            ]);
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
