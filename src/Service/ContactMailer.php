<?php

namespace App\Service;

use App\Entity\ContactMessage;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactMailer
{
    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly SiteSettingsService $settingsService
    ) {}

    public function sendContactNotification(ContactMessage $message): void
    {
        $settings = $this->settingsService->getSettings();
        $adminEmail = $settings->getAdminEmail();
        $siteName = $settings->getSiteName() ?? 'Site';

        $email = (new Email())
            ->from($adminEmail)
            ->to($adminEmail)
            ->replyTo($message->getEmail())
            ->subject(sprintf('[%s] Nouveau message de %s', $siteName, $message->getNom()))
            ->html(sprintf(
                '<h2>Nouveau message de contact</h2>
                <p><strong>Nom :</strong> %s</p>
                <p><strong>Email :</strong> %s</p>
                <p><strong>Téléphone :</strong> %s</p>
                <p><strong>Message :</strong></p>
                <p>%s</p>',
                htmlspecialchars($message->getNom()),
                htmlspecialchars($message->getEmail()),
                htmlspecialchars($message->getTelephone() ?? 'Non renseigné'),
                nl2br(htmlspecialchars($message->getMessage()))
            ));

        $this->mailer->send($email);
    }
}
