<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    #[Route('/email')]
    public function sendEmail(MailerInterface $mailer, User $user): Response
    {

        $email = (new Email())
            ->from('admin@orgaapp.com')
            ->to($user->getEmail())
            ->subject('[ORGAAPP]Votre compte a été créé.')
            ->html('<p>Bonjour</p><p>Ton compte administrateur ORGAAPP a bien été créé></p>');

        $mailer->send($email);

        // ...
    }
}
