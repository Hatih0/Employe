<?php

namespace App\Controllers;

use App\Models\CongeModel;
use App\Models\EmployeModel;
use App\Models\TypeCongeModel;
use App\Models\SoldeModel;

class Conges extends BaseController
{
    protected $congeModel;
    protected $employeModel;
    protected $typeCongeModel;
    protected $soldeModel;

    public function __construct()
    {
        $this->congeModel = new CongeModel();
        $this->employeModel = new EmployeModel();
        $this->typeCongeModel = new TypeCongeModel();
        $this->soldeModel = new SoldeModel();
    }

    // ========== AFFICHER LA LISTE DE TOUTES LES DEMANDES DE CONGES ==========
    public function index()
    {
        $conges = $this->congeModel->getCongesAvecDetails();

        $data = [
            'title'  => 'Demandes de Congés',
            'conges' => $conges,
        ];

        return view('conges/index', $data);
    }

    // ========== AFFICHER LA LISTE DES DEMANDES EN ATTENTE ==========
    public function demandesEnAttente()
    {
        $conges = $this->congeModel->getDemandeCongesEnAttente();
        
        // Ajouter les détails de l'employé et du département
        foreach ($conges as &$conge) {
            $employe = $this->employeModel->getEmployeById($conge['employe_id']);
            $conge['employe'] = $employe;
            if ($employe && $employe['departement_id']) {
                $dept = new \App\Models\DepartementModel();
                $conge['departement'] = $dept->getDepartementById($employe['departement_id']);
            }
        }

        $data = [
            'title'  => 'Demandes de Congés en Attente',
            'conges' => $conges,
        ];

        return view('conges/en_attente', $data);
    }

    // ========== AFFICHER LES DEMANDES PAR DEPARTEMENT ==========
    public function parDepartement($departement_id)
    {
        $conges = $this->congeModel->filtrerCongesParDepartement($departement_id);
        
        // Ajouter les détails
        foreach ($conges as &$conge) {
            $employe = $this->employeModel->getEmployeById($conge['employe_id']);
            $conge['employe'] = $employe;
        }

        $data = [
            'title'  => 'Demandes de Congés par Département',
            'conges' => $conges,
        ];

        return view('conges/par_departement', $data);
    }

