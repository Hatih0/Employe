<?php

namespace App\Controllers;

use App\Models\CongeModel;
use App\Models\EmployeModel;
use App\Models\TypeConge;
use App\Models\SoldeModel;

class RHController extends BaseController
{
    private CongeModel $congeModel;
    private EmployeModel $employeModel;
    private TypeConge $typeCongeModel;
    private SoldeModel $soldeModel;

    public function __construct()
    {
        $this->congeModel = new CongeModel();
        $this->employeModel = new EmployeModel();
        $this->typeCongeModel = new TypeConge();
        $this->soldeModel = new SoldeModel();
    }

    public function demandes()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $role = session()->get('role');
        if ($role !== 'rh' && $role !== 'RH' && $role !== 'Responsable RH') {
            return redirect()->to('/dashboard')->with('error', 'Accès refusé.');
        }

        // Récupérer toutes les demandes en attente
        $demandesEnAttente = $this->congeModel
            ->select('conges.*, types_conge.libelle as type_conge, employes.nom, employes.prenom, employes.email')
            ->join('types_conge', 'conges.type_conge_id = types_conge.id')
            ->join('employes', 'conges.employe_id = employes.id')
            ->where('conges.statut', 'en_attente')
            ->orderBy('conges.created_at', 'DESC')
            ->findAll();

        return view('rh/demandes', ['demandes' => $demandesEnAttente]);
    }

    public function approuver($id)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $conge = $this->congeModel->find($id);

        if (!$conge) {
            return redirect()->back()->with('error', 'Demande non trouvée.');
        }

        if ($conge['statut'] !== 'en_attente') {
            return redirect()->back()->with('error', 'Cette demande ne peut pas être approuvée.');
        }

        $rhId = session()->get('user_id');
        $data = [
            'statut' => 'approuvée',
            'traite_par' => session()->get('nom') . ' ' . session()->get('prenom'),
            'commentaire_rh' => $this->request->getPost('commentaire') ?? '',
        ];

        $this->congeModel->update($id, $data);

        return redirect()->back()->with('success', 'Demande approuvée avec succès.');
    }

    public function refuser($id)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $conge = $this->congeModel->find($id);

        if (!$conge) {
            return redirect()->back()->with('error', 'Demande non trouvée.');
        }

        if ($conge['statut'] !== 'en_attente') {
            return redirect()->back()->with('error', 'Cette demande ne peut pas être refusée.');
        }

        $commentaire = $this->request->getPost('commentaire');
        if (!$commentaire) {
            return redirect()->back()->with('error', 'Un commentaire est obligatoire pour refuser une demande.');
        }

        $data = [
            'statut' => 'refusée',
            'traite_par' => session()->get('nom') . ' ' . session()->get('prenom'),
            'commentaire_rh' => $commentaire,
        ];

        $this->congeModel->update($id, $data);

        return redirect()->back()->with('success', 'Demande refusée.');
    }

    public function soldes()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $annee = (int) date('Y');
        $employes = $this->employeModel->findAll();
        $types = $this->typeCongeModel->findAll();

        $soldesParEmploye = [];
        foreach ($employes as $employe) {
            $soldes = $this->soldeModel
                ->where('employe_id', (int) $employe['id'])
                ->where('annee', $annee)
                ->findAll();
            $totalAttribues = 0;
            $totalPris = 0;

            foreach ($soldes as &$solde) {
                $typeConge = null;
                foreach ($types as $type) {
                    if ((int) $type['id'] === (int) $solde['type_conge_id']) {
                        $typeConge = $type;
                        break;
                    }
                }

                $solde['type_conge'] = $typeConge;
                $solde['jours_restants'] = (int) $solde['jours_attribues'] - (int) $solde['jours_pris'];
                $totalAttribues += (int) $solde['jours_attribues'];
                $totalPris += (int) $solde['jours_pris'];
            }

            $soldesParEmploye[$employe['id']] = [
                'details' => $soldes,
                'total_attribues' => $totalAttribues,
                'total_pris' => $totalPris,
                'total_restants' => $totalAttribues - $totalPris,
            ];
        }

        return view('rh/soldes', [
            'title' => 'Soldes de congés',
            'annee' => $annee,
            'employes' => $employes,
            'soldesParEmploye' => $soldesParEmploye,
        ]);
    }
}
