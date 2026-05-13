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

        if ($email == "user@example.com" && $password == "user123") {
            session()->set([
                'user_id'      => 1, 
                'email'          => $email,
                'is_logged_in' => true,
            ]);
            return redirect()->to('/dashboard');
        }

      $user = $this->employeModel->checkEmploye($email, $password);

        if (!$user) {
            return redirect()->back()
                ->with('error', 'Email ou mot de passe incorrect.');
        }

        session()->set([
            'user_id'      => $user['id'],
            'email'          => $user['email'],
            'is_logged_in' => true,
        ]);

        return redirect()->to('/dashboard');
    }

}