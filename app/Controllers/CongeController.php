<?php

namespace App\Controllers;

use App\Models\TypeConge;
use App\Models\CongeModel;

class CongeController extends BaseController
{

    private $typeCongeModel;
    private $congeModel;

    public function __construct()
    {
        $this->typeCongeModel = new TypeConge();
        $this->congeModel = new CongeModel();
    }

    public function index()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $allTypesConge = $this->typeCongeModel->getAllTypesConge();
        return view('employe/demande_conge/DemandeConge', ['allTypesConge' => $allTypesConge]);
    }

    public function envoyerDemande()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        // Récupérer les données du formulaire
        $typeCongeId = $this->request->getPost('TypeConge');
        $startDateRaw = $this->request->getPost('start_date');
        $endDateRaw = $this->request->getPost('end_date');

        $startDate = $startDateRaw ? new \DateTimeImmutable($startDateRaw) : null;
        $endDate = $endDateRaw ? new \DateTimeImmutable($endDateRaw) : null;

        if (!$startDate || !$endDate) {
            return redirect()->back()
                ->with('error', 'Les dates de début et de fin sont obligatoires.');
        }

        $interval = $startDate->diff($endDate);
        $nbrjour = $interval->days;
        $motif = $this->request->getPost('motif'); 
        $commentaireRh = '';
        $employeId = session()->get('user_id');

        $data = [
            'employe_id' => $employeId,
            'type_conge_id' => $typeCongeId,
            'date_debut' => $startDate->format('Y-m-d'),
            'date_fin' => $endDate->format('Y-m-d'),
            'nb_jours' => $nbrjour,
            'motif' => $motif,
            'commentaire_rh' => $commentaireRh,
        ];

        $insert = $this->congeModel->insertConge($data);

        if (!$insert) {
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de l\'envoi de votre demande de congé. Veuillez réessayer.');
        }

        return redirect()->to('/dashboard')
            ->with('success', 'Votre demande de congé a été envoyée avec succès.');
    }

    public function supprimerDemande($id)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $conge = $this->congeModel->find($id);

        if (!$conge) {
            return redirect()->back()
                ->with('error', 'Demande de congé non trouvée.');
        }

        if ($conge['employe_id'] != session()->get('user_id')) {
            return redirect()->back()
                ->with('error', 'Vous n\'êtes pas autorisé à supprimer cette demande de congé.');
        }

        if ($conge['statut'] !== 'en_attente') {
            return redirect()->back()
                ->with('error', 'Seules les demandes de congé en attente peuvent être annulées.');
        }

        $this->congeModel->delete($id);

        return redirect()->to('/MesDemandes')
            ->with('success', 'Votre demande de congé a été annulée avec succès.');
    }

}