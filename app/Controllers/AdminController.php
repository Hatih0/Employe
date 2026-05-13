<?php

namespace App\Controllers;

use App\Models\EmployeModel;
use App\Models\TypeConge;
use App\Models\CongeModel;

class AdminController extends BaseController
{
    private EmployeModel $employeModel;
    private TypeConge $typeCongeModel;
    private CongeModel $congeModel;

    public function __construct()
    {
        $this->employeModel = new EmployeModel();
        $this->typeCongeModel = new TypeConge();
        $this->congeModel = new CongeModel();
    }

    public function dashboard()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $role = session()->get('role');
        if ($role !== 'admin' && $role !== 'Admin' && $role !== 'administrateur') {
            return redirect()->to('/dashboard')->with('error', 'Accès refusé.');
        }

        $totalEmployes = count($this->employeModel->findAll());
        $totalDemandes = count($this->congeModel->findAll());
        $demandesEnAttente = count($this->congeModel->where('statut', 'en_attente')->findAll());

        return view('admin/dashboard', [
            'totalEmployes' => $totalEmployes,
            'totalDemandes' => $totalDemandes,
            'demandesEnAttente' => $demandesEnAttente,
        ]);
    }

    public function employes()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $employes = $this->employeModel->findAll();
        return view('admin/employes', ['employes' => $employes]);
    }

    public function creerEmploye()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        return view('admin/creer_employe');
    }

    public function sauvegarderEmploye()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        if (!$nom || !$prenom || !$email || !$password || !$role) {
            return redirect()->back()->with('error', 'Tous les champs sont obligatoires.');
        }

        $data = [
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'actif' => '1',
        ];

        if ($this->employeModel->insert($data)) {
            return redirect()->to('/admin/employes')->with('success', 'Employé créé avec succès.');
        }

        return redirect()->back()->with('error', 'Erreur lors de la création de l\'employé.');
    }

    public function historiqueAbsences()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        // Récupérer l'historique de toutes les demandes approuvées
        $absences = $this->congeModel
            ->select('conges.*, types_conge.libelle as type_conge, employes.nom, employes.prenom')
            ->join('types_conge', 'conges.type_conge_id = types_conge.id')
            ->join('employes', 'conges.employe_id = employes.id')
            ->where('conges.statut', 'approuvée')
            ->orderBy('conges.date_debut', 'DESC')
            ->findAll();

        return view('admin/absences', ['absences' => $absences]);
    }

    public function typesConge()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $types = $this->typeCongeModel->findAll();
        return view('admin/types_conge', ['types' => $types]);
    }

    public function creerTypeConge()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        return view('admin/creer_type_conge');
    }

    public function sauvegarderTypeConge()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $libelle = trim((string) $this->request->getPost('libelle'));
        $joursAnnuels = $this->request->getPost('jours_annuels');
        $deductible = $this->request->getPost('deductible') ?? '1';

        if ($libelle === '' || $joursAnnuels === '') {
            return redirect()->back()->withInput()->with('error', 'Tous les champs sont obligatoires.');
        }

        if (!is_numeric($joursAnnuels) || (int) $joursAnnuels <= 0) {
            return redirect()->back()->withInput()->with('error', 'Le nombre de jours doit être un nombre positif.');
        }

        if ($this->typeCongeModel->insert([
            'libelle' => $libelle,
            'jours_annuels' => (int) $joursAnnuels,
            'deductible' => $deductible,
        ])) {
            return redirect()->to('/admin/types-conge')->with('success', 'Type de congé créé avec succès.');
        }

        return redirect()->back()->withInput()->with('error', 'Erreur lors de la création du type de congé.');
    }

    public function modifierTypeConge($id)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $typeConge = $this->typeCongeModel->find($id);

        if (!$typeConge) {
            return redirect()->to('/admin/types-conge')->with('error', 'Type de congé introuvable.');
        }

        return view('admin/modifier_type_conge', ['typeConge' => $typeConge]);
    }

    public function sauvegarderModificationTypeConge($id)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $typeConge = $this->typeCongeModel->find($id);

        if (!$typeConge) {
            return redirect()->to('/admin/types-conge')->with('error', 'Type de congé introuvable.');
        }

        $libelle = trim((string) $this->request->getPost('libelle'));
        $joursAnnuels = $this->request->getPost('jours_annuels');
        $deductible = $this->request->getPost('deductible') ?? '1';

        if ($libelle === '' || $joursAnnuels === '') {
            return redirect()->back()->withInput()->with('error', 'Tous les champs sont obligatoires.');
        }

        if (!is_numeric($joursAnnuels) || (int) $joursAnnuels <= 0) {
            return redirect()->back()->withInput()->with('error', 'Le nombre de jours doit être un nombre positif.');
        }

        if ($this->typeCongeModel->update($id, [
            'libelle' => $libelle,
            'jours_annuels' => (int) $joursAnnuels,
            'deductible' => $deductible,
        ])) {
            return redirect()->to('/admin/types-conge')->with('success', 'Type de congé modifié avec succès.');
        }

        return redirect()->back()->withInput()->with('error', 'Erreur lors de la modification du type de congé.');
    }

    public function supprimerTypeConge($id)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $typeConge = $this->typeCongeModel->find($id);

        if (!$typeConge) {
            return redirect()->to('/admin/types-conge')->with('error', 'Type de congé introuvable.');
        }

        if ($this->typeCongeModel->delete($id)) {
            return redirect()->to('/admin/types-conge')->with('success', 'Type de congé supprimé avec succès.');
        }

        return redirect()->to('/admin/types-conge')->with('error', 'Erreur lors de la suppression du type de congé.');
    }

    public function modifierEmploye($id)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $employe = $this->employeModel->find($id);

        if (!$employe) {
            return redirect()->back()->with('error', 'Employé non trouvé.');
        }

        return view('admin/modifier_employe', ['employe' => $employe]);
    }

    public function sauvegarderModificationEmploye($id)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $email = $this->request->getPost('email');
        $role = $this->request->getPost('role');

        if (!$nom || !$prenom || !$email || !$role) {
            return redirect()->back()->with('error', 'Tous les champs sont obligatoires.');
        }

        $data = [
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'role' => $role,
        ];

        if ($this->employeModel->skipValidation(true)->update($id, $data)) {
            return redirect()->to('/admin/employes')->with('success', 'Employé modifié avec succès.');
        }

        return redirect()->back()->with('error', 'Erreur lors de la modification.');
    }

    public function supprimerEmploye($id)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $employe = $this->employeModel->find($id);

        if (!$employe) {
            return redirect()->back()->with('error', 'Employé non trouvé.');
        }

        if ($this->employeModel->delete($id)) {
            return redirect()->to('/admin/employes')->with('success', 'Employé supprimé avec succès.');
        }

        return redirect()->back()->with('error', 'Erreur lors de la suppression.');
    }
}
