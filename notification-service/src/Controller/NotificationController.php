<?php

// src/Controller/NotificationController.php

namespace App\Controller;

use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    #[Route('/notification', name: 'create_notification', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer les données JSON de la requête
        $data = json_decode($request->getContent(), true);

        // Créer une nouvelle instance de Notification
        $notification = new Notification();
        $notification->setEmailRecipient($data['email_recipient']);
        $notification->setMessage($data['message']);
        $notification->setSubject($data['subject']);

        // Persister l'entité Notification
        $entityManager->persist($notification);
        $entityManager->flush();

        // Retourner une réponse JSON
        return new JsonResponse(['status' => 'Notification created!'], JsonResponse::HTTP_CREATED);
    }
}
