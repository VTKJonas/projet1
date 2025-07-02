<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Visite; // Importez le modèle Visite

class NouvelleVisiteNotification extends Notification
{
    use Queueable;

    public $visite; // Propriété pour stocker l'objet Visite

    /**
     * Crée une nouvelle instance de notification.
     *
     * @param  \App\Models\Visite  $visite
     * @return void
     */
    public function __construct(Visite $visite)
    {
        $this->visite = $visite;
    }

    /**
     * Obtenez les canaux de notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // Nous allons utiliser le canal 'database' pour les notifications internes à l'application.
        // Vous pouvez ajouter 'mail' si vous configurez l'envoi d'e-mails.
        return ['database'];
    }

    /**
     * Obtenez la représentation de la notification pour la base de données.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // Ces données seront stockées dans la colonne 'data' de la table 'notifications'.
        return [
            'visite_id' => $this->visite->id,
            'visiteur_nom' => $this->visite->nom,
            'visiteur_prenom' => $this->visite->prenom,
            'date_visite' => $this->visite->date,
            'heure_arrivee' => $this->visite->heure_arrivee,
            'motif' => $this->visite->motif,
            'message' => "Nouvelle visite de {$this->visite->prenom} {$this->visite->nom} le {$this->visite->date} à {$this->visite->heure_arrivee} pour le motif : {$this->visite->motif}.",
        ];
    }

    // Si vous voulez envoyer des notifications par e-mail, décommentez et configurez ceci:
    /*
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("Bonjour {$notifiable->prenom},")
                    ->line("Vous avez une nouvelle visite prévue :")
                    ->line("Visiteur: {$this->visite->prenom} {$this->visite->nom}")
                    ->line("Date: {$this->visite->date}")
                    ->line("Heure d'arrivée: {$this->visite->heure_arrivee}")
                    ->line("Motif: {$this->visite->motif}")
                    ->action('Voir la visite', url('/visites/' . $this->visite->id))
                    ->line('Merci d\'utiliser notre application !');
    }
    */
}
