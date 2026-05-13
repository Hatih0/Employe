<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\CongeModel;
use App\Models\SoldeModel;

class DashboardEmployeController extends BaseController
{
    private $congeModel;
    private $soldeModel;

    public function __construct()
    {
        $this->soldeModel = new SoldeModel();
        $this->congeModel = new CongeModel();
    }

    public function dashboard()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $solde = $this->soldeModel->getSoldeByEmployeIdAndTypeCongeId(session()->get('user_id'), 1);

        return view('employe/dashboard/dashboard', ['solde' => $solde]);
    }

    public function MesDemandes()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $demandeEmployee = $this->congeModel->getCongesByEmployeId(session()->get('user_id'));
        return view('employe/MesDemandes/MesDemande', ['demandes' => $demandeEmployee]);

    }

}