    // ========== AFFICHER LES DEMANDES PAR STATUT ==========
    public function parStatut($statut)
    {
        if (!in_array($statut, ['en_attente', 'approuve', 'refuse'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $conges = $this->congeModel->filtrerCongesParStatut($statut);
        
        // Ajouter les détails
        foreach ($conges as &$conge) {
            $employe = $this->employeModel->getEmployeById($conge['employe_id']);
            $conge['employe'] = $employe;
        }

        $statuts = ['en_attente' => 'En Attente', 'approuve' => 'Approuvé', 'refuse' => 'Refusé'];

        $data = [
            'title'  => 'Demandes de Congés - ' . $statuts[$statut],
            'conges' => $conges,
            'statut' => $statut,
        ];

        return view('conges/par_statut', $data);
    }

    // ========== AFFICHER UNE DEMANDE DE CONGE ==========
    public function show($id)
    {
        $conge = $this->congeModel->getById($id);

        if (!$conge) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $employe = $this->employeModel->getEmployeById($conge['employe_id']);
        $typeConge = $this->typeCongeModel->getTypeCongeById($conge['type_conge_id']);
        $departement = null;
        
        if ($employe && $employe['departement_id']) {
            $dept = new \App\Models\DepartementModel();
            $departement = $dept->getDepartementById($employe['departement_id']);
        }

        $data = [
            'title'      => 'Détails de la Demande de Congé',
            'conge'      => $conge,
            'employe'    => $employe,
            'typeConge'  => $typeConge,
            'departement' => $departement,
        ];

        return view('conges/show', $data);
    }

    // ========== AFFICHER LE FORMULAIRE DE DEMANDE DE CONGE ==========
    public function create()
    {
        $employes = $this->employeModel->getAllEmployes();
        $typeConges = $this->typeCongeModel->getAllTypeConges();

        $data = [
            'title'       => 'Demander un Congé',
            'employes'    => $employes,
            'typeConges'  => $typeConges,
        ];

        return view('conges/create', $data);
    }

    // ========== SAUVEGARDER UNE DEMANDE DE CONGE ==========
    public function store()
    {
        $employe_id = $this->request->getPost('employe_id');
        $type_conge_id = $this->request->getPost('type_conge_id');
        $date_debut = $this->request->getPost('date_debut');
        $date_fin = $this->request->getPost('date_fin');
        $motif = $this->request->getPost('motif');

        // Validations
        if (empty($employe_id) || empty($type_conge_id) || empty($date_debut) || empty($date_fin)) {
            return redirect()->back()->withInput()->with('error', 'Les champs obligatoires doivent être remplis');
        }

        // Calculer le nombre de jours
        $debut = new \DateTime($date_debut);
        $fin = new \DateTime($date_fin);
        $nb_jours = $fin->diff($debut)->days + 1;

        $data = [
            'employe_id'    => $employe_id,
            'type_conge_id' => $type_conge_id,
            'date_debut'    => $date_debut,
            'date_fin'      => $date_fin,
            'nb_jours'      => $nb_jours,
            'motif'         => $motif,
            'statut'        => 'en_attente',
        ];

        $resultat = $this->congeModel->demanderConge($data);

        if ($resultat === false) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la création de la demande');
        }

        return redirect()->to('/conges')->with('success', 'Demande de congé créée avec succès');
    }

    // ========== APPROUVER UNE DEMANDE DE CONGE ==========
    public function approuver($id)
    {
        $conge = $this->congeModel->getById($id);

        if (!$conge) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $commentaire = $this->request->getPost('commentaire');
        $traite_par = session()->get('user_id');

        $resultat = $this->congeModel->reponseConge($id, 'approuve', $commentaire, $traite_par);

        if ($resultat) {
            return redirect()->to('/conges/en-attente')->with('success', 'Demande de congé approuvée avec succès');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de l\'approbation');
        }
    }

    // ========== REFUSER UNE DEMANDE DE CONGE ==========
    public function refuser($id)
    {
        $conge = $this->congeModel->getById($id);

        if (!$conge) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $commentaire = $this->request->getPost('commentaire');
        $traite_par = session()->get('user_id');

        $resultat = $this->congeModel->reponseConge($id, 'refuse', $commentaire, $traite_par);

        if ($resultat) {
            return redirect()->to('/conges/en-attente')->with('success', 'Demande de congé refusée');
        } else {
            return redirect()->back()->with('error', 'Erreur lors du refus');
        }
    }

    // ========== AFFICHER LE SOLDE DE L'EMPLOYE ==========
    public function solde($employe_id)
    {
        $employe = $this->employeModel->getEmployeById($employe_id);

        if (!$employe) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $anneeActuelle = (int)date('Y');
        $soldes = $this->congeModel->getSoldeEmploye($employe_id, $anneeActuelle);

        // Ajouter les détails des types de congés
        foreach ($soldes as &$solde) {
            $typeConge = $this->typeCongeModel->getTypeCongeById($solde['type_conge_id']);
            $solde['type_conge'] = $typeConge;
            $solde['jours_restants'] = $solde['jours_attribues'] - $solde['jours_pris'];
        }

        $data = [
            'title'    => 'Solde de Congés de ' . $employe['prenom'] . ' ' . $employe['nom'],
            'employe'  => $employe,
            'soldes'   => $soldes,
            'annee'    => $anneeActuelle,
        ];

        return view('conges/solde', $data);
    }

    // ========== AFFICHER LES SOLDES DE TOUS LES EMPLOYES ==========
    public function soldes()
    {
        $employes = $this->employeModel->getAllEmployes();
        $anneeActuelle = (int)date('Y');

        $soldesParEmploye = [];
        foreach ($employes as $employe) {
            $soldesParEmploye[$employe['id']] = $this->congeModel->getSoldeEmploye($employe['id'], $anneeActuelle);
        }

        $data = [
            'title'             => 'Soldes de Congés',
            'employes'          => $employes,
            'soldesParEmploye'  => $soldesParEmploye,
            'annee'             => $anneeActuelle,
        ];

        return view('conges/soldes', $data);
    }

    // ========== AFFICHER LES DONNEES EN JSON ==========
    public function json()
    {
        $conges = $this->congeModel->getAll();
        return $this->response->setJSON($conges);
    }
}
