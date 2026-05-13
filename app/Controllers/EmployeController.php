<?php 

namespace App\Controllers;
use App\Models\EmployeModel;
use App\Controllers\BaseController;

class EmployeController extends BaseController
{
    private EmployeModel $employeModel;

    public function __construct()
    {
        $this->employeModel = new EmployeModel();
    }

    public function login()
    {
        $firstEmploye = $this->employeModel->first();
        return view('employe/login', ['firstEmploye' => $firstEmploye]);
    }

    public function authenticate()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->employeModel->checkEmploye($email, $password);

        if (!$user) {
            return redirect()->back()
                ->with('error', 'Email ou mot de passe incorrect.');
        }

        session()->set([
            'user_id'      => $user['id'],
            'email'        => $user['email'],
            'nom'          => $user['nom'],
            'prenom'       => $user['prenom'],
            'role'         => strtolower($user['role']),
            'is_logged_in' => true,
        ]);

        // Redirection selon le rôle
        $role = strtolower($user['role']);
        if ($role === 'rh') {
            return redirect()->to('/rh/demandes');
        } elseif ($role === 'admin') {
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->to('/dashboard');
        }
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Vous êtes déconnecté avec succès.');
    }

}