<?php

namespace App\Controllers;

use App\Models\DepartementModel;

class Departements extends BaseController
{
    // Initialiser le modèle
    protected $departementModel;

    public function __construct()
    {
        // Créer une instance du modèle DepartementModel
        $this->departementModel = new DepartementModel();
    }

    // ========== AFFICHER LA LISTE ==========
    public function index()
    {
        // Récupérer tous les départements via le modèle
        $departements = $this->departementModel->getAllDepartements();

        // Préparer les données pour la vue
        $data = [
            'title'        => 'Départements',
            'departements' => $departements,
        ];

        // Retourner la vue avec les données
        return view('departements/index', $data);
    }

    // ========== AFFICHER UN DÉPARTEMENT ==========
    public function show($id)
    {
        // Récupérer le département par son ID
        $departement = $this->departementModel->getDepartementById($id);

        // Si le département n'existe pas, afficher une erreur
        if ($departement == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Préparer les données pour la vue
        $data = [
            'title'       => 'Détails du département',
            'departement' => $departement,
        ];

        return view('departements/show', $data);
    }

    // ========== AFFICHER LE FORMULAIRE DE CRÉATION ==========
    public function create()
    {
        $data = [
            'title' => 'Créer un département',
        ];

        return view('departements/create', $data);
    }

    // ========== SAUVEGARDER UN NOUVEAU DÉPARTEMENT ==========
    public function store()
    {
        // Récupérer les données du formulaire
        $nom = $this->request->getPost('nom');
        $description = $this->request->getPost('description');

        // Vérifier que le nom n'est pas vide
        if (empty($nom)) {
            return redirect()->back()->withInput()->with('error', 'Le nom est obligatoire');
        }

        // Vérifier que le nom ne dépasse pas 255 caractères
        if (strlen($nom) > 255) {
            return redirect()->back()->withInput()->with('error', 'Le nom ne doit pas dépasser 255 caractères');
        }

        // Créer un tableau avec les données
        $data = [
            'nom'         => $nom,
            'description' => $description,
        ];

        // Sauvegarder via le modèle
        $resultat = $this->departementModel->createDepartement($data);

        // Vérifier si la sauvegarde a échoué
        if ($resultat === false) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la création du département');
        }

        // Rediriger avec un message de succès
        return redirect()->to('/departements')->with('success', 'Département créé avec succès');
    }

    // ========== AFFICHER LE FORMULAIRE D'ÉDITION ==========
    public function edit($id)
    {
        // Récupérer le département par son ID
        $departement = $this->departementModel->getDepartementById($id);

        // Si le département n'existe pas, afficher une erreur
        if ($departement == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Préparer les données pour la vue
        $data = [
            'title'       => 'Éditer le département',
            'departement' => $departement,
        ];

        return view('departements/edit', $data);
    }

    // ========== METTRE À JOUR UN DÉPARTEMENT ==========
    public function update($id)
    {
        // Récupérer les données du formulaire
        $nom = $this->request->getPost('nom');
        $description = $this->request->getPost('description');

        // Vérifier que le département existe
        $departement = $this->departementModel->getDepartementById($id);
        if ($departement == null) {
            return redirect()->to('/departements')->with('error', 'Département introuvable');
        }

        // Vérifier que le nom n'est pas vide
        if (empty($nom)) {
            return redirect()->back()->withInput()->with('error', 'Le nom est obligatoire');
        }

        // Vérifier que le nom ne dépasse pas 255 caractères
        if (strlen($nom) > 255) {
            return redirect()->back()->withInput()->with('error', 'Le nom ne doit pas dépasser 255 caractères');
        }

        // Créer un tableau avec les données
        $data = [
            'nom'         => $nom,
            'description' => $description,
        ];

        // Mettre à jour via le modèle
        $resultat = $this->departementModel->updateDepartement($id, $data);

        // Vérifier si la mise à jour a échoué
        if ($resultat === false) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la mise à jour du département');
        }

        // Rediriger avec un message de succès
        return redirect()->to('/departements')->with('success', 'Département mis à jour avec succès');
    }

    // ========== SUPPRIMER UN DÉPARTEMENT ==========
    public function delete($id)
    {
        // Vérifier que le département existe
        $departement = $this->departementModel->getDepartementById($id);
        if ($departement == null) {
            return redirect()->to('/departements')->with('error', 'Département introuvable');
        }

        // Supprimer via le modèle
        $this->departementModel->deleteDepartement($id);

        // Rediriger avec un message de succès
        return redirect()->to('/departements')->with('success', 'Département supprimé avec succès');
    }

    // ========== AFFICHER LES DONNÉES EN JSON ==========
    public function json()
    {
        // Récupérer tous les départements
        $departements = $this->departementModel->getAllDepartements();

        // Retourner les données en format JSON
        return $this->response->setJSON($departements);
    }
}
