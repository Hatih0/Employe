<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\CongeModel;

class DashboardEmployeController extends BaseController
{
    private $congeModel;

    public function __construct()
    {
        $this->congeModel = new CongeModel();
    }

    public function dashboard()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        return view('employe/dashboard/dashboard');
    }

    public function MesDemandes()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $demandeEmployee = $this->congeModel->getCongesByEmployeId(session()->get('employe_id'));
        return view('employe/MesDemandes/MesDemande', ['demandes' => $demandeEmployee]);

    }

}