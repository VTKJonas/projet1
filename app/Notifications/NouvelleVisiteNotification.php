<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NouvelleVisiteNotification extends Notification
{
    use Queueable;
    public $visiteur;

   public function __construct(Visiteur $visiteur)
    {
        $this->visiteur = $visiteur;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
     public function via($notifiable)
    {
        return ['mail', 'database']; // tu peux aussi mettre juste ['database']
    }
    
     public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle visite enregistrée')
            ->greeting('Bonjour ' . $notifiable->nom)
            ->line('Un visiteur a été enregistré pour vous.')
            ->line('Nom : ' . $this->visiteur->nom . ' ' . $this->visiteur->prenom)
            ->line('Date : ' . $this->visiteur->date)
            ->line('Heure d\'arrivée : ' . $this->visiteur->heure_arrivee)
            ->action('Confirmer la visite', url('/confirmations'))
            ->line('Merci de confirmer la visite.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'nom' => $this->visiteur->nom,
            'prenom' => $this->visiteur->prenom,
            'motif' => $this->visiteur->motif,
            'date' => $this->visiteur->date,
            'heure_arrivee' => $this->visiteur->heure_arrivee
        ];
    }
}
