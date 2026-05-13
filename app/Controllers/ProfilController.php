<?php

namespace App\Controllers;

use App\Models\EmployeModel;

class ProfilController extends BaseController
{
    private EmployeModel $employeModel;

    public function __construct()
    {
        $this->employeModel = new EmployeModel();
    }

    public function index()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $employeId = session()->get('user_id');
        $employe = $this->employeModel->find($employeId);

        if (!$employe) {
            return redirect()->to('/')
                ->with('error', 'Employé introuvable.');
        }

        return view('employe/MonProfil/MonProfil', ['employe' => $employe]);
    }

    public function modifier()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $employeId = session()->get('user_id');
        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $email = $this->request->getPost('email');

        // Validation basique
        if (!$nom || !$prenom || !$email) {
            return redirect()->back()
                ->with('error', 'Tous les champs sont obligatoires.');
        }

        // Vérifier que l'email est unique (sauf pour l'employé lui-même)
        $existingEmail = $this->employeModel
            ->where('email', $email)
            ->where('id !=', $employeId)
            ->first();

        if ($existingEmail) {
            return redirect()->back()
                ->with('error', 'Cet email est déjà utilisé par un autre employé.');
        }

        $data = [
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
        ];

        if ($this->employeModel->update($employeId, $data)) {
            // Mettre à jour l'email en session si modifié
            session()->set(['email' => $email]);
            return redirect()->to('/profil')
                ->with('success', 'Votre profil a été mis à jour avec succès.');
        }

        return redirect()->back()
            ->with('error', 'Une erreur est survenue lors de la mise à jour du profil.');
    }
}
