// src/Controller/DownloadController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class DownloadController extends AbstractController
{
    #[Route('/download-request', name: 'app_download_request')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        if ($request->isMethod('POST')) {
            $emailUser = $request->request->get('email');
            $name = $request->request->get('name');
            $firstname = $request->request->get('firstname');

            // 1. Envoyer l'email à TOI
            $email = (new Email())
                ->from('noreply@yourportfolio.com')
                ->to('ton-email@gmail.com') // TON EMAIL ICI
                ->subject('New CV Download Request')
                ->text("User: $firstname $name ($emailUser) has downloaded your CV.");

            $mailer->send($email);

            // 2. Rediriger vers le fichier PDF
            return $this->redirectToRoute('app_cv_final');
        }

        return $this->render('download/index.html.twig');
    }

    #[Route('/get-my-cv', name: 'app_cv_final')]
    public function getCv(): Response
    {
        // Cette route sert à déclencher le téléchargement
        return $this->file($this->getParameter('kernel.project_dir') . '/public/cv/mon_cv.pdf');
    }
}