<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ConferenceController extends AbstractController
{
    #[Route('/home', name: 'homepage')]
    public function index(Request $request): Response
    {
    dump($request);
        $greet = '';
        if ($name) {
            $greet = sprintf('<h1>Hello %s!</h1>', htmlspecialchars($name));
        }
        return new Response(<<<EOF
            <html>
                <body>
                    $greet
                    <img src="images/under-construction2.avif" />
                </body>
            </html>
            EOF
        );
    }
}
class LuckyController extends AbstractController
{
    #[Route('/lucky/number')]
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        );
    }
}
