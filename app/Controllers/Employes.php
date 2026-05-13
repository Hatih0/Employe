<?php

namespace App\Controllers;

use App\Models\EmployeModel;
use App\Models\DepartementModel;

class Employes extends BaseController
{
    protected $employeModel;
    protected $departementModel;

    public function __construct()
    {
        $this->employeModel = new EmployeModel();
        $this->departementModel = new DepartementModel();
    }

    // ========== AFFICHER LA LISTE ==========
    public function index()
    {
        $employes = $this->employeModel->getAllEmployes();

        $data = [
            'title'    => 'Employés',
            'employes' => $employes,
        ];

        return view('employes/index', $data);
    }

    // ========== AFFICHER UN EMPLOYÉ ==========
    public function show($id)
    {
        $employe = $this->employeModel->getEmployeById($id);

        if ($employe == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $departement = null;
        if ($employe['departement_id']) {
            $departement = $this->departementModel->getDepartementById($employe['departement_id']);
        }

        $data = [
            'title'       => 'Détails de l\'employé',
            'employe'     => $employe,
            'departement' => $departement,
        ];

        return view('employes/show', $data);
    }

    // ========== AFFICHER LE FORMULAIRE DE CRÉATION ==========
    public function create()
    {
        $departements = $this->departementModel->getAllDepartements();

        $data = [
            'title'        => 'Créer un employé',
            'departements' => $departements,
        ];

        return view('employes/create', $data);
    }

    // ========== SAUVEGARDER UN NOUVEL EMPLOYÉ ==========
    public function store()
    {
        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');
        $departement_id = $this->request->getPost('departement_id');
        $date_embauche = $this->request->getPost('date_embauche');
        $actif = $this->request->getPost('actif') ?? '1';

        // Validations
        if (empty($nom)) {
            return redirect()->back()->withInput()->with('error', 'Le nom est obligatoire');
        }
        if (empty($prenom)) {
            return redirect()->back()->withInput()->with('error', 'Le prénom est obligatoire');
        }
        if (empty($email)) {
            return redirect()->back()->withInput()->with('error', 'L\'email est obligatoire');
        }
        if (empty($password)) {
            return redirect()->back()->withInput()->with('error', 'Le mot de passe est obligatoire');
        }

        $data = [
            'nom'              => $nom,
            'prenom'           => $prenom,
            'email'            => $email,
            'password'         => $password,
            'role'             => $role,
            'departement_id'   => $departement_id ?: null,
            'date_embauche'    => $date_embauche,
            'actif'            => $actif,
        ];

        $resultat = $this->employeModel->createEmploye($data);

        if ($resultat === false) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la création de l\'employé');
        }

        return redirect()->to('/employes')->with('success', 'Employé créé avec succès');
    }

    // ========== AFFICHER LE FORMULAIRE D'ÉDITION ==========
    public function edit($id)
    {
        $employe = $this->employeModel->getEmployeById($id);

        if ($employe == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $departements = $this->departementModel->getAllDepartements();

        $data = [
            'title'        => 'Éditer l\'employé',
            'employe'      => $employe,
            'departements' => $departements,
        ];

        return view('employes/edit', $data);
    }

    // ========== METTRE À JOUR UN EMPLOYÉ ==========
    public function update($id)
    {
        $employe = $this->employeModel->getEmployeById($id);

        if ($employe == null) {
            return redirect()->to('/employes')->with('error', 'Employé introuvable');
        }

        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');
        $departement_id = $this->request->getPost('departement_id');
        $date_embauche = $this->request->getPost('date_embauche');
        $actif = $this->request->getPost('actif') ?? '1';

        // Validations
        if (empty($nom)) {
            return redirect()->back()->withInput()->with('error', 'Le nom est obligatoire');
        }
        if (empty($prenom)) {
            return redirect()->back()->withInput()->with('error', 'Le prénom est obligatoire');
        }
        if (empty($email)) {
            return redirect()->back()->withInput()->with('error', 'L\'email est obligatoire');
        }

        $data = [
            'nom'              => $nom,
            'prenom'           => $prenom,
            'email'            => $email,
            'role'             => $role,
            'departement_id'   => $departement_id ?: null,
            'date_embauche'    => $date_embauche,
            'actif'            => $actif,
        ];

        // Only update password if provided
        if (!empty($password)) {
            $data['password'] = $password;
        }

        $resultat = $this->employeModel->updateEmploye($id, $data);

        if ($resultat === false) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la mise à jour de l\'employé');
        }

        return redirect()->to('/employes')->with('success', 'Employé mis à jour avec succès');
    }

    // ========== SUPPRIMER UN EMPLOYÉ ==========
    public function delete($id)
    {
        $employe = $this->employeModel->getEmployeById($id);

        if ($employe == null) {
            return redirect()->to('/employes')->with('error', 'Employé introuvable');
        }

        $this->employeModel->deleteEmploye($id);

        return redirect()->to('/employes')->with('success', 'Employé supprimé avec succès');
    }

    // ========== AFFICHER LES DONNÉES EN JSON ==========
    public function json()
    {
        $employes = $this->employeModel->getAllEmployes();
        return $this->response->setJSON($employes);
    }
}
