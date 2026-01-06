<?php

namespace App\Controller;

use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ConferenceController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/projects', name: 'projects')]
    public function projects(): Response
    {
        return $this->render('project/index.html.twig');
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('contact/index.html.twig');
    }


    #[Route('/download-request', name: 'app_download_request')]
    public function downloadRequest(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            return $this->file($this->getParameter('kernel.project_dir') . '/public/cv/mon_cv.pdf');
        }

        return $this->render('download/index.html.twig');
    }


    #[Route('/registration', name: 'registration')]
    public function registration(Request $request): Response
    {
        $form = $this->createForm(RegistrationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            return $this->render('registration/cv.html.twig', ['data' => $data]);
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}