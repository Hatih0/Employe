<?php

namespace App\Controllers;

use App\Models\TypeCongeModel;

class TypeConges extends BaseController
{
    protected $typeCongeModel;

    public function __construct()
    {
        $this->typeCongeModel = new TypeCongeModel();
    }

    // ========== AFFICHER LA LISTE ==========
    public function index()
    {
        $typeConges = $this->typeCongeModel->getAllTypeConges();

        $data = [
            'title'        => 'Types de Congés',
            'typeConges'   => $typeConges,
        ];

        return view('types_conges/index', $data);
    }

    // ========== AFFICHER UN TYPE DE CONGÉ ==========
    public function show($id)
    {
        $typeConge = $this->typeCongeModel->getTypeCongeById($id);

        if ($typeConge == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'      => 'Détails du type de congé',
            'typeConge'  => $typeConge,
        ];

        return view('types_conges/show', $data);
    }

    // ========== AFFICHER LE FORMULAIRE DE CRÉATION ==========
    public function create()
    {
        $data = [
            'title' => 'Créer un type de congé',
        ];

        return view('types_conges/create', $data);
    }

    // ========== SAUVEGARDER UN NOUVEAU TYPE DE CONGÉ ==========
    public function store()
    {
        $jours_annuels = $this->request->getPost('jours_annuels');
        $deductible = $this->request->getPost('deductible') ?? '1';

        // Validations
        if (empty($jours_annuels)) {
            return redirect()->back()->withInput()->with('error', 'Le nombre de jours annuels est obligatoire');
        }

        if (!is_numeric($jours_annuels) || $jours_annuels <= 0) {
            return redirect()->back()->withInput()->with('error', 'Le nombre de jours doit être un nombre positif');
        }

        $data = [
            'jours_annuels' => $jours_annuels,
            'deductible'    => $deductible,
        ];

        $resultat = $this->typeCongeModel->createTypeConge($data);

        if ($resultat === false) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la création du type de congé');
        }

        return redirect()->to('/types-conges')->with('success', 'Type de congé créé avec succès');
    }

    // ========== AFFICHER LE FORMULAIRE D'ÉDITION ==========
    public function edit($id)
    {
        $typeConge = $this->typeCongeModel->getTypeCongeById($id);

        if ($typeConge == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'      => 'Éditer le type de congé',
            'typeConge'  => $typeConge,
        ];

        return view('types_conges/edit', $data);
    }

    // ========== METTRE À JOUR UN TYPE DE CONGÉ ==========
    public function update($id)
    {
        $typeConge = $this->typeCongeModel->getTypeCongeById($id);

        if ($typeConge == null) {
            return redirect()->to('/types-conges')->with('error', 'Type de congé introuvable');
        }

        $jours_annuels = $this->request->getPost('jours_annuels');
        $deductible = $this->request->getPost('deductible') ?? '1';

        // Validations
        if (empty($jours_annuels)) {
            return redirect()->back()->withInput()->with('error', 'Le nombre de jours annuels est obligatoire');
        }

        if (!is_numeric($jours_annuels) || $jours_annuels <= 0) {
            return redirect()->back()->withInput()->with('error', 'Le nombre de jours doit être un nombre positif');
        }

        $data = [
            'jours_annuels' => $jours_annuels,
            'deductible'    => $deductible,
        ];

        $resultat = $this->typeCongeModel->updateTypeConge($id, $data);

        if ($resultat === false) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la mise à jour du type de congé');
        }

        return redirect()->to('/types-conges')->with('success', 'Type de congé mis à jour avec succès');
    }

    // ========== SUPPRIMER UN TYPE DE CONGÉ ==========
    public function delete($id)
    {
        $typeConge = $this->typeCongeModel->getTypeCongeById($id);

        if ($typeConge == null) {
            return redirect()->to('/types-conges')->with('error', 'Type de congé introuvable');
        }

        $this->typeCongeModel->deleteTypeConge($id);

        return redirect()->to('/types-conges')->with('success', 'Type de congé supprimé avec succès');
    }

    // ========== AFFICHER LES DONNÉES EN JSON ==========
    public function json()
    {
        $typeConges = $this->typeCongeModel->getAllTypeConges();
        return $this->response->setJSON($typeConges);
    }
}
