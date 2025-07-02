<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\Visite; // Pour mettre à jour le statut de la visite

class NotificationController extends Controller
{
    /**
     * Marque une notification comme lue.
     * @param  string  $id L'ID UUID de la notification.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsRead($id)
    {
        // Utilisation de auth()->user() pour s'assurer que seul l'utilisateur propriétaire peut marquer sa notification.
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect()->back()->with('success', 'Notification marquée comme lue.');
    }

    /**
     * Accepte une visite liée à une notification.
     * @param  string  $id L'ID UUID de la notification.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accepter($id)
    {
        $notification = DatabaseNotification::findOrFail($id);
        $notification->markAsRead(); // Marque la notification comme lue

        // Récupérer la visite associée à cette notification
        // Assurez-vous que la 'data' de votre notification contient l'ID de la visite
        $visiteId = $notification->data['visite_id'] ?? null;

        if ($visiteId) {
            $visite = Visite::find($visiteId);
            if ($visite) {
                $visite->update(['confirmee' => true]); // Marque la visite comme confirmée
            }
        }

        return redirect()->back()->with('success', 'Visite acceptée et notification lue.');
    }

    /**
     * Refuse une visite liée à une notification.
     * @param  string  $id L'ID UUID de la notification.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function refuser($id)
    {
        $notification = DatabaseNotification::findOrFail($id);
        $notification->markAsRead(); // Marque la notification comme lue

        $visiteId = $notification->data['visite_id'] ?? null;

        if ($visiteId) {
            $visite = Visite::find($visiteId);
            if ($visite) {
                $visite->update(['confirmee' => false]); // Marque la visite comme non confirmée/refusée
            }
        }

        return redirect()->back()->with('success', 'Visite refusée et notification lue.');
    }

    /**
     * Bannit une visite liée à une notification.
     * @param  string  $id L'ID UUID de la notification.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bannir($id)
    {
        $notification = DatabaseNotification::findOrFail($id);
        $notification->markAsRead(); // Marque la notification comme lue

        $visiteId = $notification->data['visite_id'] ?? null;

        if ($visiteId) {
            $visite = Visite::find($visiteId);
            if ($visite) {
                $visite->delete(); // Exemple: Supprimer la visite si elle est bannie
            }
        }

        return redirect()->back()->with('success', 'Visite bannie et notification lue.');
    }
}
